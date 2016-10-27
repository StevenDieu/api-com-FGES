<?php

class LesphotosController extends Controller {

    private $dirView = 'lesphotos';

    public function creation() {

        $this->render($this->dirView . '/creation', array(
            'title' => 'Création les photos',
        ));
    }

}
