<?php

class LesphotosController extends Controller {

    private $dirView = 'lesphotos';
    private $error = null;
    private $success = null;

    public function creation() {
        $album = new Album();
        if ((!empty($_POST))) {
            if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                    (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0)) &&
                    (isset($_POST["date"]) && !empty($_POST["date"]))) {

                $album->setTitre($_POST["titre"]);
                $album->setActive($_POST["active"]);
                $album->setDate($_POST["date"]);
                $album->addAlbum();
                $id = $album->getId();
                if ($id > 0) {
                    header('Location: /lesphotos/modificationPhotos/' . $id . '/true');
                } else {
                    $this->error = "Il y a une erreur dans l'ajout d'un album.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires pour créer un album.";
            }
        }

        $albumReturn = null;
        if (empty($this->success) && (isset($_POST["titre"]) && isset($_POST["active"]) && isset($_POST["date"]))) {
            $albumReturn = new Album();
            $albumReturn->setTitre($_POST["titre"]);
            $albumReturn->setActive($_POST["active"]);
            $albumReturn->setDate($_POST["date"]);
        }

        $this->render($this->dirView . '/creation', array(
            'title' => "Création d'un album photo",
            'error' => $this->error,
            'success' => $this->success,
            'album' => $albumReturn,
        ));
    }

    public function modification() {
        $arrayJs = array("lesphotos/modification");

        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification des albums photos',
            'albums' => (new Album())->getAllAlbum(),
            'arrayJs' => $arrayJs,
        ));
    }

    public function modificationAlbum($id = null) {


        $albumConstruction = new Album();
        $albumConstruction->setId($id);

        if ((!empty($_POST))) {
            if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                    (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0)) &&
                    (isset($_POST["date"]) && !empty($_POST["date"]))) {
                $albumConstruction->setTitre($_POST["titre"]);
                $albumConstruction->setActive($_POST["active"]);
                $albumConstruction->setDate($_POST["date"]);

                if ($albumConstruction->updateAlbum()) {
                    $this->success = "L'album à bien été modifié.";
                } else {
                    $this->error = "Il y a une erreur dans la modification de l'album.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }
        $album = $albumConstruction->getAlbumById();
        $dateTime = new DateTime($album["date_debut"]);
        $album["date_debut"] = $dateTime->format('m/d/Y');


        $this->render($this->dirView . '/modificationAlbum', array(
            'title' => 'Modification des albums photos',
            'error' => $this->error,
            'success' => $this->success,
            'album' => $album,
        ));
    }

    public function modificationPhotos($id = null, $created = false) {
        if ($created == true) {
            $this->success = "L'album à bien été créé.";
        }

        $albumConstruction = new Album();
        $albumConstruction->setId($id);
        $album = $albumConstruction->getAlbumById();
        $dateTime = new DateTime($album["date_debut"]);
        $album["date_debut"] = $dateTime->format('m/d/Y');
        $arrayJs = array("lesphotos/gestionPhoto");
        $arrayCss = array("lesphotos/gestionPhoto");
        $photosConstruct = null;
        if (isset($album["id"])) {
            $photosConstruct = new Photos();
            $photosConstruct->setId_album($id);
            $photos = $photosConstruct->getAllPhotosByAlbum();
        }

        $this->render($this->dirView . '/modificationPhotos', array(
            'title' => 'Modification des albums photos',
            'error' => $this->error,
            'success' => $this->success,
            'album' => $album,
            'photos' => $photos,
            'arrayJs' => $arrayJs,
            'arrayCss' => $arrayCss,
        ));
    }

    public function suppression() {
        $albumConstruct = new Album();

        if ((!empty($_POST))) {
            if ((isset($_POST["idAlbum"]) && !empty($_POST["idAlbum"]))) {

                $albumConstruct->setId($_POST["idAlbum"]);
                $src = 'assets/img/album/' . $_POST["idAlbum"];
                (new helper())->deleteDir($src);
                $photos = new Photos();
                $photos->setId_album($_POST["idAlbum"]);
                $photos->deletePhotosByIdAlbum();
                if ($albumConstruct->deleteAlbumById()) {

                    $this->success = "L'album à bien été supprimé.";
                } else {
                    $this->error = "Cet album n'existe pas";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }
        $albums = $albumConstruct->getAllAlbum();

        $this->render($this->dirView . '/suppresion', array(
            'title' => "Suppresion d'un album",
            'error' => $this->error,
            'success' => $this->success,
            'albums' => $albums
        ));
    }

    public function liste() {
        $this->render($this->dirView . '/liste', array(
            'title' => 'Liste albums',
            'albums' => (new Album())->getAllAlbum(),
        ));
    }

    public function ajouterImage($id = null) {
        if ($id != null) {

            $ds = DIRECTORY_SEPARATOR;
            $storeFolder = '/assets/img/album/' . $id . $ds;

            if (!empty($_FILES)) {

                $tempFile = $_FILES['file']['tmp_name'];
                $targetPath = $_SERVER['DOCUMENT_ROOT'] . $ds . $storeFolder;
                (new helper())->createDir($targetPath);
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                $name_file = md5(session_id() . microtime()) . "." . $ext;
                $targetFile = $targetPath . $name_file;

                if (move_uploaded_file($tempFile, $targetFile)) {
                    $photos = new Photos();
                    $photos->setId_album($id);
                    $photos->setUrl($storeFolder . $name_file);
                    $photos->setName($name_file);
                    $photos->addPhotos();
                    $result["id"] = $photos->getId();
                    $result["url"] = "http://" . $_SERVER['HTTP_HOST'] . $photos->getUrl();
                    echo json_encode($result);
                }
            }
        }
    }

    public function supprimerImage($id = null) {
        if ($id != null) {
            $photos = new Photos();
            $photos->setId($id);
            $photo = $photos->getPhotoById();
            (new helper())->deleteFile($_SERVER['DOCUMENT_ROOT'] . $ds . $photo["url"]);
            $photos->deletePhotosById();
        }
    }

}
