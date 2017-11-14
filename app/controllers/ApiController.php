<?php

class ApiController extends Controller
{

    /**
     * Request for comment [POST] + [GET]
     *
     * @param type $type
     * @param type $id
     */
    public function comment($type = null, $id = null)
    {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        switch ($_SERVER['REQUEST_METHOD']) {
            case "POST":
                $this->addComment();
                break;
            case "GET":
                $this->getAllComment($type, $id);
                break;
            default:
                break;
        }
    }

    /**
     * Add comment in bdd
     */
    private function addComment()
    {
        if ((!empty($_POST)) && (isset($_POST["id"]) && !empty($_POST["id"])) &&
            (isset($_POST["type"]) && !empty($_POST["type"])) &&
            (isset($_POST["name"]) && !empty($_POST["name"])) &&
            (isset($_POST["text"]) && !empty($_POST["text"])) &&
            $this->checkValidIdTypeAndIsExist($_POST["type"], $_POST["id"])) {
            $comment = new Comment();
            $comment->setType($_POST["type"]);
            $comment->setIdType($_POST["id"]);
            $comment->setName($_POST["name"]);
            $comment->setText($_POST["text"]);
            $comment->addComment();
            http_response_code(200);
            $json["message"] = "Votre commentaire à été envoyé avec succés... Nous allons le vérifier avant de le publier.";
        } else {
            http_response_code(400);
            $json["message"] = "Votre commentaire n'a pas été envoyé, veuillez recommencer...";
        }
        echo json_encode($json);
    }

    /**
     * Check if idType is valid and check if type + id exist
     *
     * @param type $type
     * @param type $id
     * @return boolean
     */
    public function checkValidIdTypeAndIsExist($type, $id)
    {
        switch ($type) {
            case TypeComment::avenir:
                $avenir = new Avenir();
                $avenir->setId($id);
                if ($avenir->getAvenirById()) {
                    return true;
                }
            case TypeComment::photo:
                $photo = new Photos();
                $photo->setId($id);
                if ($photo->getPhotoById()) {
                    return true;
                }
            case TypeComment::flashback:
                $flashback = new Flashback();
                $flashback->setId($id);
                if ($flashback->getFlashbackById()) {
                    return true;
                }
        }
        return false;
    }

    /**
     * Get element of all comment
     *
     * @param type $type
     * @param type $id
     */
    private function getAllComment($type, $id)
    {
        if ($type != null && $id != null && TypeComment::checkValidComment($type)) {
            $jsonListe = array();
            $comment = new Comment();
            $comment->setIdType($id);
            $comment->setType($type);
            $arrayComment = $comment->getCountCommentActiveByIdType();
            $count = $arrayComment["numberComment"];

            if ($count > 0) {
                $list = $comment->getAllCommentActiveById();
                foreach ($list as $elt) {
                    $array["name"] = $elt["name"];
                    $array["text"] = $elt["text"];

                    $date_debut = new DateTime($elt["created"]);
                    $array["created"] = $this->format($date_debut->format('d F Y'));

                    array_push($jsonListe, $array);
                }
                $json["comments"] = $jsonListe;
            } else {
                $json["error"] = "Erreur, il n'y a pas de commentaire actuellement";
            }
        } else {
            $json["error"] = "Aie ! un problème est survenue... veuillez recommencer.";
        }
        echo json_encode($json);
    }

    /**
     * Change date EN to date FR
     *
     * @param type $format
     * @return type
     */
    public function format($format)
    {
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, $format);
    }

    /**
     * Get element 'avenir' to show
     */
    public function avenir()
    {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        $json = array();
        $jsonListe = array();
        $constructor = new Avenir();
        $arrayAvenir = $constructor->countAvenir();
        $count = $arrayAvenir["numberAvenir"];

        if ($count > 0) {
            $list = $constructor->getAllAvenirActive();
            foreach ($list as $elt) {
                $array["id"] = $elt["id"];

                $comment = new Comment();
                $comment->setIdType($elt["id"]);
                $comment->setType(TypeComment::avenir);
                $arrayCountCommentActive = $comment->getCountCommentActiveByIdType();
                $array["number_comment"] = $arrayCountCommentActive["numberComment"];

                $array["titre"] = $elt["titre"];
                $array["description"] = $elt["description"];

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

    /**
     * Get list album
     *
     * @param type $page
     * @param type $start
     */
    public function album($page = null, $start = null)
    {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");
        $this->getListe("album", $start, $page);
    }

    /**
     * Generate list for album or flashback
     *
     * @param type $type
     * @param type $start
     * @param type $page
     */
    private function getListe($type, $start, $page)
    {
        if ($start != null && $page != null && $page == "page") {
            $json = array();
            $jsonListe = array();
            $constructor = null;
            $count = null;

            if ($type == "album") {
                $constructor = new Album();
                $arrayAlbum = $constructor->countAlbum();
                $count = $arrayAlbum["numberAlbum"];
            } else {
                $constructor = new Flashback();
                $arrayFlashback = $constructor->countFlashback();
                $count = $arrayFlashback["numberFlashback"];
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

    /**
     * Get element to show photo
     *
     * @param type $idAlbum
     * @param type $idOrPage
     * @param type $start
     */
    public function photo($idAlbum = null, $idOrPage = null, $start = null)
    {
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

                    $comment = new Comment();
                    $comment->setIdType($photo["id"]);
                    $comment->setType(TypeComment::photo);
                    $arrayCommentActiveByIdType = $comment->getCountCommentActiveByIdType();
                    $jsonPhoto["number_comment"] = $arrayCommentActiveByIdType["numberComment"];

                    echo json_encode($jsonPhoto);
                }
            }
        }
    }

    /**
     * Get list photo
     *
     * @param type $idAlbum
     * @param type $start
     */
    private function listPhoto($idAlbum = null, $start = null)
    {
        if ($start != null) {
            $json = array();
            $jsonPhotos = array();
            $photoConstruct = new Photos();
            $photoConstruct->setId_album($idAlbum);
            $arrayCountPhoto = $photoConstruct->countPhotosByIdAlbum();
            $count = $arrayCountPhoto["numberPhotos"];
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

    /**
     * Get previous id and next id photo
     *
     * @param type $id_album
     * @param type $id
     */
    public function previousNextPhoto($id_album = null, $id = null)
    {
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

    /**
     * Get next id photo
     *
     * @param type $id_album
     * @param type $id
     */
    public function nextPhoto($id_album = null, $id = null)
    {
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

    /**
     * Get previous id photo
     *
     * @param type $id_album
     * @param type $id
     */
    public function previousPhoto($id_album = null, $id = null)
    {
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

    /**
     * Get list flashback or get one flashback
     *
     * @param type $idOrPage
     * @param type $start
     */
    public function flashback($idOrPage = null, $start = null)
    {
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

                    $comment = new Comment();
                    $comment->setIdType($flashback["id"]);
                    $comment->setType(TypeComment::flashback);
                    $arrayCommentActiveByIdType = $comment->getCountCommentActiveByIdType();
                    $jsonFlashback["number_comment"] = $arrayCommentActiveByIdType["numberComment"];

                    $jsonFlashback["titre"] = $flashback["titre"];

                    $date_debut = new DateTime($flashback["date_debut"]);
                    $jsonFlashback["date_debut"] = $this->format($date_debut->format('d F Y'));

                    $jsonFlashback["description"] = $flashback["description"];
                    echo json_encode($jsonFlashback);
                }
            }
        }
    }

}
