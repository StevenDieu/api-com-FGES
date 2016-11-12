<?php

class User extends Database {

    private $id;
    private $email;
    private $motdepasse;
    private $avenir;
    private $lesphotos;
    private $flashback;
    private $admin;

    function __construct() {
        parent::__construct();
    }

    public function addUser() {
        $motdepasse = md5($this->motdepasse);

        $stmt = $this->dbh->prepare("INSERT INTO user VALUES (null,?,?,?,?,?,?)");

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $motdepasse);
        $stmt->bindParam(3, $this->avenir);
        $stmt->bindParam(4, $this->lesphotos);
        $stmt->bindParam(5, $this->flashback);
        $stmt->bindParam(6, $this->admin);

        $stmt->execute();

        $this->id = $this->dbh->lastInsertId();
    }

    public function existUser() {
        $stmt = $this->dbh->prepare('select email from user where email = ?');

        $stmt->bindParam(1, $this->email);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function auth() {
        $motdepasse = md5($this->motdepasse);

        $stmt = $this->dbh->prepare(''
                . 'SELECT * '
                . 'FROM user '
                . 'WHERE email = ? and motdepasse = ?');

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $motdepasse);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getUserByEmail() {
        $stmt = $this->dbh->prepare('SELECT * 
                FROM user 
                WHERE email = ?');

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getUserIdById() {
        $stmt = $this->dbh->prepare('SELECT * 
                FROM user 
                WHERE email = ?');

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        if (count($stmt)) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMotdepasse() {
        return $this->motdepasse;
    }

    /**
     * @param mixed $motdepasse
     */
    public function setMotdepasse($motdepasse) {
        $this->motdepasse = $motdepasse;
    }

    function getAvenir() {
        return $this->avenir;
    }

    function getLesphotos() {
        return $this->lesphotos;
    }

    function getFlashback() {
        return $this->flashback;
    }

    function getAdmin() {
        return $this->admin;
    }

    function setAvenir($avenir) {
        $this->avenir = $avenir;
    }

    function setLesphotos($lesphotos) {
        $this->lesphotos = $lesphotos;
    }

    function setFlashback($flashback) {
        $this->flashback = $flashback;
    }

    function setAdmin($admin) {
        $this->admin = $admin;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

}
