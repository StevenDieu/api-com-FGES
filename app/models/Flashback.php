<?php

class Flashback extends Database {

    private $id;
    private $titre;
    private $description;
    private $date;
    private $active;

    function __construct() {
        parent::__construct();
    }

    public function addFlashback() {
        $dateTime = new DateTime($this->date);
        $this->date = $dateTime->format('Y-m-d H:i:s');

        $stmt = $this->dbh->prepare("INSERT INTO flashback VALUES (null,?,?,?,?)");

        $stmt->bindParam(1, $this->titre);
        $stmt->bindParam(2, $this->description);
        $stmt->bindParam(3, $this->date);
        $stmt->bindParam(4, $this->active);

        $stmt->execute();

        $this->id = $this->dbh->lastInsertId();
    }

    public function updateFlashback() {
        $dateTime = new DateTime($this->date);
        $this->date = $dateTime->format('Y-m-d H:i:s');

        $stmt = $this->dbh->prepare("UPDATE flashback
        SET titre = ?, description = ?, date_debut = ?, active = ?
        WHERE id = ?");

        $stmt->bindParam(1, $this->titre);
        $stmt->bindParam(2, $this->description);
        $stmt->bindParam(3, $this->date);
        $stmt->bindParam(4, $this->active);
        $stmt->bindParam(5, $this->id);

        $count = $stmt->execute();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getFlashbackById() {
        $stmt = $this->dbh->prepare('SELECT * FROM flashback WHERE id = ?');

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    function getFlashbackByIdActive() {
        $stmt = $this->dbh->prepare('SELECT * FROM flashback WHERE id = ? and active = 1');

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getAllFlashback() {
        $stmt = $this->dbh->prepare('SELECT * FROM flashback');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function getAllFlashbackByPage($start, $limit) {
        $stmt = $this->dbh->prepare('SELECT id,titre,date_debut FROM flashback where active = 1 order by date_debut desc LIMIT ? OFFSET ?');
        $startInt = intval($start);
        $stmt->bindParam(1, $limit, PDO::PARAM_INT);
        $stmt->bindParam(2, $startInt, PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function countFlashback() {
        $stmt = $this->dbh->prepare('select count(id) as numberFlashback from flashback where active = 1');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC)["numberFlashback"];
        } else {
            return false;
        }
    }

    public function deleteFlashbackById() {

        $stmt = $this->dbh->prepare('DELETE FROM flashback
        WHERE id = ?');

        $stmt->bindParam(1, $this->id);
        $count = $stmt->execute();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getNextId() {
        $stmt = $this->dbh->prepare("SHOW TABLE STATUS FROM comfges LIKE 'flashback'");

        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC)["Auto_increment"];
        } else {
            return false;
        }
    }

    function getId() {
        return $this->id;
    }

    function getTitre() {
        return $this->titre;
    }

    function getDescription() {
        return $this->description;
    }

    function getDate() {
        return $this->date;
    }

    function getActive() {
        return $this->active;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setActive($active) {
        $this->active = $active;
    }

}
