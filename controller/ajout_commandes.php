<?php
session_start();

$cart = $_SESSION['cart'];
$client = $_SESSION['client'];

// Récupérer les données JSON envoyées par le client
$data = json_decode(file_get_contents("php://input"));
echo var_dump($data);

// Vous pouvez maintenant traiter les données, les insérer dans la base de données, etc.
$nomCommande = $data->nomCommande;
$quantite = $data->quantite;
$prix = $data->prix;

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
if (is_array($nomCommande) && is_array($quantite) && is_array($prix)) {
    for ($i = 0; $i < count($nomCommande); $i++) {
        $nom = $nomCommande[$i];
        $quantiteProduit = $quantite[$i];
        $prixProduit = $prix[$i];
        $total = $quantiteProduit * $prixProduit;

        // Vérifiez d'abord si une commande similaire existe
        $sqlQuery = "SELECT ncde FROM commandes WHERE ref = ? AND clients = ?";
        $stmt = $pdo->prepare($sqlQuery);

        if ($stmt->execute([$nom, $client])) {
            $existingCommandeId = $stmt->fetchColumn();

            if ($existingCommandeId) {
                // Une commande similaire existe, mettez à jour la quantité
                $sqlQuery = "UPDATE commandes SET qte = ?, prix = ? WHERE ncde = ?";
                $stmt = $pdo->prepare($sqlQuery);

                if ($stmt->execute([$quantiteProduit, $total, $existingCommandeId]) === false) {
                    die("Erreur lors de la mise à jour de la commande : " . $stmt->errorInfo()[2]);
                }
            } else {
                // La commande n'existe pas, insérez une nouvelle commande
                $sqlQuery = "INSERT INTO commandes (ref, qte, prix, CA, clients) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sqlQuery);

                if ($stmt->execute([$nom, $quantiteProduit, $prixProduit, $total, $client]) === false) {
                    die("Erreur lors de l'insertion de la commande : " . $stmt->errorInfo()[2]);
                }
            }
        } else {
            die("Erreur lors de la vérification de la commande existante : " . $stmt->errorInfo()[2]);
        }
    }
} else {
    echo "Les tableaux sont nuls ou incorrects.";
}

// Répondre au client (facultatif)
$response = array('message' => 'Données enregistrées avec succès.');
echo json_encode($response);
