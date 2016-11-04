<?php

class ApiController extends Controller {

    public function flashback($idOrPage = null, $start = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($idOrPage != null) {
            if ($idOrPage == "page") {
                $this->getListe("flashback", $start, $idOrPage);
            } else {
                $flashbackConstruct = new Flashback();
                $flashbackConstruct->setId($idOrPage);
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
    }

    public function photo($idAlbum = null, $idOrPage = null, $start = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($idOrPage != null && $idAlbum != null) {
            if ($idOrPage == "page") {
                $this->listPhoto($idAlbum, $start);
            } else {
                $photoConstruct = new Photos();
                $photoConstruct->setId($idOrPage);
                $photoConstruct->setId_album($idAlbum);
                $photo = $photoConstruct->getPhotoById();
                if (!empty($photo)) {
                    $jsonPhoto["name"] = $photo["name"];
                    $jsonPhoto["id"] = $photo["id"];
                    $photo["url"] = str_replace("\\", "/", $photo["url"]);
                    $jsonPhoto["url"] = str_replace('/assets/img/', 'http://' . $_SERVER['HTTP_HOST'] . '/assets/img/', $photo["url"]);
                    echo json_encode($jsonPhoto);
                }
            }
        }
    }

    private function listPhoto($idAlbum = null, $start = null) {
        if ($start != null) {
            $json = array();
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
                $json["articles"] = $jsonPhotos;
                $json["nextStart"] = $start + 10;
                echo json_encode($json);
            } else {
                $json["error"] = "nothing";
                echo json_encode($json);
            }
        }
    }

    public function previousNextPhoto($id_album = null, $id = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($id != null && $id_album != null) {
            $photoConstruct = new Photos();
            $photoConstruct->setId($id);
            $photoConstruct->setId_album($id_album);
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

    public function nextPhoto($id_album = null, $id = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($id != null && $id_album != null) {
            $photoConstruct = new Photos();
            $photoConstruct->setId($id);
            $photoConstruct->setId_album($id_album);
            $photoNext = $photoConstruct->getNextPhotoByPage();
            if (!empty($photoNext)) {
                $jsonPhoto["nextId"] = $photoNext["id"];
            }
            echo json_encode($jsonPhoto);
        }
    }

    public function previousPhoto($id_album = null, $id = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        if ($id != null && $id_album != null) {
            $photoConstruct = new Photos();
            $photoConstruct->setId($id);
            $photoConstruct->setId_album($id_album);
            $photoPrevious = $photoConstruct->getPreviousPhotoByPage();
            if (!empty($photoPrevious)) {
                $jsonPhoto["previousId"] = $photoPrevious["id"];
            }
            echo json_encode($jsonPhoto);
        }
    }

    public function album($page = null, $start = null) {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        $this->getListe("album", $start, $page);
    }

    private function getListe($type, $start, $page) {
        if ($start != null && $page != null && $page == "page") {
            $json = array();
            $jsonListe = array();
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
                    array_push($jsonListe, $array);
                }
                $json["articles"] = $jsonListe;
                $json["nextStart"] = $start + $limit;
                echo json_encode($json);
            } else {
                $json["error"] = "nothing";
                echo json_encode($json);
            }
        }
    }

}
