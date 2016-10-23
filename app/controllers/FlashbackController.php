<?php

class FlashbackController extends Controller {

    private $dirView = 'flashback';
    private $error = null;
    private $flashbackReturn = null;
    private $success = null;

    public function creation() {
        if ((!empty($_POST))) {
            if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                    (isset($_POST["description"]) && !empty($_POST["description"])) &&
                    (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0)) &&
                    (isset($_POST["date"]) && !empty($_POST["date"]))) {

                $flashback = new Flashback();
                $flashback->setTitre($_POST["titre"]);
                $flashback->setDescription($_POST["description"]);
                $flashback->setActive($_POST["active"]);
                $flashback->setDate($_POST["date"]);
                $flashback->addFlashback();

                if ($flashback->getId() > 0) {
                    $this->success = "Le flashback à bien été créé.";
                } else {
                    $this->error = "Il y a une erreur dans l'ajout d'un flashback.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }

        if (empty($this->success) && (isset($_POST["titre"]) && isset($_POST["description"]) && isset($_POST["active"]) && isset($_POST["date"]))) {
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
            'froala' => 'froala'
        ));
    }

    public function ajoutImage() {
        // Include the editor SDK.
        include_once 'lib/froala_editor.php';

        // Store the image.
        try {
            $response = FroalaEditor_Image::upload('/assets/img/flashback');
            echo stripslashes(json_encode($response));
        } catch (Exception $e) {
            http_response_code(404);
        }
    }

    public function modification() {
        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification Flashback'
        ));
    }

    public function suppression() {
        $this->render($this->dirView . '/suppresion', array(
            'title' => 'Suppresion Flashback'
        ));
    }

    public function liste() {
        $this->render($this->dirView . '/liste', array(
            'title' => 'Liste Flashback'
        ));
    }

}
