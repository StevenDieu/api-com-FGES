<?php

class Controller {

    public function render($view, $data = []) {

        $data = array_merge($data, $this->getCountComment());

        if (isset($data['full_view']) && $data['full_view']) {
            return include_once 'app/views/' . $view . '.php';
        }
        include_once 'app/views/partials/head.inc.php';
        include_once 'app/views/partials/menu.inc.php';
        include_once 'app/views/' . $view . '.php';
        include_once 'app/views/partials/footer.inc.php';
    }

    public function renderApi($view, $data = []) {

        if (isset($data['full_view']) && $data['full_view']) {
            return include_once 'app/views/' . $view . '.php';
        }
        include_once 'app/views/partials/head.inc.php';
        include_once 'app/views/partials/menu.inc.php';
        include_once 'app/views/' . $view . '.php';
        include_once 'app/views/partials/footer.inc.php';
    }

    /**
     * Change date EN to date FR
     * 
     * @param type $format
     * @return type
     */
    public function format($format) {
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, $format);
    }

    private function getCountComment() {
        $comment = new Comment();

        $comment->setType(TypeComment::avenir);
        $countCommentInatifAvenir = $comment->getCountCommentInatifByType();
        $comment->setType(TypeComment::flashback);
        $countCommentInatifFlashback = $comment->getCountCommentInatifByType();
        $comment->setType(TypeComment::photo);
        $countCommentInatifPhoto = $comment->getCountCommentInatifByType();

        return array(
            'countCommentInatifAvenir' => $countCommentInatifAvenir,
            'countCommentInatifFlashback' => $countCommentInatifFlashback,
            'countCommentInatifPhoto' => $countCommentInatifPhoto,
        );
    }

}
