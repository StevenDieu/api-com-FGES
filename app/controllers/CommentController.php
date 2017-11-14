<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentaireController
 *
 * @author steven
 */
class CommentController extends Controller
{

    public function comment($param = null, $param2 = null, $param3 = null)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case "PATCH":
                if ($param2 == 'active') {
                    $this->actif($param, $param3);
                }
                break;
            case "GET":
                switch ($param) {
                    case TypeComment::avenir :
                        $this->articleWithAllComment($param2, 'av.titre as titre, av.description as description', 'inner join a_venir av on c.id_type = av.id', false);
                        break;
                    case TypeComment::flashback :
                        $this->articleWithAllComment($param2, 'f.titre as titre, f.description as description', 'inner join flashback f on c.id_type = f.id', false);
                        break;
                    case TypeComment::photo :
                        $this->articleWithAllComment($param2, 'p.url as url', 'inner join photos p on c.id_type = p.id', true);
                        break;
                    default:
                        break;
                }
                break;
            case "DELETE":
                $this->deleteComment($param);
                break;
            default:
                break;
        }
    }

    //REST : comment/$id/active/$active
    private function actif($id = null, $active = null)
    {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");

        if ($id != null && $active != null) {
            $commentController = new Comment();
            $commentController->setId($id);
            $commentController->setActive($active);
            if ($commentController->changeActive()) {
                http_response_code(200);
                $json["result"] = "Changement pris en compte";
            } else {
                http_response_code(400);
                $json["result"] = "Aie ! un problème est survenue... Recharger votre page.";
            }
        } else {
            http_response_code(400);
            $json["result"] = "Aie ! un problème est survenue... Recharger votre page.";
        }
        echo json_encode($json);
    }

    //REST : comment/avenirComments/$id
    public function articleWithAllComment($idType, $select, $innerJoin, $url)
    {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");

        if ($idType != null) {
            $commentController = new Comment();
            $commentController->setIdType($idType);
            $result = $commentController->getArticleWithAllCommentsByIdType($select, $innerJoin);
            if ($result != null) {
                $jsonListe = array();
                if ($url) {
                    $jsonListe["url"] = "http://" . $_SERVER['HTTP_HOST'] . $result[0]["url"];
                } else {
                    $jsonListe["titre"] = $result[0]["titre"];
                    $jsonListe["description"] = $result[0]["description"];
                }

                $listComment = array();

                foreach ($result as $elt) {
                    $array["id"] = $elt["id"];
                    $array["name"] = $elt["name"];
                    $array["text"] = $elt["text"];
                    $array["active"] = $elt["active"];

                    $created = new DateTime($elt["created"]);
                    $array["created"] = $this->format($created->format('d F Y'));

                    array_push($listComment, $array);
                }
                $jsonListe["comments"] = $listComment;
                http_response_code(200);
                $json["result"] = $jsonListe;
            } else {
                http_response_code(400);
                $json["result"] = "Aie ! un problème est survenue... Recharger votre page.";
            }
        } else {
            http_response_code(400);
            $json["result"] = "Aie ! un problème est survenue... Recharger votre page.";
        }
        echo json_encode($json);
    }

    //REST : comment/$id
    private function deleteComment($id = null)
    {
        header('Content-type: text/plain');
        header("Access-Control-Allow-Origin: *");

        if ($id != null) {
            $commentController = new Comment();
            $commentController->setId($id);
            if ($commentController->deleteCommentById()) {
                http_response_code(200);
                $json["result"] = "Commentaire supprimé avec succés.";
            } else {
                http_response_code(400);
                $json["result"] = "Aie ! un problème est survenue... Recharger votre page.";
            }
        } else {
            http_response_code(400);
            $json["result"] = "Aie ! un problème est survenue... Recharger votre page.";
        }

        echo json_encode($json);
    }

}
