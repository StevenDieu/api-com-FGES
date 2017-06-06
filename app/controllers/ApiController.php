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

                    $date_debut = new DateTime($flashback["date_debut"]);
                    $jsonFlashback["date_debut"] = $this->format($date_debut->format('d F Y'));

                    $jsonFlashback["description"] = $flashback["description"];
                    echo json_encode($jsonFlashback);
                }
            }
        }
    }

    public function comment() {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        switch ($_SERVER['REQUEST_METHOD']) {
            case "POST":
                addComment();
                break;

            default:
                break;
        }
    }

    private function addComment() {
        
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

    public function avenir() {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        $json = array();
        $jsonListe = array();
        $constructor = new Avenir();
        $count = $constructor->countAvenir();

        if ($count > 0) {
            $list = $constructor->getAllAvenirActive();
            foreach ($list as $elt) {
                $array["id"] = $elt["id"];

                $array["titre"] = $elt["titre"];
                $array["description"] = $elt["titre"];

                $date_debut = new DateTime($elt["date_debut"]);
                $array["date_debut"] = $this->format($date_debut->format('d F Y'));
                $array["heure_debut"] = $this->format($date_debut->format('H\hi'));

                $date_fin = new DateTime($elt["date_fin"]);
                $array["date_fin"] = $this->format($date_fin->format('d F Y'));
                $array["heure_fin"] = $this->format($date_fin->format('H\hi'));

                $array["lieu"] = $elt["lieu"];

                array_push($jsonListe, $array);
            }
            $json["avenirs"] = $jsonListe;
            echo json_encode($json);
        } else {
            $json["error"] = "nothing";
            echo json_encode($json);
        }
    }

    public function format($format) {
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, $format);
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

                    $date_debut = new DateTime($elt["date_debut"]);
                    $array["date_debut"] = $this->format($date_debut->format('d F Y'));

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
