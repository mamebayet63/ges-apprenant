<?php
// /app/services/database.php

$connect = function (): PDO {
    $host = 'localhost';
    $port = '3306'; // Port MySQL par défaut
    $dbname = 'ges_apprenant';
    $user = 'root'; // À adapter selon ton utilisateur MySQL
    $password = ''; // À adapter selon ton mot de passe

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
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


$selectAll = function(string $table, string $orderBy = '', array $conditions = [], int $limit = 100, int $offset = 0) {
    global $connect;
    $pdo = $connect();

    // Ajouter etat = 'Actif' par défaut, sauf si déjà spécifié
    if (!array_key_exists('etat', $conditions)) {
        $conditions['etat'] = 'Actif';
    }

    $sql = "SELECT * FROM $table";

    // Ajouter les conditions
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(' AND ', array_map(fn($col) => "$col = :$col", array_keys($conditions)));
    }

    // Ajouter l'ordre
    if ($orderBy) {
        $sql .= " ORDER BY $orderBy";
    }

    // Pagination
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

$selectById = function(string $table, int $id) {
    global $connect;
    $pdo = $connect();

    $sql = "SELECT * FROM $table WHERE id = :id LIMIT 1";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Une seule ligne
    } catch (PDOException $e) {
        error_log("Erreur selectById: " . $e->getMessage());
        return null;
    }
};

$selectAllWithJoin = function(
    string $baseTable,
    array $joins = [],
    string $orderBy = '',
    array $conditions = [],
    int $limit = 0,
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

    // Ajouter la pagination uniquement si demandée
    if ($limit > 0) {
        $sql .= " LIMIT :limit OFFSET :offset";
    }

    $stmt = $pdo->prepare($sql);

    // Bind des conditions
    foreach ($conditions as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }

    // Bind pagination uniquement si nécessaire
    if ($limit > 0) {
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
};








?>
