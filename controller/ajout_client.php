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

$client = $societe . "-" . $contact;



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
    echo "Erreur lors de l'ajout du client : " . implode(" - ", $stmt->errorInfo());
}


$cart = $_SESSION['cart'];


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


    // Vérifiez d'abord si une commande similaire existe
    $sqlQuery = "SELECT ncde FROM commandes WHERE ref = ? AND clients = ?";
    $stmt = $pdo->prepare($sqlQuery);

    if ($stmt->execute([$nomCommande, $client])) {
        $existingCommandeId = $stmt->fetchColumn();

        if ($existingCommandeId) {
            // Une commande similaire existe, mettez à jour la quantité
            $sqlQuery = "UPDATE commandes SET qte = ?, prix = ? WHERE ncde = ?";
            $stmt = $pdo->prepare($sqlQuery);

            if ($stmt->execute([$quantite, $total, $existingCommandeId]) === false) {
                die("Erreur lors de la mise à jour de la commande : " . $stmt->errorInfo()[2]);
            }
        } else {
            // La commande n'existe pas, insérez une nouvelle commande
            $sqlQuery = "INSERT INTO commandes (ref, qte, prix, CA, clients) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sqlQuery);

            if ($stmt->execute([$nomCommande, $quantite, $prix, $total, $client]) === false) {
                die(" " . $stmt->errorInfo()[2]);
            }
        }
    } else {
        die("Erreur lors de la vérification de la commande existante : " . $stmt->errorInfo()[2]);
    }
}

// Fermez la connexion PDO lorsque vous avez terminé
$pdo = null;
$url = '../Paypal/index.php?' .
    'tel=' . urlencode($tel) .
    '&email=' . urlencode($email) .
    '&cdp=' . urlencode($cdp) .
    '&ville=' . urlencode($ville) .
    '&pays=' . urlencode($pays) .
    '&numRue=' . urlencode($_POST['numRue']) .
    '&rue=' . urlencode($_POST['rue']) .
    '&societe=' . urlencode($societe) . $itemURL;

header('Location:' . $url);
exit();
