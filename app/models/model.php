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

$guard = function(string $controller) {
    if (!isset($_SESSION['user']) && $controller !== 'security') {
        header("Location: " . WEBROOT . "?controller=security&page=login");
        exit;
    }

    // Si tu veux aussi empêcher les utilisateurs connectés d'accéder à la page de login :
    // if (isset($_SESSION['user']) && ($controller === 'security' || $controller === '')) {
    //     header("Location: " . WEBROOT . "?controller=promo");
    // !    exit;
    // }
};


$selectAll = function(string $table, string $orderBy = '', array $conditions = [], int $limit = 10, int $offset = 0) {
    global $connect;
    $pdo = $connect();

    $sql = "SELECT * FROM $table";

    // Ajouter les conditions si nécessaire
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(' AND ', array_map(fn($col) => "$col = :$col", array_keys($conditions)));
    }

    // Ajouter l'ordre de tri si fourni
    if ($orderBy) {
        $sql .= " ORDER BY $orderBy";
    }

    // Ajouter la pagination
    $sql .= " LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);

    // Bind des conditions
    foreach ($conditions as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Bind de la pagination
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};

$selectAllWithJoin = function(
    string $baseTable,
    array $joins = [],
    string $orderBy = '',
    array $conditions = [],
    int $limit = 10,
    int $offset = 0,
    string $columns = '*'
) use ($connect) {
    $pdo = $connect();

    // Départ : les colonnes à récupérer
    $sql = "SELECT $columns FROM $baseTable";

    // Ajouter les jointures
    foreach ($joins as $join) {
        $type = strtoupper($join['type'] ?? 'JOIN');
        $table = $join['table'] ?? '';
        $on = $join['on'] ?? '';
        if ($table && $on) {
            $sql .= " $type $table ON $on";
        }
    }

    // Ajouter les conditions si présentes
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(' AND ', array_map(fn($col) => "$col = :$col", array_keys($conditions)));
    }

    // Ajouter l'ordre de tri
    if ($orderBy) {
        $sql .= " ORDER BY $orderBy";
    }

    // Ajouter la pagination
    $sql .= " LIMIT :limit OFFSET :offset";

    $stmt = $pdo->prepare($sql);

    // Bind des conditions
    foreach ($conditions as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Bind pagination
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};







?>
