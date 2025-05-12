<?php
// session_start();

// require_once ROOT_PATH . "/model/commandeModel.php";
// require_once ROOT_PATH . "/controller/fonctionController.php";


$page = $_REQUEST["page"] ?? "attache";


function handleAttachePage() {
    global $getPromotions;
    $promos = $getPromotions();
    // var_dump($promos);
    // die();
    require_once ROOT_PATH . "/app/views/promo/promo.html.php";
}


ob_start();

switch ($page) {
    case 'attache':
        handleAttachePage();
        break;
      
    default:
        # code...
        break;
}

$content = ob_get_clean();
require_once ROOT_PATH . "/app/views/layout/base.layout.php";