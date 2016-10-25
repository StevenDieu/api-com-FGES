<?php

class ApiController extends Controller {

    public function flashback($id = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($id) {
            $flashbackConstruct = new Flashback();
            $flashbackConstruct->setId($id);
            $flashback = $flashbackConstruct->getFlashbackByIdActive();
            if (!empty($flashback)) {
                $jsonFlashback["titre"] = $flashback["titre"];
                new DateTime($flashback["date_debut"]);
                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // OK
                $jsonFlashback["date_debut"] = strftime("%A %d %B %Y");
                $jsonFlashback["description"] = $flashback["description"];
                echo json_encode($jsonFlashback);
            }
        }
    }

    public function listeflashback($page = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($page != null) {
            $jsonFlashbacks = array();
            $flashbackConstruct = new Flashback();
            $count = $flashbackConstruct->countFlashback();
            if ($count > 0 && $count / 10 >= $page - 1) {
                foreach ($flashbackConstruct->getAllFlashbackByPage($page * 10) as $flashbacks) {
                    $jsonFlashback["titre"] = $flashbacks["titre"];
                    new DateTime($flashbacks["date_debut"]);
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // OK
                    $jsonFlashback["date_debut"] = strftime("%A %d %B %Y");
                    $jsonFlashback["id"] = $flashbacks["id"];
                    array_push($jsonFlashbacks, $jsonFlashback);
                }
                echo json_encode($jsonFlashbacks);
            }
        }
    }

}
