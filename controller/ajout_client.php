<?php
session_start();

$tel = $_POST['tel'];
$email = $_POST['email'];
$cdp = $_POST['cdp'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$adresse = $_POST['numRue'] . " " . $_POST['rue'];
$contact = $_POST['prenom'] . " " . $_POST['nom'];
$societe = $_POST['societe'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

$client = $societe . "-" . $contact;
$_SESSION['client'] = $client;



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
        $sqlQuery = "INSERT INTO clients (client, contact, tel, email, cdp, ville, adresse, pays, status) VALUES ('$societe', '$contact', '$tel', '$email', '$cdp', '$ville', '$adresse', '$pays', 'CS') ";
        $stmt = $pdo->prepare($sqlQuery);
    }
}


// Exécutez la requête
if ($stmt->execute()) {
    echo "Le client a été ajouté avec succès.";
} else {
    echo "Erreur lors de l'ajout du client : ";
}


$cart = $_SESSION['cart'][$_SESSION['username']];
echo var_dump($cart);


try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=ebcon_crm',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

$itemURL = '';

foreach ($cart as $produit) {
    $nomCommande = $produit['nom'];
    $quantite = $produit['quantite'];
    $prix = $produit['prix'];
    $total = $quantite * $prix;

    $itemURL .= '&nomCommande[]=' . urlencode($nomCommande) .
        '&prix[]=' . urlencode($prix) .
        '&quantite[]=' . urlencode($quantite);
}

// Fermez la connexion PDO lorsque vous avez terminé
$pdo = null;
// $tel = openssl_encrypt($tel, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// $email = openssl_encrypt($email, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// $cdp = openssl_encrypt($cdp, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// // $ville = openssl_encrypt($ville, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// // $pays = openssl_encrypt($pays, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// // $societe = openssl_encrypt($societe, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// $nom = openssl_encrypt($nom, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// $prenom = openssl_encrypt($prenom, 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// $numRue = openssl_encrypt($_POST['numRue'], 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
// $rue = openssl_encrypt($_POST['rue'], 'aes-256-cbc', $encryptionKey, 0, $encryptionIV);
$url = '../Paypal/index.php?' .
    'tel=' . urlencode($tel) .
    '&email=' . urlencode($email) .
    '&cdp=' . urlencode($cdp) .
    '&ville=' . urlencode($ville) .
    '&pays=' . urlencode($pays) .
    '&numRue=' . urlencode($_POST['numRue']) .
    '&rue=' . urlencode($_POST['rue']) .
    '&societe=' . urlencode($societe) .
    '&nom=' . urlencode($nom) .
    '&prenom=' . urlencode($prenom) . $itemURL;

// Répétez ce processus pour les autres données sensibles



header('Location:' . $url);
exit();
