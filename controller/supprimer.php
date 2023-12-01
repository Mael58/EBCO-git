<?php
session_start();

if (isset($_GET['nom']) && isset($_SESSION['panier']) && is_array($_SESSION['panier'])) {
    $nomProduit = $_GET['nom'];

    foreach ($_SESSION['panier'] as $key => $produit) {
        if (isset($produit['nom']) && $produit['nom'] == $nomProduit) {
            $_SESSION['nombreTotalArticles'] -= $produit['quantite'];
            unset($_SESSION['panier'][$key]);
            break;
        }
    }
}

// Rediriger ou faire d'autres actions ici
echo '<script>
window.history.back();
</script>';
?>
