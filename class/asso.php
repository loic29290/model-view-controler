<?php

class Asso {
    use Assainit;
    
    private $id;
    private $nom;
    private $adresse;
    private $description;
    private $telephone;
    private $mail;
    private $image_url;
    
    public function __construct() {
        $this->setId(null);
        $this->setNom("");
        $this->setAdresse("");
        $this->setDescription("");
        $this->setTelephone("");
        $this->setMail("");
        $this->setImageUrl("");
    }
    
    public function setId(?int $id): void {
        $this->id=$id;
    }
    public function getId(): ?int {
        return $this->id;
    }
    public function setNom(string $nom): void {
        $this->nom=$nom;
    }
    public function getNom(): string {
        return $this->nom;
    }
    public function setAdresse(string $adresse): void {
        $this->adresse=$adresse;
    }
    public function getAdresse(): string {
        return $this->adresse;
    }
    public function setDescription(string $description): void {
        $this->description=$description;
    }
    public function getDescription(): string {
        return $this->description;
    }
    public function setTelephone(string $telephone): void {
        $this->telephone=$telephone;
    }
    public function getTelephone(): string {
        return $this->telephone;
    }
    public function setMail(string $mail): void {
        $this->mail=$mail;
    }
    public function getMail(): string {
        return $this->mail;
    }
    public function setImageUrl(string $image_url): void {
        $this->image_url=$image_url;
    }
    public function getImageUrl(): string {
        return $this->image_url;
    }
    
    public static function findById(int $id): ?Asso {
        $query = "SELECT * FROM asso WHERE id=:id";
        $sth = Db::getDbh()->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "asso");
        $sth->execute([
            ":id" => $id
        ]);
        $asso = $sth->fetch();
        if ($asso) {
            return $asso;
        }
        return null;
    }
    
    public static function findAll() {
        $query = "SELECT * FROM asso";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "asso");
    }
    
    public function checkPost(): bool {
        if (!isset($this->nom, $this->adresse, $this->description, $this->telephone, $this->mail, $this->image_url)) {
            return false;
        }
        if (empty($this->nom)) {
            return false;
        }
        if (empty($this->adresse)) {
            return false;
        }
        if (empty($this->description)) {
            return false;
        }
        if (empty($this->telephone)) {
            return false;
        }
        if (empty($this->mail)) {
            return false;
        }
        if (empty($this->image_url)) {
            return false;
        }
        return true;
    }
    
    public function loadFromPost(): void {
        $this->setNom($this->assainit($_POST['nom']));
        $this->setAdresse($this->assainit($_POST['adresse']));
        $this->setDescription($this->assainit($_POST['description']));
        $this->setTelephone($this->assainit($_POST['telephone']));
        $this->setMail($this->assainit($_POST['mail']));
        $this->setImageUrl($this->assainit($_POST['image_url']));
    }
    
    public function save(): void {
        $query = "INSERT INTO asso
        (nom, adresse, description, telephone, mail, image_url)
        VALUES
        (:nom, :adresse, :description, :telephone, :mail, :image_url)";
        $sth = Db::getDbh()->prepare($query);
        $sth->execute([
            ":nom" => $this->getNom(),
            ":adresse" => $this->getAdresse(),
            ":description" => $this->getDescription(),
            ":telephone" => $this->getTelephone(),
            ":mail" => $this->getMail(),
            ":image_url" => $this->getImageUrl(),
            ]);
    }
}