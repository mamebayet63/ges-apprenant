<?php

$page = $_REQUEST["page"] ?? "promo";

function handlePromoPage()
{
    global $selectAll, $insertElement, $lastInsertId,$validateForm,$countAll,$changerStatutPromo ;
    $pagination = isset($_GET['pagination']) ? (int)$_GET['pagination'] : 1;
    $limit = 6;
    $offset = ($pagination - 1) * $limit;
    if (isset($_GET['action'])) {
        $statutActuel = $_GET['action'];
        $idPromo = (int) $_GET['id_promo'];
        $affiche = $_GET['affiche'];
        if (!in_array($statutActuel, ['Actif', 'Inactif'])) {
            exit('Statut invalide');
        }

         if ($changerStatutPromo($idPromo, $statutActuel)) {
            header("Location: ?controller=promo&affiche={$affiche}&message=statut_modifie");
        } else {
            header("Location: ?controller=promo&affiche={$affiche}&error=echec");
        }
        exit;
                        
    }

    if (isset($_GET['message'])) {
        $_SESSION['success_message'] = "Le statut de la promotion a été mis à jour avec succès.";

    }
    // var_dump($offset);
    // die();

    $promos = $selectAll('promotion', 'id ASC', [], $limit, $offset);
    $total = $countAll('promotion');
    $totalPages = ceil($total / $limit);
    // dd($totalPages);


    // $promos = $selectAll('promotion', 'statut ASC, id ASC');
    $referentiels = $selectAll('referentiel');
    // var_dump($referentiels);
    // die();

    $isPost = fn() => $_SERVER["REQUEST_METHOD"] === "POST";

   if ($isPost()) {
    // Récupération des données texte
            $formData = [
            'nom' => $_POST['nom'] ?? '',
            'date_debut' => $_POST['date_debut'] ?? '',
            'date_fin' => $_POST['date_fin'] ?? '',
            'statut' => $_POST['statut'] ?? 'en cours',
            'nb_apprenants' => $_POST['nb_apprenants'] ?? 0,
            'referentiels' => $_POST['referentiels'] ?? [], // ← ici
        ];


    // Règles de validation
    $rules = [
        'nom' => ['required' => true, 'min' => 3],
        'date_debut' => ['required' => true, 'type' => 'date'],
        'date_fin' => ['required' => true, 'type' => 'date'],
        'statut' => ['required' => true, 'in' => ['en cours', 'terminée']],
        'nb_apprenants' => ['required' => true, 'type' => 'numeric']
    ];

    // Validation
    $errors = $validateForm($formData, $rules);
    if (empty($formData['referentiels']) || !is_array($formData['referentiels'])) {
    $errors['referentiels'] = "Veuillez sélectionner au moins un référentiel.";
    } else {
        foreach ($formData['referentiels'] as $refId) {
            if (!is_numeric($refId)) {
                $errors['referentiels'] = "Les identifiants de référentiels doivent être valides.";
                break;
            }
        }
    }

    

    // Vérification du fichier image
    if (!isset($_FILES['cover_photo']) || $_FILES['cover_photo']['error'] !== UPLOAD_ERR_OK) {
        $errors['cover_photo'] = "Une image de promotion est requise.";
    } else {
        // Taille max en octets (2 Mo = 2 * 1024 * 1024)
        $maxSize = 2 * 1024 * 1024;

        if ($_FILES['cover_photo']['size'] > $maxSize) {
            $errors['cover_photo'] = "L'image ne doit pas dépasser 2 Mo.";
        } else {
            $imageData = file_get_contents($_FILES['cover_photo']['tmp_name']);
            // $formData['cover_photo'] = pg_escape_bytea($imageData); // pas nécessaire en PDO
            $formData['cover_photo'] = $imageData;
        }
    }

    // var_dump($errors);

    if (empty($errors)) {
        $imageData = file_get_contents($_FILES['cover_photo']['tmp_name']);
            $newPromo = [
        'nom' => $_POST['nom'] ?? '',
        'date_debut' => $_POST['date_debut'] ?? '',
        'date_fin' => $_POST['date_fin'] ?? '',
        'statut' => $_POST['statut'] ?? 'Inactif',
        'nb_apprenants' => $_POST['nb_apprenants'] ?? 0,
        'cover_photo' => $imageData
    ];


        // var_dump($newPromo['photo']);

        // ✅ Insertion dans la table promotion
        // $insertElement('promotion', $newPromo);
        $promoId = $insertElement('promotion', $newPromo);
        $promoId = (int) $promoId;


    if (!$promoId) {
        // Afficher l'erreur SQL
        echo "Erreur lors de l'insertion de la promotion.<br>";
        echo "Contenu envoyé : <pre>" . print_r($newPromo, true) . "</pre>";
        exit;
    } else {
        echo "Promotion insérée avec succès. ID : $promoId";
    }



        // ✅ Récupération de l'id de la promo créée
        // $promoId = $lastInsertId();

        // // 🔁 Liaison avec les référentiels (si cochés)
        if (!empty($_POST['referentiels']) && is_array($_POST['referentiels'])) {
            foreach ($_POST['referentiels'] as $refId) {
                $insertElement('promo_referentiel', [
                    'promo_id' => $promoId,
                    'referentiel_id' => $refId
                ]);
            }
        }

        // 🔄 Redirection vers la liste
        header("Location: ?controller=promo&page=promo");
        exit;
    } else {
        // Récupérer à nouveau les promos et référentiels pour affichage
        $promos = $selectAll('promotion', 'id ASC', [], $limit, $offset);
        $referentiels = $selectAll('referentiel');
        // dd($pagination);

        // Réaffichage du formulaire avec erreurs et données précédentes
        renderView(
            view: 'promo/promo',
            data: [
                'promos' => $promos,
                'referentiels' => $referentiels,
                'old' => $formData,
                'errors' => $errors,
                'totalPages' => $totalPages,
                'pagination' => $pagination
            ],
            layout: 'base'
        );
    }
}


    // Affichage
    if (isset($_GET["affiche"]) && $_GET["affiche"] === "liste") {
        renderView('promo/promoTable', ['promos' => $promos, 'referentiels' => $referentiels,'totalPages' => $totalPages,'pagination' => $pagination ]  , 'base');
        
    } else {
//         renderView('promo/promo', ['promos' => $promos, 'referentiels' => $referentiels,'totalPages' => $totalPages
// ], 'base');
        renderView('promo/promo', ['promos' => $promos, 'referentiels' => $referentiels,'totalPages' => $totalPages,'pagination' => $pagination ]  , 'base');

    }
}



switch ($page) {
    case 'promo':
        handlePromoPage();
        break;
   
    default:
        // Optionnel : page d'erreur ou redirection
        echo "Page inconnue.";
        break;
}
