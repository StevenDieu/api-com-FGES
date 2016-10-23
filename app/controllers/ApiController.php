<?php

class ApiController extends Controller {

    private $dirView = 'api/flashback';
    
    public function listeflashback() {
        $this->render($this->dirView . '/listeFlashback', array(
            'full_view' => true,
            'title' => 'A venir'
        ));
    }

    public function flashback() {
        header('Content-type: text/plain');

        $jsonFlashbacks = array();
        foreach ((new Flashback())->getAllFlashback() as $flashbacks){
            $jsonFlashback["titre"] = $flashbacks["titre"];
            $jsonFlashback["date_debut"] = $flashbacks["date_debut"];
            $jsonFlashback["description"] = $flashbacks["description"];
            array_push($jsonFlashbacks, $jsonFlashback);
        }
        
        echo json_encode($jsonFlashbacks);
        $this->render($this->dirView . '/flashback', array(
            'full_view' => true,
            'title' => 'A venir'
        ));
    }

}
