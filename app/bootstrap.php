<?php

require_once dirname(__FILE__).'/../app/models/Dispatcher.php';
require_once dirname(__FILE__).'/../app/controllers/Controller.php';

function __autoload($class) {
    include 'app/models/'.$class.'.php';
}