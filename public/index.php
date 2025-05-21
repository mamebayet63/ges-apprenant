<?php
session_start();

define("WEBROOT", "http://khalil.ecole221.sn:8000/");
define("ROOT_PATH", dirname(__DIR__));

require_once ROOT_PATH . '../app/models/model.php';
// require_once ROOT_PATH . '/config/helpers.php';
// require_once ROOT_PATH . '/config/dbHelpers.php';
require_once ROOT_PATH . '../app/routes/route.web.php';
require_once ROOT_PATH . '../app/controllers/controller.php';

$guard($controller);



// 🔁 Vérification de la validité du contrôleur
if (!array_key_exists($controller, $controllers)) {
    $controller = "security";
}

handleController($controller);
