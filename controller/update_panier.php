<?php
session_start();

$nouveauSousTotal = 0; // Définir la variable à une valeur par défaut


// Récupérer les données envoyées par l'appel AJAX
$nomProduit = isset($_POST["nomProduit"]) ? $_POST["nomProduit"] : "";
$nouvelleQuantite = isset($_POST["nouvelleQuantite"]) ? $_POST["nouvelleQuantite"] : "";
$prix = isset($_POST["prix"]) ? $_POST["prix"] : "";
$nouveauSousTotal = floatval($prix) * floatval($nouvelleQuantite);


$_SESSION['nombreTotalArticles'] = $nouvelleQuantite;





echo json_encode(["success" => true, "nouveauSousTotal" => $nouveauSousTotal]);
