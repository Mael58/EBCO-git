<?php

$requestedPage = $_GET['page'] ?? 'home';

$validPages = ['home', 'compte', 'Panier', 'solution', 'ebco', 'usb', 'Contact'];

// Vérifie si la page demandée est valide
if (!in_array($requestedPage, $validPages)) {
    // Gérer la page non valide ici, par exemple rediriger vers une page d'erreur.
    echo "Page non valide";
    exit;
}

// Charger le contrôleur correspondant à la page demandée
$controllerName = ucfirst($requestedPage) . 'Controller';
$controllerFile = 'Controller/ControllerView/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    include_once $controllerFile;
    $controller = new $controllerName();
    $controller->index();
} else {
    // Gérer le contrôleur manquant ici, par exemple rediriger vers une page d'erreur.
    echo "Contrôleur non trouvé";
}
