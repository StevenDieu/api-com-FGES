<?php

class AssistanceController extends Controller {

    private $dirView = 'assistance';

    public function index() {
        $message = "";
        $class = "";
        if ($_POST) {
            if (isset($_POST["lastName"]) && !empty($_POST["lastName"]) && isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["subject"]) && !empty($_POST["subject"]) && isset($_POST["message"]) && !empty($_POST["message"])) {
                $message = "Message envoyé";
                $class = "success";
            } else {
                $message = "Tous les champs sont obligatoires";
                $class = "error";
            }
        }
        $this->render($this->dirView . '/index', array(
            'message' => $message,
            'class' => $class,
            'full_view' => true,
        ));
    }

    public function envoyer() {
        
    }

}
