<?php
require_once ROOT_PATH . '../app/models/modelApprenant.php';

$page = $_REQUEST["page"] ?? "apprenant";

function handlePromoPage()
{
    global $selectAll, $insertElement, $lastInsertId,$validateForm,$countAll,$changerStatutPromo,$selectAllWithJoin, $genererMatricule;
    $pagination = isset($_GET['pagination']) ? (int)$_GET['pagination'] : 1;
    $limit = 4;
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
  

    $apprenant = $selectAllWithJoin(
    'apprenant',
    [
        [
            'type' => 'JOIN',
            'table' => 'referentiel',
            'on' => 'apprenant.id_referentiel = referentiel.id'
        ]
    ],
    'apprenant.id DESC',
    [],
    $limit,  // LIMIT = 5
    $offset, // OFFSET = 10 (page 3 si 5 par page)
    'apprenant.*, referentiel.libelle AS nom_referentiel'
    );

    $total = $countAll('apprenant');
    $totalPages = ceil($total / $limit);


    $referentiels = $selectAll('referentiel');
    // dd($referentiels);
    

 $isPost = fn() => $_SERVER["REQUEST_METHOD"] === "POST";

    if ($isPost()) {
        // Récupération des données texte
        $formData = [
            // Informations apprenant
            'nom' => $_POST['nom'] ?? '',
            'prenom' => $_POST['prenom'] ?? '',
            'date_naissance' => $_POST['date_naissance'] ?? '',
            'lieu_naissance' => $_POST['lieu_naissance'] ?? '',
            'adresse' => $_POST['adresse'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telephone' => $_POST['telephone'] ?? '',
            'id_referentiel' => $_POST['id_referentiel'],
            
            // Informations tuteur
            'tuteur_nom' => $_POST['tuteur_nom'] ?? '',
            'tuteur_prenom' => $_POST['tuteur_prenom'] ?? '',
            'tuteur_lien' => $_POST['tuteur_lien'] ?? '',
            'tuteur_adresse' => $_POST['tuteur_adresse'] ?? '',
            'tuteur_telephone' => $_POST['tuteur_telephone'] ?? '',
        ];

        // Règles de validation
        $rules = [
            // Validation apprenant
            'nom' => ['required' => true, 'min' => 2],
            'prenom' => ['required' => true, 'min' => 2],
            'date_naissance' => ['required' => true, 'type' => 'date'],
            'lieu_naissance' => ['required' => true, 'min' => 2],
            'adresse' => ['required' => true],
            'email' => ['required' => true, 'type' => 'email'],
            'telephone' => ['required' => true],
            'id_referentiel' => ['required' => true],
            
            // Validation tuteur
            'tuteur_nom' => ['required' => true, 'min' => 2],
            'tuteur_prenom' => ['required' => true, 'min' => 2],
            'tuteur_lien' => ['required' => true],
            'tuteur_adresse' => ['required' => true],
            'tuteur_telephone' => ['required' => true],
        ];

        // Validation
        $errors = $validateForm($formData, $rules);

        // Vérification du fichier photo
        $photoData = null;
        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            $errors['photo'] = "Une photo de l'apprenant est requise.";
        } else {
            // Taille max en octets (2 Mo = 2 * 1024 * 1024)
            $maxSize = 2 * 1024 * 1024;

            if ($_FILES['photo']['size'] > $maxSize) {
                $errors['photo'] = "La photo ne doit pas dépasser 2 Mo.";
            } else {
                // Vérification du type MIME
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = mime_content_type($_FILES['photo']['tmp_name']);
                
                if (!in_array($fileType, $allowedTypes)) {
                    $errors['photo'] = "Format d'image non supporté (JPG, PNG ou GIF uniquement).";
                } else {
                    $photoData = file_get_contents($_FILES['photo']['tmp_name']);
                }
            }
        }

        if (empty($errors)) {
            // 2. Insertion de l'apprenant
            $newMatricule = $genererMatricule();
            $newApprenant = [
                'nom' => $formData['nom'],
                'prenom' => $formData['prenom'],
                'date_naissance' => $formData['date_naissance'],
                'lieu_naissance' => $formData['lieu_naissance'],
                'adresse' => $formData['adresse'],
                'email' => $formData['email'],
                'telephone' => $formData['telephone'],
                'photo' => $photoData,
                'matricule' => $newMatricule,
                'id_referentiel' => $formData['id_referentiel']
            ];
            
            $apprenantId = $insertElement('apprenant', $newApprenant);
            
            if (!$apprenantId) {
                die("Erreur lors de l'insertion de l'apprenant");
            }
            // 1. Insertion du tuteur
            $newTuteur = [
                'nom' => $formData['tuteur_nom'],
                'prenom' => $formData['tuteur_prenom'],
                'lien_de_parente' => $formData['tuteur_lien'],
                'adresse' => $formData['tuteur_adresse'],
                'telephone' => $formData['tuteur_telephone'],
                'id_apprenant' => $apprenantId
            ];
            
            $tuteurId = $insertElement('tuteur', $newTuteur);
            
            if (!$tuteurId) {
                die("Erreur lors de l'insertion du tuteur");
            }

        

            // Redirection vers la liste des apprenants
            header("Location: ?controller=apprenant&page=apprenant");
            exit;
        } else {
            // Réaffichage du formulaire avec erreurs et données précédentes
            renderView(
                view: 'apprenant/apprenant', // À adapter à votre vue
                data: [
                    'old' => $formData,
                    'errors' => $errors
                ],
                layout: 'base'
            );
        }
    }


    // Affichage
        renderView('apprenant/apprenant', ['apprenant' => $apprenant, 'referentiels' => $referentiels,'totalPages' => $totalPages,'pagination' => $pagination ]  , 'base');
        
}
function handletelechargerPage()
{
    global $selectAllWithJoin;

    if (!isset($_GET['format'])) {
        return;
    }

    $format = $_GET['format'];

    // Récupération des données avec jointure sur la classe
    $apprenants = $selectAllWithJoin(
        'apprenant',
        [
            [
                'type' => 'JOIN',
                'table' => 'referentiel',
                'on' => 'apprenant.id_referentiel = referentiel.id'
            ]
        ],
        '',
        [],
        10000,
        0,
        'apprenant.nom,apprenant.prenom,apprenant.adresse,apprenant.Matricule,apprenant.Telephone,apprenant.Email, referentiel.libelle AS referentiel'
    );

    if (!$apprenants) {
        die("Aucun apprenant trouvé.");
    }

    // ========================
    // 📄 GÉNÉRER UN PDF
    // ========================
    if ($format === 'pdf') {
        require_once ROOT_PATH . '../fpdf186/fpdf.php';

        $pdf = new FPDF('L');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Liste des Apprenants avec Classe', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', 'B', 10);
        $colonnes = array_keys($apprenants[0]);
        $largeur = 270 / count($colonnes);

        foreach ($colonnes as $col) {
            $pdf->Cell($largeur, 10, ucfirst($col), 1);
        }
        $pdf->Ln();

        $pdf->SetFont('Arial', '', 10);
        foreach ($apprenants as $a) {
            foreach ($colonnes as $col) {
                $val = isset($a[$col]) ? $a[$col] : '';
                $pdf->Cell($largeur, 10, utf8_decode((string)$val), 1);
            }
            $pdf->Ln();
        }

        $pdf->Output('D', 'liste_apprenants.pdf');
        exit;
    }

    // ========================
    // 📊 GÉNÉRER UN FICHIER EXCEL (CSV)
    // ========================
    elseif ($format === 'excel') {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=liste_apprenants.csv');

        $output = fopen('php://output', 'w');

        $colonnes = array_keys($apprenants[0]);
        fputcsv($output, $colonnes);

        foreach ($apprenants as $a) {
            $row = [];
            foreach ($colonnes as $col) {
                $row[] = $a[$col];
            }
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }
}

function handledetailsPage(){
    renderView('apprenant/detailsApprenant', [ ]  , 'base');
}



switch ($page) {
    case 'apprenant':
        handlePromoPage();
        break;
    case 'telecharger':
        handletelechargerPage();
        break;
    case 'details':
        handledetailsPage();
        break;
    default:
        // Optionnel : page d'erreur ou redirection
        echo "Page inconnue.";
        break;
}
