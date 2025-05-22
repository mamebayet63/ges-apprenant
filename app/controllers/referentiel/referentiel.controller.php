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
    // dd($totalPages);


    // $promos = $selectAll('promotion', 'statut ASC, id ASC');
    // $referentiels = $selectAll('referentiel');
    // var_dump($referentiels);
    // die();
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
