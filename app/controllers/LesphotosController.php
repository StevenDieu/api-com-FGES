<?php

class LesphotosController extends Controller {

    private $dirView = 'lesphotos';
    
    public function index() {
        $this->render($this->dirView . '/index', array(
            'title' => 'Les photos'
        ));
    }
}
