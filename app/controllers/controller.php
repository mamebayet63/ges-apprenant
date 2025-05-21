<?php

function renderView(string $view, array $data = [], string $layout) {
    ob_start();
    extract($data);
    require_once ROOT_PATH . "/app/views/{$view}.html.php";
    $content = ob_get_clean();
    require_once ROOT_PATH . "/app/views/layout/{$layout}.layout.php";
}
$insertElement = function ($table, $data) use ($connect) {
    $pdo = $connect();

    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));
    $query = "INSERT INTO $table ($columns) VALUES ($placeholders) RETURNING id";

    try {
        $stmt = $pdo->prepare($query);

        foreach ($data as $key => $value) {
            if ($key === 'cover_photo') {
                // on force PDO à traiter l'image comme donnée binaire
                $stmt->bindValue(":$key", $value, PDO::PARAM_LOB);
            } else {
                $stmt->bindValue(":$key", $value);
            }
        }

        $stmt->execute();
        return $stmt->fetchColumn(); // retourne l'ID inséré
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        echo "Erreur SQL : " . $e->getMessage();
        return false;
    }
};
$countAll = function(string $table, array $conditions = []) {
    global $connect;
    $pdo = $connect();

    $sql = "SELECT COUNT(*) FROM $table";

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(' AND ', array_map(fn($col) => "$col = :$col", array_keys($conditions)));
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($conditions);
    return $stmt->fetchColumn();
};

$changerStatutPromo = function(int $idPromo, string $statutActuel): bool {
    global $connect;
    $pdo = $connect();
    $nouveauStatut = ($statutActuel === 'Actif') ? 'Inactif' : 'Actif';

    try {
        // Démarrer une transaction
        $pdo->beginTransaction();

        if ($nouveauStatut === 'Actif') {
            // Désactiver toutes les autres promotions
            $pdo->exec("UPDATE promotion SET statut = 'Inactif'");
        }

        // Mettre à jour la promotion ciblée
        $sql = "UPDATE promotion SET statut = :statut WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':statut' => $nouveauStatut,
            ':id' => $idPromo
        ]);

        // Valider la transaction
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
};

function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

function afficherPhoto($photo, $nom) {
    if (!empty($photo)) {
        // Si $photo est un flux, lire le contenu
        if (is_resource($photo)) {
            $data = stream_get_contents($photo);
        } else {
            $data = $photo;
        }

        // Trouver le type mime
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $type = finfo_buffer($finfo, $data);
        finfo_close($finfo);

        // Affichage de l'image encodée en base64
        echo '<img src="data:' . $type . ';base64,' . base64_encode($data) . '" '
            . 'alt="' . htmlspecialchars($nom) . '" '
            . 'class="w-full h-full object-cover transition-transform group-hover:scale-110">';
    } else {
        // Pas de photo, afficher une icône de remplacement
        echo '<div class="w-full h-full bg-red-50 flex items-center justify-center">';
        echo '<i class="ri-team-line text-xl text-red-200"></i>';
        echo '</div>';
    }
}

function calculateDuration($start_date, $end_date) {
    $start = new DateTime($start_date);
    $end = new DateTime($end_date);
    $interval = $start->diff($end);
    
    return $interval->format('%a jours'); // Retourne le nombre de jours
}
$isPost = function (): bool {
    return $_SERVER["REQUEST_METHOD"] === "POST";
};

$isGet = function (): bool {
    return $_SERVER["REQUEST_METHOD"] === "GET";
};



$validateForm = function(array $data, array $rules): array {
    $errors = [];

    foreach ($rules as $field => $fieldRules) {
        $value = trim($data[$field] ?? '');

        foreach ($fieldRules as $rule => $ruleValue) {
            // Champ requis
            if ($rule === 'required' && $ruleValue && $value === '') {
                $errors[$field] = "Le champ $field est obligatoire.";
                break;
            }

            // Type de données
            if ($rule === 'type' && $value !== '') {
                if ($ruleValue === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = "Le champ $field doit être un email valide.";
                } elseif ($ruleValue === 'numeric' && !is_numeric($value)) {
                    $errors[$field] = "Le champ $field doit être un nombre.";
                } elseif ($ruleValue === 'date' && !strtotime($value)) {
                    $errors[$field] = "Le champ $field doit être une date valide.";
                }
            }

            // Longueur minimale
            if ($rule === 'min' && $value !== '' && strlen($value) < $ruleValue) {
                $errors[$field] = "Le champ $field doit contenir au moins $ruleValue caractères.";
            }

            // Longueur maximale
            if ($rule === 'max' && $value !== '' && strlen($value) > $ruleValue) {
                $errors[$field] = "Le champ $field ne peut pas dépasser $ruleValue caractères.";
            }

            // Valeurs acceptées (enum)
            if ($rule === 'in' && $value !== '' && !in_array($value, $ruleValue)) {
                $errors[$field] = "La valeur du champ $field est invalide.";
            }
        }
    }

    return $errors;
};

