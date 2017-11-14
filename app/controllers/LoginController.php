<?php

class LoginController extends Controller
{

    private $error = null;
    private $userInfos;

    public function index()
    {
        if ((!empty($_POST))) {
            if ((isset($_POST["email"]) && !empty($_POST["email"])) && (isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"]))) {

                $user = new User();
                $user->setEmail($_POST["email"]);
                $user->setMotdepasse($_POST["motdepasse"]);

                if (($this->userInfos = $user->auth())) {
                    $this->initSession();
                    header("location: /");
                } else {
                    $this->error = "Il y a une erreur dans l'authentification.";
                }
            } else {
                $this->error = "Tous les champs sont obligatoires.";
            }
        }

        $this->render('/login/index', array(
            'title' => 'Connexion',
            'full_view' => true,
            'error' => $this->error
        ));
    }

    public function initSession()
    {
        $_SESSION["LOGIN"] = $this->userInfos;
    }

    public function disconnect()
    {
        session_destroy();
        header("location: /");
    }

}
