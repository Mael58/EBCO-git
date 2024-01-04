<?php

require_once __DIR__ . '/vendor/autoload.php';



$cleServiceFile = './ebconnections.json';
$cleService = json_decode(file_get_contents($cleServiceFile), true);



$client = new Google_Client();
$client->setApplicationName('EBCO');
$client->setScopes(Google\Service\Calendar::CALENDAR);
$client->setAuthConfig($cleService);

$service = new Google\Service\Calendar($client);

$calendar_Id= 'matzenerm@gmail.com';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$titre = $_POST["titre"];
$description = $_POST["description"];
$dateDebut = $_POST["date_debut"];
$dateFin = $_POST["date_fin"];
$dateDebutFormatted = date('c', strtotime($dateDebut));
    $dateFinFormatted = date('c', strtotime($dateFin));
   

$event = new Google\Service\Calendar\Event(array(
    'summary' => $titre,
    'description' => $description,
    'start' => array(
        'dateTime' => $dateDebutFormatted,
        'timeZone' => 'UTC',
    ),
    'end' => array(
        'dateTime' => $dateFinFormatted,
        'timeZone' => 'UTC',
    ),
    'visibility' => 'private',
    'colorId' => '8',
));

// Insert the event
$event = $service->events->insert($calendar_Id, $event);
header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<iframe

    src="https://calendar.google.com/calendar/embed?src=matzenerm%40gmail.com&ctz=UTC"
    style="border-width:0"
    width="800"
    height="600"
    frameborder="0"
    scrolling="no">
  </iframe>

  <form action="#" method="post">
    <label for="titre">Titre de l'événement :</label>
    <input type="text" id="titre" name="titre" required><br>

    <label for="description">Description :</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="date_debut">Date de début :</label>
    <input type="datetime-local" id="date_debut" name="date_debut" required><br>

    <label for="date_fin">Date de fin :</label>
    <input type="datetime-local" id="date_fin" name="date_fin" required><br>

    <input type="submit" value="Créer l'événement">
</form>

  