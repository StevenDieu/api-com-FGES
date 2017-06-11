<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Comment extends Database {

    private $id;
    private $type;
    private $idType;
    private $name;
    private $text;
    private $active;
    private $created;

    function __construct() {
        parent::__construct();
    }

    public function addComment() {
        $stmt = $this->dbh->prepare("INSERT INTO comment (id, type, id_type, name, text, active, created) VALUES  (null,?,?,?,?,0,CURRENT_TIMESTAMP)");

        $stmt->bindParam(1, $this->type);
        $stmt->bindParam(2, $this->idType);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->text);

        $stmt->execute();

        $this->id = $this->dbh->lastInsertId();
    }

    public function getCountCommentActiveByIdType() {
        $stmt = $this->dbh->prepare('select count(id) as numberComment from comment where active = 1 and type = ? and id_type = ? ');

        $stmt->bindParam(1, $this->type);
        $stmt->bindParam(2, $this->idType);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC)["numberComment"];
        } else {
            return 0;
        }
    }

    public function getAllCommentActiveById() {
        $stmt = $this->dbh->prepare('SELECT name,text,created from comment where active = 1 and type = ? and id_type = ? order by created desc');

        $stmt->bindParam(1, $this->type);
        $stmt->bindParam(2, $this->idType);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function getAllCommentByTypeId($select, $innerJoin) {
        $active = '';
        if ($this->active != null) {
            $active = 'AND c.active = ?';
        }

        $stmt = $this->dbh->prepare('SELECT c.id as id, c.id_type as idType, c.name as name, c.text as text, c.active as active, c.created as created, ' . $select . ' from comment c ' . $innerJoin . ' where type = ? ' . $active . ' order by created desc');

        $stmt->bindParam(1, $this->type);

        if ($this->active != null) {
            $stmt->bindParam(2, $this->active);
        }

        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function getArticleWithAllCommentsByIdType($select, $innerJoin) {


        $stmt = $this->dbh->prepare('SELECT c.id as id, c.name as name, c.text as text, c.active as active, c.created as created, ' . $select . ' from comment c ' . $innerJoin . ' where c.id_type = ? order by created desc');

        $stmt->bindParam(1, $this->idType);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function changeActive() {

        $stmt = $this->dbh->prepare('UPDATE comment SET active = ? WHERE id = ?');

        $stmt->bindParam(1, $this->active);
        $stmt->bindParam(2, $this->id);

        $count = $stmt->execute();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCountCommentInatifByType() {
        $stmt = $this->dbh->prepare('select count(id) as numberComment from comment where active = 0 and type = ?');

        $stmt->bindParam(1, $this->type);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC)["numberComment"];
        } else {
            return 0;
        }
    }

    public function deleteCommentById() {
        $stmt = $this->dbh->prepare('DELETE FROM comment WHERE id = ?');

        $stmt->bindParam(1, $this->id);

        $count = $stmt->execute();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getId() {
        return $this->id;
    }

    function getType() {
        return $this->type;
    }

    function getIdType() {
        return $this->idType;
    }

    function getName() {
        return $this->name;
    }

    function getText() {
        return $this->text;
    }

    function getCreated() {
        return $this->created;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setIdType($idType) {
        $this->idType = $idType;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setText($text) {
        $this->text = $text;
    }

    function setCreated($created) {
        $this->created = $created;
    }

    function getActive() {
        return $this->active;
    }

    function setActive($active) {
        $this->active = $active;
    }

}
