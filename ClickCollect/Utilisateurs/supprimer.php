<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Verification de la methode utilisee
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

    //On inclut les fichier de config et acces au donnees
    include_once '../config/Database.php';
    include_once '../models/Utilisateur.php';

    //Instanciation de BDD
    $database = new Database();
    $db = $database->getConnection();

    //Instanciation Util
    $utilisateur = new Utilisateur($db);

    $donnees = $_GET['numero'];

    if ($utilisateur->supprimer((int)$donnees)) {
        // Ici la suppression a fonctionné
        // On envoie un code 201
        http_response_code(201);
        echo json_encode(["message" => "La suppression a été effectué"]);
    }else{
        // Ici la suppression n'a pas fonctionné
        // On envoie un code 503
        http_response_code(503);
        echo json_encode(["message" => "La suppression n'a pas été effectué"]);         
    }

}else{
    // On gere l'erreur
    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee"]);
}