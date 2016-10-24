<?php

class ApiController extends Controller {

    public function flashback($id = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($id) {
            $flashbackConstruct = new Flashback();
            $flashbackConstruct->setId($id);
            $flashback = $flashbackConstruct->getFlashbackById();
            if (!empty($flashback)) {
                $jsonFlashback["titre"] = $flashback["titre"];
                $dateTime = new DateTime($flashback["date_debut"]);
                $jsonFlashback["date_debut"] = $dateTime->format('m/d/Y');
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
            $start = $page * 10;
            $end = $start - 10;
            $flashbackConstruct = new Flashback();
            $count = $flashbackConstruct->countFlashback();
            if ($count / 10 >= $page - 1) {
                foreach ($flashbackConstruct->getAllFlashbackByPage($start, $end) as $flashbacks) {
                    $jsonFlashback["titre"] = $flashbacks["titre"];
                    $dateTime = new DateTime($flashbacks["date_debut"]);
                    $jsonFlashback["date_debut"] = $dateTime->format('m/d/Y');
                    $jsonFlashback["id"] = $flashbacks["id"];
                    array_push($jsonFlashbacks, $jsonFlashback);
                }
                echo json_encode($jsonFlashbacks);
            }
        }
    }
}
