<?php
session_start();

$nouveauSousTotal = 0;



$nomProduit = isset($_POST["nomProduit"]) ? $_POST["nomProduit"] : "";
$nouvelleQuantite = isset($_POST["nouvelleQuantite"]) ? $_POST["nouvelleQuantite"] : "";
$prix = isset($_POST["prix"]) ? $_POST["prix"] : "";
$nouveauSousTotal = floatval($prix) * floatval($nouvelleQuantite);


if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as &$produit) {
        if ($produit['nom'] == $nomProduit) {
            // Mettre à jour la quantité et le prix du produit existant
            $produit['quantite'] = $nouvelleQuantite;
            $produit['prix'] = $prix;
            $produit['sousTotal'] = $nouveauSousTotal;
            $nombreTotalArticles = array_sum(array_column($_SESSION['panier'], 'quantite'));
    $_SESSION['nombreTotalArticles']= $nombreTotalArticles;
        }
    }
}





echo json_encode(["success" => true, "nouveauSousTotal" => $nouveauSousTotal, "quantite" => $nouvelleQuantite]);
