<?php
session_start();


if (isset($_GET['nom']) && isset($_SESSION['panier'])) {
    $nomProduit = $_GET['nom'];
    foreach ($_SESSION['panier'] as $key => $produit) {
        if ($produit['nom'] == $nomProduit) {
            $_SESSION['nombreTotalArticles'] -= $produit['quantite'];
            unset($_SESSION['panier'][$key]);
            break;
        }
    }
}

//header('Location: ../cart.php');
echo '<script>
window.history.back();
</script>';
