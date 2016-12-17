<?php

class AvenirController extends Controller {

    private $dirView = 'avenir';
    private $error = null;
    private $avenirReturn = null;
    private $success = null;

    public function index() {
        $this->render($this->dirView . '/index', array(
            'title' => 'A venir'
        ));
    }

    public function creation() {
        $avenir = new Avenir();

        if ((!empty($_POST))) {
            if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                    (isset($_POST["description"]) && !empty($_POST["description"])) &&
                    (isset($_POST["dateFin"]) && !empty($_POST["dateFin"])) &&
                    (isset($_POST["dateDebut"]) && !empty($_POST["dateDebut"])) &&
                    (isset($_POST["lieu"]) && !empty($_POST["lieu"])) &&
                    (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0))) {

                $avenir->setTitre($_POST["titre"]);
                $avenir->setDescription($_POST["description"]);
                $avenir->setActive($_POST["active"]);
                $avenir->setDateDebut($_POST["dateDebut"]);
                $avenir->setDateFin($_POST["dateFin"]);
                $avenir->setLieu($_POST["lieu"]);

                $avenir->addAvenir();

                $id = $avenir->getId();
                if ($id > 0) {
                    header('Location: /avenir/modification/' . $id . '/true');
                } else {
                    $this->error = "Il y a une erreur dans l'ajout d'un \"a venir\".";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }

        if ((isset($_POST["titre"]) && isset($_POST["description"]) && isset($_POST["active"]) && isset($_POST["dateFin"]) && isset($_POST["dateDebut"]) && isset($_POST["lieu"]))) {
            $this->avenirReturn = new Avenir();
            $this->avenirReturn->setTitre($_POST["titre"]);
            $this->avenirReturn->setDescription($_POST["description"]);
            $this->avenirReturn->setActive($_POST["active"]);
            $this->avenirReturn->setDateDebut($_POST["dateDebut"]);
            $this->avenirReturn->setDateFin($_POST["dateFin"]);
            $this->avenirReturn->setLieu($_POST["lieu"]);
        }

        $this->render($this->dirView . '/creation', array(
            'title' => 'Création à venir',
            'error' => $this->error,
            'success' => $this->success,
            'avenir' => $this->avenirReturn,
        ));
    }

    public function modification($id = null, $created = false) {
        $avenirs = null;
        $avenir = null;
        $avenirConstruct = new Avenir();

        if ($created == true) {
            $this->success = "L'article à venir à bien été créé.";
        }
        if (isset($id) && !empty($id)) {
            $avenirConstruct->setId($id);

            if ((!empty($_POST))) {
                if ((isset($_POST["titre"]) && !empty($_POST["titre"])) &&
                        (isset($_POST["description"]) && !empty($_POST["description"])) &&
                        (isset($_POST["dateFin"]) && !empty($_POST["dateFin"])) &&
                        (isset($_POST["dateDebut"]) && !empty($_POST["dateDebut"])) &&
                        (isset($_POST["lieu"]) && !empty($_POST["lieu"])) &&
                        (isset($_POST["active"]) && (!empty($_POST["active"]) || $_POST["active"] == 0))) {

                    $avenirConstruct->setTitre($_POST["titre"]);
                    $avenirConstruct->setDescription($_POST["description"]);
                    $avenirConstruct->setActive($_POST["active"]);
                    $avenirConstruct->setDateDebut($_POST["dateDebut"]);
                    $avenirConstruct->setDateFin($_POST["dateFin"]);
                    $avenirConstruct->setLieu($_POST["lieu"]);

                    if ($avenirConstruct->updateAvenir()) {
                        $this->success = "L'article à venir à bien été modifié.";
                    } else {
                        $this->error = "Il y a une erreur dans la modification de l'article à venir.";
                    }
                } else {
                    $this->error = "Tous les champs sont obligatoires.";
                }
            }
            $avenir = $avenirConstruct->getAvenirById();
            $dateTimeDebut = new DateTime($avenir["date_debut"]);
            $dateTimeFin = new DateTime($avenir["date_fin"]);

            $avenir["date_debut"] = $dateTimeDebut->format('m/d/Y');
            $avenir["date_fin"] = $dateTimeFin->format('m/d/Y');
        } else {
            $avenirs = $avenirConstruct->getAllAvenir();
        }
        $arrayJs = array("avenir/modification");
        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification Flashback',
            'error' => $this->error,
            'success' => $this->success,
            'arrayJs' => $arrayJs,
            'avenirs' => $avenirs,
            'avenir' => $avenir,
        ));
    }

    public function suppression() {
        $this->render($this->dirView . '/suppression', array(
            'title' => 'Suppresion "A venir"',
            'error' => $this->error,
            'success' => $this->success,
            'avenir' => null //$flashbacks
        ));
    }

}
