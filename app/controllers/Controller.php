<?php

class Controller
{

    public function render($view, $data = array())
    {

        $data = array_merge($data, $this->getCountComment());

        if (isset($data['full_view']) && $data['full_view']) {
            return include_once 'app/views/' . $view . '.php';
        }
        include_once 'app/views/partials/head.inc.php';
        include_once 'app/views/partials/menu.inc.php';
        include_once 'app/views/' . $view . '.php';
        include_once 'app/views/partials/footer.inc.php';
    }

    private function getCountComment()
    {
        $comment = new Comment();

        $comment->setType(TypeComment::avenir);
        $arrayComment = $comment->getCountCommentInatifByType();
        $countCommentInatifAvenir = $arrayComment["numberComment"];
        $comment->setType(TypeComment::flashback);
        $arrayComment = $comment->getCountCommentInatifByType();
        $countCommentInatifFlashback = $arrayComment["numberComment"];
        $comment->setType(TypeComment::photo);
        $arrayComment = $comment->getCountCommentInatifByType();
        $countCommentInatifPhoto = $arrayComment["numberComment"];

        return array(
            'countCommentInatifAvenir' => $countCommentInatifAvenir,
            'countCommentInatifFlashback' => $countCommentInatifFlashback,
            'countCommentInatifPhoto' => $countCommentInatifPhoto,
        );
    }

    public function renderApi($view, $data = array())
    {

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
    public function format($format)
    {
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, $format);
    }

}
