<?php
include_once 'template/header.php';
if(isset($_SESSION['TVA'])){
    $TVA= $_SESSION['TVA'];
}else{
    $TVA=20;
}

 

?>



<!--------------Cart Items details--------------->
<div class="small-container cart-page">
    <table>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Sous-total</th>
           
        </tr>

        <?php
 
        $totalSansTVA = 0;
        $fraisPort = 10;
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
          

            foreach ($_SESSION['panier'] as $produit) {

                if (isset($produit['image']) && isset($produit['nom']) && isset($produit['prix']) && isset($produit['quantite'])) {
                    echo '<tr>';
                    echo '<td>';
                    echo '<div class="cart-info">';
                    echo '<img src="' . $produit['image'] . '">';
                    echo '<div>';
                    echo '<p>' . $produit['nom'] . '</p>';
                    echo '<small>Prix: ' . $produit['prix'] . ' €</small><br>';
                    echo '<a href="Controller/supprimer.php?nom=' . $produit['nom'] . '">Supprimer</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</td>';
                    //echo '<td><input type="number" value="' . $produit['quantite'] . '"></td>';
                    echo '<td><input type="number" min="1" max=' . $quantite . ' value="' . $produit['quantite'] . '" id="quantite-' . $produit['nom'] . '" data-prix="' . $produit['prix'] . '" onchange="updateQuantitePrix(this, \'' . $produit['nom'] . '\',\'' . $produit['prix'] . '\')"></td>';
                    // echo '<td>' .$sousTotal= ($produit['prix'] * $produit['quantite']) . ' €</td>';
                    // echo '</tr>';
                    $sousTotal = floatval($produit['prix']) * floatval($produit['quantite']);

                    $totalSansTVA += $sousTotal; // Ajoutez le sous-total au total
                    echo '<td>' . $sousTotal . ' €</td>';
                
                    echo '</tr>';
                }
                // Vérifiez si le total est inférieur à 50 euros
              
            }
        } else {
            echo '<tr><td colspan="3">Votre panier est vide.</td></tr>';
        }


        ?>

    </table>
</div>
<script>
    function updateQuantitePrix(input, nomProduit, prix) {
    var nouvelleQuantite = input.value;

    // Utiliser AJAX pour envoyer les données au serveur
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "Controller/update_panier.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Actualisez la quantité dans la partie visible du panier
                var sousTotalCell = input.parentNode.nextElementSibling;
                sousTotalCell.innerHTML = response.nouveauSousTotal + ' €';
                // Mettez à jour le total général

                var sousTotal= response.nouveauSousTotal;
                document.getElementById('sousTotal').innerText = sousTotal + ' €';


                var TVA= "<?php echo $TVA?>";              
                var total=((1+TVA)/100)*sousTotal;
                document.getElementById('total').innerText = total + ' €';

                

             
               
          
            }
        }
    };

    // Envoyer les données au serveur
    var params = "nomProduit=" + encodeURIComponent(nomProduit) + "&nouvelleQuantite=" + encodeURIComponent(nouvelleQuantite) + "&prix=" + encodeURIComponent(prix);
    xhr.send(params);
}

</script>
<!-- <?php

$total= ((100+$TVA)/100)*$totalSansTVA;
?> -->

<div class="total-price">
    <table>

        <tr>
            <td colspan="2">Total HT</td>
            <td id="sousTotal"><?= $totalSansTVA ?> €</td>
        </tr>
        <tr>
            <td colspan="2">TVA</td>
            <td><?= $TVA ?> %</td>
        </tr>
        <tr>
            <td colspan="2">Total</td>
            <td id="total"><?= $total ?> €</td>
        </tr>

    </table>
</div>
<div class="total-price">

    <?php
    if (!empty($_SESSION['panier'])) {
        echo '<a href="commandes" class="btn">Passer la commande &#8594;</a>';
    }
    ?>



</div>

</div>




<?php
if (isset($_SESSION['panier'])) {

    $_SESSION['cart'] = $_SESSION['panier'];
}
$_SESSION['total'] = $total;



include_once 'template/footer.html'; ?>