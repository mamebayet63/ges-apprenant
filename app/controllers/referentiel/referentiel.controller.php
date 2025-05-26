<?php

$page = $_REQUEST["page"] ?? "referentiel";

function handlereferentielPage()
{
    global $selectAll, $insertElement, $lastInsertId,$validateForm,$countAll,$changerStatutPromo ;
    $pagination = isset($_GET['pagination']) ? (int)$_GET['pagination'] : 1;
    $limit = 6;
    $offset = ($pagination - 1) * $limit;
    $referentiels = $selectAll('referentiel', 'id ASC', [], $limit, $offset);
    $total = $countAll('referentiel');
    $totalPages = ceil($total / $limit);
       $isPost = fn() => $_SERVER["REQUEST_METHOD"] === "POST";

   if ($isPost()) {
    // Récupération des données texte
            $formData = [
            'libelle' => $_POST['libelle'] ?? '',
            'capacite' => $_POST['capacite'] ?? '',
            'description' => $_POST['description'] ?? '',
        ];


    // Règles de validation
    $rules = [
        'libelle' => ['required' => true, 'min' => 3],
        'capacite' => ['required' => true, 'type' => 'numeric'],
        'description' => ['required' => true, 'min' => 20]
    ];

    // Validation
    $errors = $validateForm($formData, $rules);
    
    // Vérification du fichier image
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        $errors['photo'] = "Une image de referentiel est requise.";
    } else {
        // Taille max en octets (2 Mo = 2 * 1024 * 1024)
        $maxSize = 2 * 1024 * 1024;

        if ($_FILES['photo']['size'] > $maxSize) {
            $errors['photo'] = "L'image ne doit pas dépasser 2 Mo.";
        } else {
            $imageData = file_get_contents($_FILES['photo']['tmp_name']);
            // $formData['cover_photo'] = pg_escape_bytea($imageData); // pas nécessaire en PDO
            $formData['photo'] = $imageData;
        }
    }

    // dd($errors);

    if (empty($errors)) {
            $imageData = file_get_contents($_FILES['photo']['tmp_name']);
                $newPromo = $formData;
                $newPromo['photo'] = $imageData;
                // dd($newPromo);


        // var_dump($newPromo['photo']);

        // ✅ Insertion dans la table promotion
        // $insertElement('promotion', $newPromo);
        $promoId = $insertElement('referentiel', $newPromo);

        if (!$promoId) {
            // Afficher l'erreur SQL
            echo "Erreur lors de l'insertion de la promotion.<br>";
            echo "Contenu envoyé : <pre>" . print_r($newPromo, true) . "</pre>";
            exit;
        } else {
            echo "referentiel insérée avec succès. ID : $promoId";
            $_SESSION['success_message'] = "referentiel insérée avec succès. ID : $promoId";
        }



        // ✅ Récupération de l'id de la promo créée
        // $promoId = $lastInsertId();

       

        // 🔄 Redirection vers la liste
        header("Location: ?controller=referentiel");
        exit;
    } else {
        // Récupérer à nouveau les promos et référentiels pour affichage
        // $promos = $selectAll('promotion', 'id ASC', [], $limit, $offset);
        // $referentiels = $selectAll('referentiel');

        // Réaffichage du formulaire avec erreurs et données précédentes
        renderView(
            view: 'referentiel/referentiel',
            data: [
                'referentiel' => $referentiels,
                'old' => $formData,
                'errors' => $errors,
                'totalPages' => $totalPages,
                'pagination' => $pagination
            ],
            layout: 'base'
        );
    }
}
    renderView('referentiel/referentiel', ['referentiel' => $referentiels,'totalPages' => $totalPages,'pagination' => $pagination ]  , 'base');

}




switch ($page) {
    case 'referentiel':
        handlereferentielPage();
        break;
    default:
        // Optionnel : page d'erreur ou redirection
        echo "Page inconnue.";
        break;
}
