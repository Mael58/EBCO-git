<?php
include_once 'template/header.php';
if (isset($_SESSION['TVA'])) {
    $TVA = $_SESSION['TVA'];
} else {
    $TVA = 20;
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
    
        $totalSansfraisPort=0;
   
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
                   
                    echo '<td><input type="number" min="1" value="' . $produit['quantite'] . '" id="quantite-' . $produit['nom'] . '" data-prix="' . $produit['prix'] . '" onchange="updateQuantitePrix(this, \'' . $produit['nom'] . '\',\'' . $produit['prix'] . '\')"></td>';
                    
                    $sousTotal = floatval($produit['prix']) * floatval($produit['quantite']);

                    $totalSansTVA += $produit['sousTotal']; 
                    $totalSansfraisPort += $produit['sousTotal']; 
                    echo '<td>' . $produit['sousTotal'] . ' €</td>';


                    echo '</tr>';
                }
                // Vérifiez si le total est inférieur à 50 euros

            }
            
            // if($totalSansTVA <50){
            //     $totalSansTVA +=$fraisPort;
              
               
            // }
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

                    var sousTotalCell = input.parentNode.nextElementSibling;

                    sousTotalCell.innerHTML = response.nouveauSousTotal.toFixed(2) + ' €';

                    var fraisPort=false;

                    var sousTotal = response.nouveauTotal.toFixed(2);
                    document.getElementById('sousTotalHT').innerText = sousTotal + ' €';
                    console.log(sousTotal)

                    // if (parseFloat(sousTotal) < 50) {
                    //     sousTotal = (parseFloat(sousTotal) + 10).toFixed(2);
                    //     console.log(sousTotal);
                    //     fraisPort = true;
                    // }

                    // document.getElementById('sousTotal').innerText = sousTotal + ' €';


                    var TVA = "<?php echo $TVA ?>";
                    var total = ((1 + TVA / 100) * sousTotal).toFixed(2);
                    document.getElementById('total').innerText = total + ' €';
  

                    // var fraisPortRow = document.getElementById('fraisPortRow');
                    // var totalAvecFraisPortRow = document.getElementById('totalAvecFraisPortRow');

                    // if (fraisPort) {
                    //     fraisPortRow.style.display = 'table-row';
                    //     totalAvecFraisPortRow.style.display = 'table-row';
                    // } else {
                    //     fraisPortRow.style.display = 'none';
                    //     totalAvecFraisPortRow.style.display = 'none';
                    // }




                }
            }
        };

        // Envoyer les données au serveur
        var params = "nomProduit=" + encodeURIComponent(nomProduit) + "&nouvelleQuantite=" + encodeURIComponent(nouvelleQuantite) + "&prix=" + encodeURIComponent(prix);
        xhr.send(params);
    }
</script>
<!-- <?php

        $total = ((100 + $TVA) / 100) * $totalSansTVA;
        ?> -->

<div class="total-price">
    <table>

    <tr>
            <td colspan="2">Total HT:</td>
            <td id="sousTotalHT"><?= $totalSansTVA ?> €</td>
        </tr>
       
        <!-- <tr id="fraisPortRow">
            <td colspan="2" >Frais de port</td>
            <td><?= $fraisPort ?> €</td>
        </tr>
     

        <tr id="totalAvecFraisPortRow">
            <td colspan="2" >Total avec frais de port:</td>
            <td id="sousTotal"><?= $totalSansTVA ?> €</td>
        </tr>
      -->
        
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



 include_once 'template/footer.php' ?>