<?php
$directory = 'Controller/ControllerView/';

// Obtenez tous les fichiers PHP dans le répertoire
$files = glob($directory . '*.php');

// Incluez chaque fichier
foreach ($files as $file) {
    include_once $file;
}



// include_once 'Controller/HomeController.php';

// // Crée une instance du contrôleur
// $homeController = new HomeController();

// // Appelle la méthode index du contrôleur
// $homeController->index();

// index.php (Front Controller)
$requestedPage = $_GET['page'] ?? 'home';

switch ($requestedPage) {
    case 'solution':
        $controller = new SolutionController();
        break;
    case 'ebco':
        $controller = new EbcoController();
        break;
    case 'usb':
        $controller = new UsbController();
        break;
    case 'contact':
        $controller = new ContactController();
        break;
    default:
        $controller = new HomeController();
}

$controller->index();
