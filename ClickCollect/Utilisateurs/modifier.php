<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Verification de la methode utilisee
if($_SERVER['REQUEST_METHOD'] == 'PUT'){

    //On inclut les fichier de config et acces au donnees
    include_once '../config/Database.php';
    include_once '../models/Utilisateur.php';

    //Instanciation de BDD
    $database = new Database();
    $db = $database->getConnection();

    //Instanciation Util
    $utilisateur = new Utilisateur($db);

    // On récupère les informations envoyées
    $donnees = json_decode(file_get_contents("php://input"));
    $num_Util = $_GET['numero'];

    if(!empty($donnees->nom) && !empty($donnees->prenom) && !empty($donnees->mdp) && !empty($donnees->adresse) && !empty($donnees->ville) && !empty($donnees->codepostal) && !empty($donnees->email) && !empty($donnees->tel) && !empty($donnees->datenaiss)){
        // Ici on a reçu les données
        // On hydrate notre objet
        $utilisateur->nom = $donnees->nom;
        $utilisateur->prenom = $donnees->prenom;
        $utilisateur->mdp = $donnees->mdp;
        $utilisateur->adresse = $donnees->adresse;
        $utilisateur->ville = $donnees->ville;
        $utilisateur->codepostal = $donnees->codepostal;
        $utilisateur->email = $donnees->email;
        $utilisateur->tel = $donnees->tel;
        $utilisateur->datenaiss = $donnees->datenaiss;

        if($utilisateur->update($num_Util)){
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "La modification a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "La modification n'a pas été effectué"]);         
        }
    }

}else{
    // On gere l'erreur
    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee"]);
}