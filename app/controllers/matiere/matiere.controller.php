<?php

$page = $_REQUEST["page"] ?? "matiere";

function handlereferentielPage()
{
    global $selectAll, $selectById, $updateElement, $insertElement, $lastInsertId, $validateForm, $countAll, $changerStatutPromo, $deleteElement;

    // 🔁 Suppression
    if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if ($deleteElement('matiere', ['id' => $id])) {
            $_SESSION['success_message'] = "Matière supprimée avec succès.";
        } else {
            $_SESSION['error_message'] = "Erreur lors de la suppression.";
        }
        header("Location: ?controller=matiere");
        exit;
    }

    // 🔁 Pagination
    $pagination = isset($_GET['pagination']) ? (int)$_GET['pagination'] : 1;
    $limit = 6;
    $offset = ($pagination - 1) * $limit;
    $matieres = $selectAll('matiere', 'id ASC', [], $limit, $offset);
    $total = $countAll('matiere');
    $totalPages = ceil($total / $limit);

    // 🔁 Détection modification
    $isEditing = isset($_GET['is_editing']) && is_numeric($_GET['is_editing']);
    $matiereToEdit = $isEditing ? $selectById('matiere', (int)$_GET['is_editing']) : null;

    // 🔁 Traitement POST
    $isPost = $_SERVER["REQUEST_METHOD"] === "POST";
    if ($isPost) {
        $formData = ['libelle' => $_POST['libelle'] ?? ''];
        $rules = ['libelle' => ['required' => true, 'min' => 3]];
        $errors = $validateForm($formData, $rules);

        if (empty($errors)) {
            if ($isEditing && $matiereToEdit) {
                // ✅ Modification
                $updated = $updateElement('matiere', $formData, ['id' => $matiereToEdit['id']]);
                if ($updated) {
                    $_SESSION['success_message'] = "Matière modifiée avec succès.";
                } else {
                    $_SESSION['error_message'] = "Erreur lors de la modification.";
                }
            } else {
                // ✅ Insertion
                $matiereId = $insertElement('matiere', $formData);
                if ($matiereId) {
                    $_SESSION['success_message'] = "Matière insérée avec succès.";
                } else {
                    $_SESSION['error_message'] = "Erreur lors de l'insertion.";
                }
            }

            header("Location: ?controller=matiere");
            exit;
        } else {
            // ❌ Erreurs de validation
            renderView('matiere/matiere', [
                'matieres' => $matieres,
                'errors' => $errors,
                'old' => $formData,
                'isEditing' => $isEditing,
                'matiereToEdit' => $matiereToEdit,
                'totalPages' => $totalPages,
                'pagination' => $pagination
            ], 'base');
            return;
        }
    }

    // 🖼️ Affichage de la page
    renderView('matiere/matiere', [
        'matieres' => $matieres,
        'isEditing' => $isEditing,
        'matiereToEdit' => $matiereToEdit,
        'totalPages' => $totalPages,
        'pagination' => $pagination
    ], 'base');
}


switch ($page) {
    case 'matiere':
        handlereferentielPage();
        break;
    default:
        // Optionnel : page d'erreur ou redirection
        echo "Page inconnue.";
        break;
}
