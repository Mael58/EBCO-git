<?php

$requestedPage = $_GET['page'] ?? 'home';

$validPages = ['Accueil', 'compte', 'Panier', 'solution', 'ebco', 'usb', 'Contact', 'commandes', 'details', 'Mention', 'ForgetPassword'];

// Vérifie si la page demandée est valide
if (!in_array($requestedPage, $validPages)) {
    // Gérer la page non valide ici, par exemple rediriger vers une page d'erreur.
    echo "Page non valide $requestedPage";
    exit;
}

// Charger le contrôleur correspondant à la page demandée
$controllerName = ucfirst($requestedPage) . 'Controller';
$controllerFile = 'Controller/ControllerView/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    include_once $controllerFile;

    $recipeName = $_GET['recipeName'] ?? '';
    $controller = new $controllerName();
    $controller->index($recipeName);
} else {
    // Gérer le contrôleur manquant ici, par exemple rediriger vers une page d'erreur.
    echo "Contrôleur non trouvé $requestedPage";
}
