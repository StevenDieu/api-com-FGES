<?php

class AvenirController extends Controller {

    private $dirView = 'avenir';
    
    public function index() {
        $this->render($this->dirView . '/index', array(
            'title' => 'A venir'
        ));
    }
}
