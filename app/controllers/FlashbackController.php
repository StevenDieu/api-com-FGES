<?php

class FlashbackController extends Controller {

    private $dirView = 'flashback';
    private $error = null;
    private $flashbackReturn = null;
    private $success = null;

    public function creation() {
        $flashback = new Flashback();
        $nextId = $flashback->getNextId();
        if ((!empty($_POST))) {
            if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                    (isset($_POST["description"]) && !empty($_POST["description"])) &&
                    (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0)) &&
                    (isset($_POST["date"]) && !empty($_POST["date"]))) {

                $flashback->setTitre($_POST["titre"]);
                $flashback->setDescription($_POST["description"]);
                $flashback->setActive($_POST["active"]);
                $flashback->setDate($_POST["date"]);
                $flashback->addFlashback();
                $id = $flashback->getId();
                if ($id > 0) {
                    $nextId = $flashback->getNextId();
                    $src = 'assets/img/flashback/' . $nextId;
                    (new helper())->deleteAndCreatDir($src);
                    header('Location: /flashback/modification/' . $id . '/true');
                } else {
                    $this->error = "Il y a une erreur dans l'ajout d'un flashback.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        } else {
            $src = 'assets/img/flashback/' . $nextId;
            (new helper())->deleteAndCreatDir($src);
        }

        if ((isset($_POST["titre"]) && isset($_POST["description"]) && isset($_POST["active"]) && isset($_POST["date"]))) {
            $this->flashbackReturn = new Flashback();
            $this->flashbackReturn->setTitre($_POST["titre"]);
            $this->flashbackReturn->setDescription($_POST["description"]);
            $this->flashbackReturn->setActive($_POST["active"]);
            $this->flashbackReturn->setDate($_POST["date"]);
        }

        $this->render($this->dirView . '/creation', array(
            'title' => 'Création Flashback',
            'error' => $this->error,
            'success' => $this->success,
            'flashback' => $this->flashbackReturn,
            'nextId' => $nextId,
            'froala' => true
        ));
    }

    public function modification($id = null, $created = false) {
        $flashbacks = null;
        $flashback = null;
        $froala = false;
        if ($created == true) {
            $this->success = "Le flashback à bien été créé.";
        }
        if (isset($id) && !empty($id)) {
            $flashbackConstruct = new Flashback();
            $flashbackConstruct->setId($id);

            if ((!empty($_POST))) {
                if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                        (isset($_POST["description"]) && !empty($_POST["description"])) &&
                        (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0)) &&
                        (isset($_POST["date"]) && !empty($_POST["date"]))) {
                    $flashbackConstruct->setTitre($_POST["titre"]);
                    $flashbackConstruct->setDescription($_POST["description"]);
                    $flashbackConstruct->setActive($_POST["active"]);
                    $flashbackConstruct->setDate($_POST["date"]);

                    if ($flashbackConstruct->updateFlashback()) {
                        $this->success = "Le flashback à bien été modifié.";
                    } else {
                        $this->error = "Il y a une erreur dans la modification du flashback.";
                    }
                } else {
                    $this->error = "Tous les champs sont obligatoires.";
                }
            }
            $flashback = $flashbackConstruct->getFlashbackById();
            $dateTime = new DateTime($flashback["date_debut"]);
            $flashback["date_debut"] = $dateTime->format('m/d/Y');
            $froala = true;
        } else {
            $flashbacks = (new Flashback())->getAllFlashback();
        }
        $arrayJs = array("flashback/modification");
        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification Flashback',
            'error' => $this->error,
            'success' => $this->success,
            'arrayJs' => $arrayJs,
            'flashbacks' => $flashbacks,
            'flashback' => $flashback,
            'froala' => $froala
        ));
    }

    public function suppression() {
        $flashbackConstruct = new Flashback();

        if ((!empty($_POST))) {
            if ((isset($_POST["idFlashback"]) && !empty($_POST["idFlashback"]))) {

                $flashbackConstruct->setId($_POST["idFlashback"]);
                if ($flashbackConstruct->deleteFlashbackById()) {
                    $src = 'assets/img/flashback/' . $_POST["idFlashback"];
                    (new helper())->deleteDir($src);
                    $this->success = "Le flashback à bien été supprimé.";
                } else {
                    $this->error = "Ce flashback n'existe pas";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }
        $flashbacks = $flashbackConstruct->getAllFlashback();

        $this->render($this->dirView . '/suppresion', array(
            'title' => 'Suppresion Flashback',
            'error' => $this->error,
            'success' => $this->success,
            'flashbacks' => $flashbacks
        ));
    }

    public function liste($id = null) {
        $flashbackConstruct = new Flashback();
        $flashbacks = null;
        $flashback = null;
        $viewerFroala = false;
        if ($id == null) {
            $flashbacks = $flashbackConstruct->getAllFlashback();
        } else {
            $flashbackConstruct->setId($id);
            $flashback = $flashbackConstruct->getFlashbackById();
            $dateTime = new DateTime($flashback["date_debut"]);
            $flashback["date_debut"] = $dateTime->format('m/d/Y');
            $viewerFroala = true;
        }
        $this->render($this->dirView . '/liste', array(
            'title' => 'Liste Flashback',
            'flashbacks' => $flashbacks,
            'viewerFroala' => $viewerFroala,
            'flashback' => $flashback
        ));
    }

    public function ajoutImage($nextId) {
        include_once 'lib/froala/froala_editor.php';

        try {
            $flashback = new Flashback();
            $src = '/assets/img/flashback/' . $nextId . '/';
            $response = FroalaEditor_Image::upload($src);
            echo stripslashes(json_encode($response));
        } catch (Exception $e) {
            http_response_code(404);
        }
    }

    public function supprimeImage() {

        include_once 'lib/froala/froala_editor.php';

        try {
            FroalaEditor_Image::delete($_POST['src']);
            echo stripslashes(json_encode('Success'));
        } catch (Exception $e) {
            http_response_code(404);
        }
    }

}
