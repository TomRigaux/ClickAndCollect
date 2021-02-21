<?php

class Utilisateur{
    
    // Connexion
    private $connexion;
    private $table = "utilisateur";

    // Object properties
    public $numero;
    public $nom;
    public $prenom;
    public $mdp;
    public $adresse;
    public $ville;
    public $codepostal;
    public $email;
    public $tel;
    public $datenaiss;

    /**
     * Constructeur avec $db pour la connexcion a la base de donnees
     * 
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des Utilisateurs
     * 
     * @return void
     */
    public function lire(){
        $sql = "Select numero, nom, prenom, adresse, ville, codepostal, email, tel, datenaiss From " . $this->table . " ORDER BY numero DESC";

        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }

    /**
     * Lire un utilisateur
     * 
     * @return void
     */
    public function lireUn($num){
        $sql = "Select numero, nom, prenom, adresse, ville, codepostal, email, tel, datenaiss From " . $this->table . " Where numero = " . $num . " LIMIT 1";

        $query = $this->connexion->prepare($sql);

        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->numero = $row['numero'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->adresse = $row['adresse'];
        $this->ville = $row['ville'];
        $this->codepostal = $row['codepostal'];
        $this->email = $row['email'];
        $this->tel = $row['tel'];
        $this->datenaiss = $row['datenaiss'];
    }

    /**
     * Creer un utilisateur
     * 
     * @return void
     */
    public function creer(){
        $sql = "INSERT INTO " . $this->table . " SET nom=:nom, prenom=:prenom, mdp=:mdp, adresse=:adresse, ville=:ville, codepostal=:codepostal, email=:email, tel=:tel, datenaiss=:datenaiss";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->mdp=htmlspecialchars(strip_tags($this->mdp));
        $this->adresse=htmlspecialchars(strip_tags($this->adresse));
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->codepostal=htmlspecialchars(strip_tags($this->codepostal));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->tel=htmlspecialchars(strip_tags($this->tel));
        $this->datenaiss=htmlspecialchars(strip_tags($this->datenaiss));

        // Ajout des données protégées
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":prenom", $this->prenom);
        $query->bindParam(":mdp", $this->mdp);
        $query->bindParam(":adresse", $this->adresse);
        $query->bindParam(":ville", $this->ville);
        $query->bindParam(":codepostal", $this->codepostal);
        $query->bindParam(":email", $this->email);
        $query->bindParam(":tel", $this->tel);
        $query->bindParam(":datenaiss", $this->datenaiss);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Supprimer un utilisateur
     * 
     * @return void
     */
    public function supprimer($numsuppr){
        $sql = "DELETE FROM " . $this->table . " WHERE numero = " . $numsuppr;
        
        $query = $this->connexion->prepare($sql);

        if ($query->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Mettre a jour un utilisateur
     * 
     * @return void
     */
    public function update($nummodif){
        $sql = "Update " . $this->table . " SET nom=:nom, prenom=:prenom, mdp=:mdp, adresse=:adresse, ville=:ville, codepostal=:codepostal, email=:email, tel=:tel, datenaiss=:datenaiss WHERE numero=" . $nummodif;

        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->mdp=htmlspecialchars(strip_tags($this->mdp));
        $this->adresse=htmlspecialchars(strip_tags($this->adresse));
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->codepostal=htmlspecialchars(strip_tags($this->codepostal));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->tel=htmlspecialchars(strip_tags($this->tel));
        $this->datenaiss=htmlspecialchars(strip_tags($this->datenaiss));
        
        // On attache les variables
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":prenom", $this->prenom);
        $query->bindParam(":mdp", $this->mdp);
        $query->bindParam(":adresse", $this->adresse);
        $query->bindParam(":ville", $this->ville);
        $query->bindParam(":codepostal", $this->codepostal);
        $query->bindParam(":email", $this->email);
        $query->bindParam(":tel", $this->tel);
        $query->bindParam(":datenaiss", $this->datenaiss);

        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}