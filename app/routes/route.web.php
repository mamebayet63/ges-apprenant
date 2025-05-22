<?php
// Liste des contrôleurs disponibles
$controllers = [
    "security" => "auth/login.controller.php",// Contrôleur pour la connexion/déconnexion
    "promo"   => "promo/promo.controller.php",
    "referentiel"  => "referentiel/referentiel.controller.php",
];
// 🔁 On récupère le contrôleur d'abord
$controller = $_GET["controller"] ?? "security";
function handleController(string $key){
    global $controllers;
    if (array_key_exists($key, $controllers)) {
        $controller = $controllers[$key];
        require_once ROOT_PATH . "/app/controllers/" . $controller;
    } else {
        throw new Exception("Controller not found: " . $key);
    }
}