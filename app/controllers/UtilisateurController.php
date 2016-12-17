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
        $users = null;
        $user = null;
        $userController = new User();

        if ($created == true) {
            $this->success = "L'utilisateur à bien été créé.";
        }
        if (isset($id) && !empty($id)) {
            $userController->setId($id);
            
            if ((!empty($_POST))) {
                if ((isset($_POST["email"]) && !empty($_POST["email"])) &&
                        isset($_POST["motdepasse"]) &&
                        (
                        isset($_POST["avenir"]) && !empty($_POST["avenir"]) ||
                        isset($_POST["lesphotos"]) && !empty($_POST["lesphotos"]) ||
                        isset($_POST["flashback"]) && !empty($_POST["flashback"]) ||
                        isset($_POST["admin"]) && !empty($_POST["admin"])
                        )
                ) {
                    $userController->setEmail($_POST["email"]);
                    if ($userController->existUser()) {
                        
                        if (isset($_POST["avenir"])) {
                            $userController->setAvenir($_POST["avenir"]);
                        } else {
                            $userController->setAvenir('0');
                        }
                        if (isset($_POST["lesphotos"])) {
                            $userController->setLesphotos($_POST["lesphotos"]);
                        } else {
                            $userController->setLesphotos('0');
                        }
                        if (isset($_POST["flashback"])) {
                            $userController->setFlashback($_POST["flashback"]);
                        } else {
                            $userController->setFlashback('0');
                        }
                        if (isset($_POST["admin"])) {
                            $userController->setAdmin($_POST["admin"]);
                        } else {
                            $userController->setAdmin('0');
                        }

                        if (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"])) {
                            $userController->setMotdepasse($_POST["motdepasse"]);
                            $userController->updateUser();
                        }else{
                            $userController->updateUserWithoutPassword();
                        }
                        

                        if ($id > 0) {
                            $this->success = "Utilisateur modifié.";
                        } else {
                            $this->error = "Il y a une erreur dans la modification d'un utilisateur.";
                        }
                    } else {
                        $this->error = "L'utilisateur n'existe pas.";
                    }
                } else {
                    $this->error = "Tous les champs sont obligatoires.";
                }
            }
            
            $user = $userController->getUserById();
            $user["isUser"] = true;
        } else {
            $users = $userController->getAllUser();
        }
        $arrayJs = array("utilisateur/modification");
        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification User',
            'error' => $this->error,
            'arrayJs' => $arrayJs,
            'success' => $this->success,
            'utilisateurs' => $users,
            'utilisateur' => $user,
        ));
    }

    public function suppression() {
        $utilisateurConstruct = new User();

         if ((!empty($_POST))) {
            if ((isset($_POST["idUser"]) && !empty($_POST["idUser"]))) {

                $utilisateurConstruct->setId($_POST["idUser"]);
                if ($utilisateurConstruct->deleteUserById()) {
                    $this->success = "L'utilisateur à bien été supprimé.";
                } else {
                    $this->error = "Cette utilisateur n'existe pas";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }
        
        $utilisateurs = $utilisateurConstruct->getAllUser();

        $this->render($this->dirView . '/suppression', array(
            'title' => 'Suppression Utilisateur',
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
