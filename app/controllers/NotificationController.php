<?php

class NotificationController extends Controller {

    private $dirView = 'notification';

    public function index() {
        $this->render($this->dirView . '/index', array(
            'title' => 'Gestion Notification'
        ));
    }

}
