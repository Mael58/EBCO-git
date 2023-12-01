<?php
session_start();

$nouveauSousTotal = 0;



$nomProduit = isset($_POST["nomProduit"]) ? $_POST["nomProduit"] : "";
$nouvelleQuantite = isset($_POST["nouvelleQuantite"]) ? $_POST["nouvelleQuantite"] : "";
$prix = isset($_POST["prix"]) ? $_POST["prix"] : "";
$nouveauSousTotal = floatval($prix) * floatval($nouvelleQuantite);

$_SESSION['nouveauSousTotal']= $nouveauSousTotal;

$_SESSION['nouvelleQuantite']= $nouvelleQuantite;





echo json_encode(["success" => true, "nouveauSousTotal" => $nouveauSousTotal, "quantite" => $nouvelleQuantite]);
