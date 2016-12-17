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

                $dateTimeDebut = new DateTime($_POST["dateDebut"]);
                $dateTimeFin = new DateTime($_POST["dateFin"]);

                $dateTimeDebut->setTime($_POST["dateDebutHeure"], $_POST["dateDebutMinute"], 0);
                $dateTimeFin->setTime($_POST["dateFinHeure"], $_POST["dateFinMinute"], 0);

                $avenir->setTitre($_POST["titre"]);
                $avenir->setDescription($_POST["description"]);
                $avenir->setActive($_POST["active"]);
                $avenir->setDateDebut($dateTimeDebut->format('Y-m-d H:i:s'));
                $avenir->setDateFin($dateTimeFin->format('Y-m-d H:i:s'));
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

                    $dateTimeDebut = new DateTime($_POST["dateDebut"]);
                    $dateTimeFin = new DateTime($_POST["dateFin"]);

                    $dateTimeDebut->setTime($_POST["dateDebutHeure"], $_POST["dateDebutMinute"], 0);
                    $dateTimeFin->setTime($_POST["dateFinHeure"], $_POST["dateFinMinute"], 0);

                    $avenirConstruct->setTitre($_POST["titre"]);
                    $avenirConstruct->setDescription($_POST["description"]);
                    $avenirConstruct->setActive($_POST["active"]);
                    $avenirConstruct->setDateDebut($dateTimeDebut->format('Y-m-d H:i:s'));
                    $avenirConstruct->setDateFin($dateTimeFin->format('Y-m-d H:i:s'));
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
            $avenir["date_debut_heure"] = $dateTimeDebut->format('H');
            $avenir["date_debut_minute"] = $dateTimeDebut->format('i');

            $avenir["date_fin"] = $dateTimeFin->format('m/d/Y');
            $avenir["date_fin_heure"] = $dateTimeFin->format('H');
            $avenir["date_fin_minute"] = $dateTimeFin->format('i');
        } else {
            $avenirs = $avenirConstruct->getAllAvenir();
        }
        $arrayJs = array("avenir/modification");
        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification à venir',
            'error' => $this->error,
            'success' => $this->success,
            'arrayJs' => $arrayJs,
            'avenirs' => $avenirs,
            'avenir' => $avenir,
        ));
    }

    public function suppression() {
        $avenirConstruct = new Avenir();

        if ((!empty($_POST))) {
            if ((isset($_POST["idAvenir"]) && !empty($_POST["idAvenir"]))) {

                $avenirConstruct->setId($_POST["idAvenir"]);
                if ($avenirConstruct->deleteAvenirById()) {
                    $this->success = "Ce \"à venir\" à bien été supprimé.";
                } else {
                    $this->error = "Ce \"à venir\" n'existe pas";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }
        $avenirs = $avenirConstruct->getAllAvenir();

        $this->render($this->dirView . '/suppression', array(
            'title' => 'Suppression à venir',
            'error' => $this->error,
            'success' => $this->success,
            'avenirs' => $avenirs
        ));
    }

    public function liste() {

        $avenirs = (new Avenir())->getAllAvenir();
        
        $this->render($this->dirView . '/liste', array(
            'title' => 'Liste dess avenirs',
            'avenirs' => $avenirs,
        ));
    }

}
