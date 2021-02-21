<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Verification de la methode utilisee
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    //On inclut les fichier de config et acces au donnees
    include_once '../config/Database.php';
    include_once '../models/Utilisateur.php';

    //Instanciation de BDD
    $database = new Database();
    $db = $database->getConnection();

    //Instanciation Util
    $utilisateur = new Utilisateur($db);

    $donnees = $_GET['numero'];
    if($donnees){
        // On récupère le produit
        $utilisateur->lireUn((int)$donnees);

        //Verification qu'il y ai un produit au moins
        if ($utilisateur->nom != null) {
            $util = [
                "numero" => $utilisateur->numero ,
                "nom" => $utilisateur->nom ,
                "prenom" => $utilisateur->prenom ,
                "adresse" => $utilisateur->adresse ,
                "ville" => $utilisateur->ville ,
                "codepostal" => $utilisateur->codepostal ,
                "email" => $utilisateur->email ,
                "tel" => $utilisateur->tel ,
                "datenaiss" => $utilisateur->datenaiss ,
            ];
            http_response_code(200);

            echo json_encode($util);
        }else {
            //404 Not Found
            http_response_code(404);

            echo json_encode(array("message" => "L'Utilisateur n'existe pas."));
        }
    }else {
        http_response_code(405);
        echo json_encode(array("message" => "La requete necessite le numero de l'utilisateur souhaiter."));
    }
}else{
    // On gere l'erreur
    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee"]);
}