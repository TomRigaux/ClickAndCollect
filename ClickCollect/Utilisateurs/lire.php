<?php
// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: GET");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
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

    //Recup donnees
    $stmt = $utilisateur->lire();

    //Verification qu'il y ai un produit au moins
    if ($stmt->rowCount() > 0) {
        $tableauUtil = [];
        $tableauUtil['utilisateur'] = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $util = [
                "numero" => $numero,
                "nom" => $nom,
                "prenom" => $prenom,
                "adresse" => $adresse,
                "ville" => $ville,
                "codepostal" => $codepostal,
                "email" => $email,
                "tel" => $tel,
                "datenaiss" => $datenaiss
            ];

            $tableauUtil['utilisateur'][] = $util;
        }

        http_response_code(200);

        echo json_encode($tableauUtil);
    }
}else{
    // On gere l'erreur
    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee"]);
}