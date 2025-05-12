<?php
// /app/services/database.php

$connect = function (): PDO {
    $host = 'localhost';
    $port = '5432';
    $dbname = 'ges_apprenant';
    $user = 'postgres'; // À adapter
    $password = 's@uveur25'; // À adapter

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        return new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
};


// Fonction anonyme pour récupérer les promotions
$getPromotions = function () {
    global $connect; // accès à la fonction de connexion

    // Connexion à la base de données
    $pdo = $connect();

    // Récupérer toutes les promotions, triées par statut (Active en premier) et ID croissant
    $query = $pdo->prepare("SELECT * FROM promotion ORDER BY statut ASC, id ASC");
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
};

function calculateDuration($start_date, $end_date) {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    
    return $interval->format('%a jours'); // Retourne le nombre de jours
}


?>
