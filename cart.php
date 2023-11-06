<?php
include 'template/header.php' ?>



<!--------------Cart Items details--------------->
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Sous-total</th>
            <th>Frais de port</th>
        </tr>

        <?php

        $total = 0;
        $fraisPort = 10;
        if (isset($_SESSION['panier'][$_SESSION['username']]) && !empty($_SESSION['panier'][$_SESSION['username']])) {
            foreach ($_SESSION['panier'][$_SESSION['username']] as $produit) {
                if (isset($produit['image']) && isset($produit['nom']) && isset($produit['prix']) && isset($produit['quantite'])) {
                    echo '<tr>';
                    echo '<td>';
                    echo '<div class="cart-info">';
                    echo '<img src="' . $produit['image'] . '">';
                    echo '<div>';
                    echo '<p>' . $produit['nom'] . '</p>';
                    echo '<small>Prix: ' . $produit['prix'] . ' €</small><br>';
                    echo '<a href="controller/supprimer.php?nom=' . $produit['nom'] . '">Supprimer</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    echo '<td><input type="number" value="' . $produit['quantite'] . '"></td>';
                    // echo '<td>' .$sousTotal= ($produit['prix'] * $produit['quantite']) . ' €</td>';
                    // echo '</tr>';
                    $sousTotal = floatval($produit['prix']) * floatval($produit['quantite']);

                    $total += $sousTotal; // Ajoutez le sous-total au total
                    echo '<td>' . $sousTotal . ' €</td>';
                    echo '<td>' . $fraisPort . ' €</td>';
                    echo '</tr>';
                }
                // Vérifiez si le total est inférieur à 50 euros
                if ($total < 50) {
                    $total += $fraisPort;
                } else {
                    $fraisPort = 0;
                }
            }
        } else {
            echo '<tr><td colspan="3">Votre panier est vide.</td></tr>';
        }


        ?>

    </table>
</div>


<div class="total-price">
    <table>

        <tr>
            <td colspan="2">Total</td>
            <td><?= $total ?></td>
        </tr>

    </table>
</div>
<div class="total-price">
    <?php
    if (isset($_SESSION['username'])) { ?>
        <a href="adresse.php" class="btn">Procéder au paiement &#8594;</a>
    <?php
    } else {
        header("Location: redirection.php");
    }
    ?>
</div>

</div>




<?php
if (isset($_SESSION['panier'])) {
    $_SESSION['cart'][$_SESSION['username']] = $_SESSION['panier'][$_SESSION['username']];
}
$_SESSION['total'] = $total;



include 'template/footer.html'; ?>