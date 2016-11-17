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
    
    public function creation(){
        $this->render($this->dirView . '/creation', array(
            'title' => 'Création "A venir"',
            'error' => $this->error,
            'success' => $this->success,
            'flashback' => $this->avenirReturn,
            'nextId' => 1, // nextId
            'froala' => true
        ));        
    }
    
    public function modification($id = null, $created = false) {
        $this->render($this->dirView . '/modification', array(
            'title' => 'Modification "A venir"',
            'error' => $this->error,
            'success' => $this->success,
            //'arrayJs' => $arrayJs,
            //'flashbacks' => $flashbacks,
            //'flashback' => $flashback,
            'froala' => true //$froala
        ));        
    }    
    
    public function suppression(){
        $this->render($this->dirView . '/suppression', array(
            'title' => 'Suppresion "A venir"',
            'error' => $this->error,
            'success' => $this->success,
            'avenir' => null //$flashbacks
        ));
    }
    
}
