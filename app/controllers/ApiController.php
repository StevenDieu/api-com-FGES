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

    public function photo($id_album = null, $id = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($id != null && $id_album != null) {
            $photoConstruct = new Photos();
            $photoConstruct->setId($id);
            $photoConstruct->setId_album($id_album);
            $photo = $photoConstruct->getPhotoById();
            $json = array();
            if (!empty($photo)) {
                $jsonPhoto["name"] = $photo["name"];
                $jsonPhoto["id"] = $photo["id"];
                $jsonPhoto["url"] = str_replace("\\", "/", $photo["url"]);
                $photoPrevious = $photoConstruct->getPreviousPhotoByPage();
                if (!empty($photoPrevious)) {
                    $jsonPhoto["previousId"] = $photoPrevious["id"];
                }
                $photoNext = $photoConstruct->getNextPhotoByPage();
                if (!empty($photoNext)) {
                    $jsonPhoto["nextId"] = $photoNext["id"];
                }
                echo json_encode($jsonPhoto);
            }
        }
    }

    public function listeflashback($start = null) {
        $this->getListe("flashabck", $start);
    }

    public function listeAlbum($start = null) {
        $this->getListe("album", $start);
    }

    private function getListe($type, $start) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($start != null) {
            $json = array();
            $constructor = null;
            $count = null;

            if ($type == "album") {
                $constructor = new Album();
                $count = $constructor->countAlbum();
            } else {
                $constructor = new Flashback();
                $count = $constructor->countFlashback();
            }

            if ($start == 0) {
                $limit = 20;
            } else {
                $limit = 10;
            }
            if ($count > 0 && ($start == 0 || $count - $start > 0)) {
                if ($type == "album") {
                    $list = $constructor->getAllAlbumByPage($start, $limit);
                } else {
                    $list = $constructor->getAllFlashbackByPage($start, $limit);
                }
                foreach ($list as $elt) {
                    $array["titre"] = $elt["titre"];
                    new DateTime($elt["date_debut"]);
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                    $array["date_debut"] = strftime("%A %d %B %Y");
                    $array["id"] = $elt["id"];
                    array_push($json, $array);
                }
                $json["articles"] = $json;
                $json["nextStart"] = $start + $limit;
                echo json_encode($json);
            } else {
                $json["error"] = "nothing";
                echo json_encode($json);
            }
        }
    }

    public function listePhoto($idAlbum = null, $start = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($start != null) {
            $jsonPhotos = array();
            $photoConstruct = new Photos();
            $photoConstruct->setId_album($idAlbum);
            $count = $photoConstruct->countPhotosByIdAlbum();
            if ($count > 0 && ($start == 0 || $count - $start > 0)) {
                foreach ($photoConstruct->getAllPhotosByPageAndIdAlbum($start) as $photos) {
                    $jsonPhoto["id"] = $photos["id"];
                    $jsonPhoto["url"] = str_replace("\\", "/", $photos["url"]);
                    $jsonPhoto["name"] = $photos["name"];
                    array_push($jsonPhotos, $jsonPhoto);
                }
                $jsonPhotos["articles"] = $jsonPhotos;
                $jsonPhotos["nextStart"] = $start + 10;
                echo json_encode($jsonPhotos);
            } else {
                $json["error"] = "nothing";
                echo json_encode($json);
            }
        }
    }

}
