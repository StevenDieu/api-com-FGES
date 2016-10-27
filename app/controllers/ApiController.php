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

    public function listeAlbum($page = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($page != null) {
            $jsonAlbums = array();
            $albumConstruct = new Album();
            $count = $albumConstruct->countAlbum();
            if ($count > 0 && $count / 10 >= $page - 1) {
                foreach ($albumConstruct->getAllAlbumByPage($page * 10) as $albums) {
                    $jsonAlbum["titre"] = $albums["titre"];
                    new DateTime($albums["date_debut"]);
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // OK
                    $jsonAlbum["date_debut"] = strftime("%A %d %B %Y");
                    $jsonAlbum["id"] = $albums["id"];
                    array_push($jsonAlbums, $jsonAlbum);
                }
                echo json_encode($jsonAlbums);
            }
        }
    }

    public function listePhoto($page = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($page != null) {
            $jsonPhotos = array();
            $photoConstruct = new Photos();
            $count = $albumConstruct->countAlbum();
            if ($count > 0 && $count / 10 >= $page - 1) {
                foreach ($albumConstruct->getAllAlbumByPage($page * 10) as $albums) {
                    $jsonAlbum["titre"] = $albums["titre"];
                    new DateTime($albums["date_debut"]);
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); // OK
                    $jsonAlbum["date_debut"] = strftime("%A %d %B %Y");
                    $jsonAlbum["id"] = $albums["id"];
                    array_push($jsonAlbums, $jsonAlbum);
                }
                echo json_encode($jsonAlbums);
            }
        }
    }

}
