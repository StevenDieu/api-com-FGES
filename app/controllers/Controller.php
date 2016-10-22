<?php

class Controller {

    public function render($view, $data = []) {

        if (isset($data['full_view']) && $data['full_view']) {
            return include_once 'app/views/' . $view . '.php';
        }
        include_once 'app/views/partials/head.inc.php';
        include_once 'app/views/partials/menu.inc.php';
        include_once 'app/views/' . $view . '.php';
        include_once 'app/views/partials/footer.inc.php';
    }


}
