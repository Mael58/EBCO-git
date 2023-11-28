<?php
session_start();

$response = array();

// Fonction pour récupérer les données du formulaire
function getFormData($fieldName, $default = "")
{
    return isset($_POST[$fieldName]) ? $_POST[$fieldName] : $default;
}

// Données de livraison
$prenomLivraison = getFormData("prenomLivraison");
$nomLivraison = getFormData("nomLivraison");
$emailLivraison = getFormData("emailLivraison");
$societeLivraison = getFormData("societeLivraison");
$telLivraison = getFormData("telLivraison");
$numRueLivraison = getFormData("numRueLivraison");
$rueLivraison = getFormData("rueLivraison");
$cdpLivraison = getFormData("cdpLivraison");
$villeLivraison = getFormData("villeLivraison");
$paysLivraison = getFormData("paysLivraison");


$contact = $prenomLivraison . " " . $nomLivraison;
$adresse = $numRueLivraison . " " . $rueLivraison;
$client = $societeLivraison . "-" . $contact;
// $_SESSION['client'] = $client;



try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=ebcon_crm;',
        'root',
        ''
    );
} catch (Exception $e) {
    die('erreur: ' . $e);
}
$sqlQuery = "SELECT COUNT(*) FROM clients WHERE tel = ?";
$stmt = $pdo->prepare($sqlQuery);

if ($stmt->execute([$tel])) {
    $row = $stmt->fetchColumn();

    if ($row > 0) {
        echo "Le client existe déjà avec ce numéro de téléphone.";
    } else {
        $sqlQuery = "INSERT INTO clients (client, contact, tel, email, cdp, ville, adresse, pays, status) VALUES ('$societeLivraison', '$contact', '$telLivraison', '$emailLivraison', '$cdpLivraison', '$villeLivraison', '$adresse', '$paysLivraison', 'CS') ";
        $stmt = $pdo->prepare($sqlQuery);
    }
}


// Exécutez la requête
if ($stmt->execute()) {
    echo "Le client a été ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout du client : ";
}


$jsonResponse = json_encode($response);

// Envoi du résultat au client
header('Content-Type: application/json');
echo $jsonResponse;
