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
    private $created;

    function __construct() {
        parent::__construct();
    }
    
    public function addComment() {
        $dateTime = new DateTime($this->date);
        $this->date = $dateTime->format('Y-m-d H:i:s');

        $stmt = $this->dbh->prepare("INSERT INTO comment VALUES (null,?,?,?,?)");

        $stmt->bindParam(1, $this->type);
        $stmt->bindParam(2, $this->idType);
        $stmt->bindParam(3, $this->name);
        $stmt->bindParam(4, $this->text);

        $stmt->execute();

        $this->id = $this->dbh->lastInsertId();
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



}