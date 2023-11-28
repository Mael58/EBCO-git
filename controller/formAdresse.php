<?php
session_start();

$response = array(); // Créez un tableau pour stocker les données à renvoyer

$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$societe = isset($_POST["societe"]) ? $_POST["societe"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$numRue = isset($_POST["numRue"]) ? $_POST["numRue"] : "";
$rue = isset($_POST["rue"]) ? $_POST["rue"] : "";
$cdp = isset($_POST["cdp"]) ? $_POST["cdp"] : "";
$ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
$pays = isset($_POST["pays"]) ? $_POST["pays"] : "";

$_SESSION['client'] = $societe . "-" . $prenom . " " . $nom;

if (isset($_SESSION['adresse'])) {
    // Mettre à jour uniquement les champs non vides
    $_SESSION['adresse']['prenom'] = !empty($prenom) ? $prenom : $_SESSION['adresse']['prenom'];
    $_SESSION['adresse']['nom'] = !empty($nom) ? $nom : $_SESSION['adresse']['nom'];
    $_SESSION['adresse']['email'] = !empty($email) ? $email : $_SESSION['adresse']['email'];
    $_SESSION['adresse']['societe'] = !empty($societe) ? $societe : $_SESSION['adresse']['societe'];
    $_SESSION['adresse']['tel'] = !empty($tel) ? $tel : $_SESSION['adresse']['tel'];
    $_SESSION['adresse']['numRue'] = !empty($numRue) ? $numRue : $_SESSION['adresse']['numRue'];
    $_SESSION['adresse']['rue'] = !empty($rue) ? $rue : $_SESSION['adresse']['rue'];
    $_SESSION['adresse']['cdp'] = !empty($cdp) ? $cdp : $_SESSION['adresse']['cdp'];
    $_SESSION['adresse']['ville'] = !empty($ville) ? $ville : $_SESSION['adresse']['ville'];
    $_SESSION['adresse']['pays'] = !empty($pays) ? $pays : $_SESSION['adresse']['pays'];
} else {
    $_SESSION['adresse'] = [
        'prenom' => $prenom,
        'nom' => $nom,
        'email' => $email,
        'societe' => $societe,
        'tel' => $tel,
        'numRue' => $numRue,
        'rue' => $rue,
        'cdp' => $cdp,
        'ville' => $ville,
        'pays' => $pays
    ];
}


// Vous pouvez également utiliser var_dump pour vérifier le contenu de la variable de session


$response['prenom'] = $prenom;
$response['nom'] = $nom;
$response['email'] = $email;
$response['societe'] = $societe;
$response['tel'] = $tel;
$response['numRue'] = $numRue;
$response['rue'] = $rue;
$response['cdp'] = $cdp;
$response['ville'] = $ville;
$response['pays'] = $pays;








// Encodage des données en JSON
$jsonResponse = json_encode($response);

// Envoi du résultat au client
header('Content-Type: application/json');
echo $jsonResponse;
