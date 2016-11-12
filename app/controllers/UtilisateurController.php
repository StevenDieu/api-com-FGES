<?php

class UtilisateurController extends Controller {

    private $dirView = 'utilisateur';
    private $error = null;
    private $success = null;

    public function creation() {
        $user = new User();

        if ((!empty($_POST))) {
            if ((isset($_POST["email"]) && !empty($_POST["email"])) &&
                    (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"])) &&
                    (
                    isset($_POST["avenir"]) && !empty($_POST["avenir"]) ||
                    isset($_POST["lesphotos"]) && !empty($_POST["lesphotos"]) ||
                    isset($_POST["flashback"]) && !empty($_POST["flashback"]) ||
                    isset($_POST["admin"]) && !empty($_POST["admin"])
                    )
            ) {
                $user->setEmail($_POST["email"]);
                if (!$user->existUser()) {
                    $user->setMotdepasse($_POST["motdepasse"]);
                    if (isset($_POST["avenir"])) {
                        $user->setAvenir($_POST["avenir"]);
                    } else {
                        $user->setAvenir('0');
                    }
                    if (isset($_POST["lesphotos"])) {
                        $user->setLesphotos($_POST["lesphotos"]);
                    } else {
                        $user->setLesphotos('0');
                    }
                    if (isset($_POST["flashback"])) {
                        $user->setFlashback($_POST["flashback"]);
                    } else {
                        $user->setFlashback('0');
                    }
                    if (isset($_POST["admin"])) {
                        $user->setAdmin($_POST["admin"]);
                    } else {
                        $user->setAdmin('0');
                    }

                    $user->addUser();
                    $id = $user->getId();

                    if ($id > 0) {
                        header('Location: /utilisateur/modification/' . $id . '/true');
                    } else {
                        $this->error = "Il y a une erreur dans l'ajout d'un utilisateur.";
                    }
                } else {
                    $this->error = "L'utilisateur existe déja.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }

        if (isset($_POST["email"])) {
            $user->setEmail($_POST["email"]);
        }
        if (isset($_POST["motdepasse"])) {
            $user->setMotdepasse($_POST["motdepasse"]);
        }
        if (isset($_POST["avenir"])) {
            $user->setAvenir($_POST["avenir"]);
        }
        if (isset($_POST["lesphotos"])) {
            $user->setLesphotos($_POST["lesphotos"]);
        }
        if (isset($_POST["flashback"])) {
            $user->setFlashback($_POST["flashback"]);
        }
        if (isset($_POST["admin"])) {
            $user->setAdmin($_POST["admin"]);
        }

        $this->render($this->dirView . '/creation', array(
            'title' => 'Création Utilsiateur',
            'error' => $this->error,
            'success' => $this->success,
            'utilisateur' => $user
        ));
    }

    public function modification($id = null, $created = false) {
        $utilisateurs = null;
        $utilisateur = null;

        if ($created == true) {
            $this->success = "L'utilisateur à bien été créé.";
        }
        if ((!empty($_POST))) {
            if ((isset($_POST["email"]) && !empty($_POST["email"])) &&
                    (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"])) &&
                    (
                    isset($_POST["avenir"]) && !empty($_POST["avenir"]) ||
                    isset($_POST["lesphotos"]) && !empty($_POST["lesphotos"]) ||
                    isset($_POST["flashback"]) && !empty($_POST["flashback"]) ||
                    isset($_POST["admin"]) && !empty($_POST["admin"])
                    )
            ) {
                $user->setEmail($_POST["email"]);
                if (!$user->existUser()) {
                    $user->setMotdepasse($_POST["motdepasse"]);
                    if (isset($_POST["avenir"])) {
                        $user->setAvenir($_POST["avenir"]);
                    } else {
                        $user->setAvenir('0');
                    }
                    if (isset($_POST["lesphotos"])) {
                        $user->setLesphotos($_POST["lesphotos"]);
                    } else {
                        $user->setLesphotos('0');
                    }
                    if (isset($_POST["flashback"])) {
                        $user->setFlashback($_POST["flashback"]);
                    } else {
                        $user->setFlashback('0');
                    }
                    if (isset($_POST["admin"])) {
                        $user->setAdmin($_POST["admin"]);
                    } else {
                        $user->setAdmin('0');
                    }

                    $user->addUser();
                    $id = $user->getId();

                    if ($id > 0) {
                        header('Location: /utilisateur/modification/' . $id . '/true');
                    } else {
                        $this->error = "Il y a une erreur dans l'ajout d'un utilisateur.";
                    }
                } else {
                    $this->error = "L'utilisateur existe déja.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
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
        $utilisateurConstruct = new Utilisateur();

        $utilisateurs = $utilisateurConstruct->getAllUser();

        $this->render($this->dirView . '/suppresion', array(
            'title' => 'Suppresion Utilisateur',
            'error' => $this->error,
            'success' => $this->success,
            'utilisateurs' => $utilisateurs
        ));
    }

    public function liste() {
        $utilisateurConstruct = new User();
        $utilisateurs = $utilisateurConstruct->getAllUser();

        $this->render($this->dirView . '/liste', array(
            'title' => 'Liste Utilisateur',
            'utilisateurs' => $utilisateurs,
        ));
    }

}
