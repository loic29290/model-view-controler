<?php

class User {
    use Assainit;
    
    private $id;
    private $login;
    private $password;
    private $admin;
    
    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
    
    public function getLogin(): string {
        return $this->login;
    }
    public function setLogin(string $login) {
        $this->login = $login;
    }
    
    public function getPassword(): string {
        return $this->password;
    }
    public function setPassword(string $password) {
        $this->password = $password;
    }
    
    public function getAdmin(): bool {
        return $this->admin;
    }
    public function setAdmin(bool $admin) {
        $this->admin = $admin;
    }
    
    public function loadFromPost(): void {
        $this->setLogin($this->assainit($_POST['login']));
        $this->setPassword($_POST['pwd1']);
    }
    
    public function checkPost(): bool {
        if (!isset($this->login, $this->password)) {
            return false;
        }
        if (empty($this->login)) {
            return false;
        }
        if (!filter_var($this->login, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
    
    public function checkPassword($pwd): bool {
        return password_verify($pwd, $this->getPassword());
    }
    
    public function findById(): void {
        if (isset($this->id)) {
            $query = "SELECT * FROM user WHERE id=:id";
            $sth = Db::getDbh()->prepare($query);
            $sth->execute([
                ":id" => $this->id
            ]);
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $this->setLogin($row['login']);
                $this->setAdmin($row['admin']);
                $this->setPassword($row['password']);
            }
            
            //$this = $sth->fetch(PDO::FETCH_CLASS, "User");
        }
    }
    
    public static function getFromId($id) {
        $query = "SELECT * FROM user WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $sth->execute([
            ":id" => $id
        ]);
        return $sth->fetch();
    }
    
    public static function getFromLogin($login) {
        $query = "SELECT * FROM user WHERE login=:login";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User'); 
        $sth->execute([
            ":login" => $login
        ]);
        return $sth->fetch();
    }
    
    public function save() {
        $query = "INSERT INTO user (login, password) VALUES (:login, :password)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":login" => $this->getLogin(),
            ":password" => password_hash($this->getPassword(), PASSWORD_DEFAULT)
        ]);
    }
}