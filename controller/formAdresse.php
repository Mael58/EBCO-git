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

// Données de facturation
$prenomFacturation = getFormData("prenomFacturation");
$nomFacturation = getFormData("nomFacturation");
$emailFacturation = getFormData("emailFacturation");
$societeFacturation = getFormData("societeFacturation");
$telFacturation = getFormData("telFacturation");
$numRueFacturation = getFormData("numRueFacturation");
$rueFacturation = getFormData("rueFacturation");
$cdpFacturation = getFormData("cdpFacturation");
$villeFacturation = getFormData("villeFacturation");
$paysFacturation = getFormData("paysFacturation");

// Construction de la clé client
$_SESSION['client'] = $societeLivraison . "-" . $prenomLivraison . " " . $nomLivraison;

// Traitement des adresses de livraison et de facturation
function updateAddress($type, &$sessionData)
{
    global ${"prenom$type"}, ${"nom$type"}, ${"email$type"}, ${"societe$type"}, ${"tel$type"}, ${"numRue$type"}, ${"rue$type"}, ${"cdp$type"}, ${"ville$type"}, ${"pays$type"};

    $sessionData['prenom'] = !empty(${"prenom$type"}) ? ${"prenom$type"} : $sessionData['prenom'];
    $sessionData['nom'] = !empty(${"nom$type"}) ? ${"nom$type"} : $sessionData['nom'];
    $sessionData['email'] = !empty(${"email$type"}) ? ${"email$type"} : $sessionData['email'];
    $sessionData['societe'] = !empty(${"societe$type"}) ? ${"societe$type"} : $sessionData['societe'];
    $sessionData['tel'] = !empty(${"tel$type"}) ? ${"tel$type"} : $sessionData['tel'];
    $sessionData['numRue'] = !empty(${"numRue$type"}) ? ${"numRue$type"} : $sessionData['numRue'];
    $sessionData['rue'] = !empty(${"rue$type"}) ? ${"rue$type"} : $sessionData['rue'];
    $sessionData['cdp'] = !empty(${"cdp$type"}) ? ${"cdp$type"} : $sessionData['cdp'];
    $sessionData['ville'] = !empty(${"ville$type"}) ? ${"ville$type"} : $sessionData['ville'];
    $sessionData['pays'] = !empty(${"pays$type"}) ? ${"pays$type"} : $sessionData['pays'];
}

// Adresse de livraison
if (isset($_SESSION['adresse'])) {
    updateAddress("Livraison", $_SESSION['adresse']);
} else {
    $_SESSION['adresse'] = [
        'prenom' => $prenomLivraison,
        'nom' => $nomLivraison,
        'email' => $emailLivraison,
        'societe' => $societeLivraison,
        'tel' => $telLivraison,
        'numRue' => $numRueLivraison,
        'rue' => $rueLivraison,
        'cdp' => $cdpLivraison,
        'ville' => $villeLivraison,
        'pays' => $paysLivraison
    ];
}

// Adresse de facturation
if (isset($_SESSION['adresseFacturation'])) {
    updateAddress("Facturation", $_SESSION['adresseFacturation']);
} else {
    $_SESSION['adresseFacturation'] = [
        'prenom' => $prenomFacturation,
        'nom' => $nomFacturation,
        'email' => $emailFacturation,
        'societe' => $societeFacturation,
        'tel' => $telFacturation,
        'numRue' => $numRueFacturation,
        'rue' => $rueFacturation,
        'cdp' => $cdpFacturation,
        'ville' => $villeFacturation,
        'pays' => $paysFacturation
    ];
}

// Réponse JSON
$response['livraison'] = $_SESSION['adresse'];
$response['facturation'] = $_SESSION['adresseFacturation'];



// Encodage des données en JSON
$jsonResponse = json_encode($response);

// Envoi du résultat au client
header('Content-Type: application/json');
echo $jsonResponse;
