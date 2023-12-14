<?php
session_start();

$nouveauSousTotal = 0;

$nomProduit = isset($_POST["nomProduit"]) ? $_POST["nomProduit"] : "";
$nouvelleQuantite = isset($_POST["nouvelleQuantite"]) ? $_POST["nouvelleQuantite"] : "";
$_SESSION['quantite']= $nouvelleQuantite;

$prix = isset($_POST["prix"]) ? $_POST["prix"] : "";
// $nouveauSousTotal = floatval($prix) * floatval($nouvelleQuantite);

if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    $nouveauTotal = 0;
    foreach ($_SESSION['panier'] as &$produit) {
        if ($produit['nom'] == $nomProduit) {
            // Mettre à jour la quantité, le prix et le sous-total du produit existant
            $produit['quantite'] = $nouvelleQuantite;
            $produit['prix'] = $prix;

            // Recalculer le sous-total en prenant en compte les réductions de prix dégressifs
            if ($produit['quantite'] >= 10 && $produit['quantite'] < 50) {
                $produit['sousTotal'] = $produit['quantite'] * $produit['prix'] * 0.97;
            } elseif ($produit['quantite'] >= 50 && $produit['quantite'] < 100) {
                $produit['sousTotal'] = $produit['quantite'] * $produit['prix'] * 0.931;
            } elseif ($produit['quantite'] >= 100) {
                $produit['sousTotal'] = $produit['quantite'] * $produit['prix'] * 0.866;
            } else {
                $produit['sousTotal'] = $produit['quantite'] * $produit['prix'];
            }
            $nouveauSousTotal = $produit['sousTotal'];

        }

   
        $nouveauTotal += $produit['sousTotal'];
        
    }

    // Mettre à jour le nombre total d'articles dans le panier
    $nombreTotalArticles = array_sum(array_column($_SESSION['panier'], 'quantite'));
    $_SESSION['nombreTotalArticles'] = $nombreTotalArticles;
}

echo json_encode(["success" => true, "nouveauSousTotal" => $nouveauSousTotal, "nouveauTotal" => $nouveauTotal, "quantite" => $nouvelleQuantite, "nomProduit"=> $nomProduit]);
?>
