<?php

class User extends Database {

    private $email;
    private $motdepasse;
    private $role;

    function __construct() {
        parent::__construct();
    }

    public function addUser() {
        $motdepasse = md5($this->motdepasse);

        $stmt = $this->dbh->prepare("INSERT INTO user VALUES (?,?,?)");

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $motdepasse);
        $stmt->bindParam(3, $this->role);

        $stmt->execute();

        return $this->dbh->lastInsertId();
    }

    public function existUser() {
        $stmt = $this->dbh->prepare('select email from user where email = ?');
        
        $stmt->bindParam(1, $this->email);
        
        $stmt->execute();
        if($stmt->rowCount()) {
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

    /**
     * @return mixed
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role) {
        $this->role = $role;
    }

}
