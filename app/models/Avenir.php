<?php

class Avenir extends Database
{

    private $id;
    private $titre;
    private $description;
    private $dateDebut;
    private $dateFin;
    private $active;
    private $lieu;

    function __construct()
    {
        parent::__construct();
    }

    public function addAvenir()
    {


        $stmt = $this->dbh->prepare("INSERT INTO a_venir VALUES (null,?,?,?,?,?,?)");

        $stmt->bindParam(1, $this->titre);
        $stmt->bindParam(2, $this->description);
        $stmt->bindParam(3, $this->dateDebut);
        $stmt->bindParam(4, $this->dateFin);
        $stmt->bindParam(5, $this->active);
        $stmt->bindParam(6, $this->lieu);

        $stmt->execute();

        $this->id = $this->dbh->lastInsertId();
    }

    public function updateAvenir()
    {
        $dateTimeDebut = new DateTime($this->dateDebut);
        $dateTimeFin = new DateTime($this->dateFin);

        $this->dateDebut = $dateTimeDebut->format('Y-m-d H:i:s');
        $this->dateFin = $dateTimeFin->format('Y-m-d H:i:s');

        $stmt = $this->dbh->prepare("UPDATE a_venir
        SET titre = ?, description = ?, date_debut = ?, date_fin = ?,active = ?,lieu = ?
        WHERE id = ?");

        $stmt->bindParam(1, $this->titre);
        $stmt->bindParam(2, $this->description);
        $stmt->bindParam(3, $this->dateDebut);
        $stmt->bindParam(4, $this->dateFin);
        $stmt->bindParam(5, $this->active);
        $stmt->bindParam(6, $this->lieu);
        $stmt->bindParam(7, $this->id);

        $count = $stmt->execute();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAvenirById()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM a_venir WHERE id = ?');

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    function getFlashbackByIdActive()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM flashback WHERE id = ? and active = 1');

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getAllAvenir()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM a_venir order by date_debut desc');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function getAllAvenirActive()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM a_venir where active = 1 AND date_fin > CURDATE() order by date_debut asc');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        } else {
            return false;
        }
    }

    public function getAllFlashbackByPage($start, $limit)
    {
        $stmt = $this->dbh->prepare('SELECT id,titre,date_debut FROM flashback where active = 1 order by date_debut asc LIMIT ? OFFSET ?');
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

    public function countAvenir()
    {
        $stmt = $this->dbh->prepare('select count(id) as numberAvenir from a_venir where active = 1 AND date_fin > CURDATE()');

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function deleteAvenirById()
    {

        $stmt = $this->dbh->prepare('DELETE FROM a_venir
        WHERE id = ?');

        $stmt->bindParam(1, $this->id);
        $count = $stmt->execute();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getNextId()
    {
        $stmt = $this->dbh->prepare("SHOW TABLE STATUS FROM comin LIKE 'flashback'");

        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    function getId()
    {
        return $this->id;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getTitre()
    {
        return $this->titre;
    }

    function setTitre($titre)
    {
        $this->titre = $titre;
    }

    function getDescription()
    {
        return $this->description;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function getDateDebut()
    {
        return $this->dateDebut;
    }

    function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    function getDateFin()
    {
        return $this->dateFin;
    }

    function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    function getActive()
    {
        return $this->active;
    }

    function setActive($active)
    {
        $this->active = $active;
    }

    function getLieu()
    {
        return $this->lieu;
    }

    function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

}
