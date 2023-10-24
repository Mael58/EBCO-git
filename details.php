<?php include 'template/header.php'; ?>


<?php
// Récupérez la référence du produit depuis l'URL
$nomLien = $_GET['nom'];
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=ebcon_crm;',
        'root',
        ''
    );
} catch (Exception $e) {
    die('erreur: ' . $e);
}

// Interrogez la base de données pour obtenir les détails du produit en fonction de la référence
$sqlQuery = "SELECT * FROM vente WHERE nom = :nom";
$donnees = $db->prepare($sqlQuery);
$donnees->bindParam(':nom', $nomLien);
$donnees->execute();
$recipe = $donnees->fetch();

if ($recipe) {
    // Affichez les détails du produit
    $nom = $recipe['nom'];
    $image = $recipe['lienImage'];
    $norme = $recipe['norme'];
    $puissance = $recipe['puissance'];
    $connecteur = $recipe['connecteur'];
    $dataRate = $recipe['dataRate'];
    $longueur = $recipe['longueur'];
    $categorie = $recipe['categorie'];
    $prix = $recipe['prix'];
    $ref = $recipe['reference'];
    $des = $recipe['description']; ?>


    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <img src="<?= $image ?>" width="100%" id="ProductImg">
            </div>
            <div class="col-2">
                <p>Accueil / <?= $des ?> / <?= $nom ?></p>
                <h1><?= $nom ?></h1>
                <h5><?= $ref ?></h5>
                <p>Le composant FT232RL de FTDICHIP permet une
                    connexion USB vers une liaison <?= $nom ?> très rapide.<br>
                    Une liaison série virtuelle ou une programmation utilisant la
                    librairie DDL permet l'interfaçage aussi bien sous Windows,
                    Mac ou Linux</p>
                <h4><?= $prix ?> €</h4>
                <!-- 
            <select>
               <option>Personnalisation</option>
               <option>OUI</option>
              
              
           </select> -->
                <input type="number" id="quantite" value="1">
                <a href="#" id="ajouter-au-panier" class="btn">Ajouter au panier</a>

                <h3>Spécifications techniques:</h3>
                <br>

                <ul>
                    <li>Norme: <?= $norme ?> </li>
                    <li>Puissance: <?= $puissance ?> </li>
                    <li>Connecteur: <?= $connecteur ?> </li>
                    <li>Debit: <?= $dataRate ?> </li>
                    <li>Longueur: <?= $longueur ?> </li>
                </ul>
                <br>



            </div>
        </div>
    </div>
<?php

} else {

    echo "Produit non trouvé.";
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnAjouterAuPanier = document.getElementById('ajouter-au-panier');
        var inputQuantite = document.getElementById('quantite');

        btnAjouterAuPanier.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le lien de rediriger immédiatement

            var quantite = inputQuantite.value;
            var nom = "<?= $nom ?>";
            var prix = "<?= $prix ?>";
            var image = "<?= $image ?>";
            updateCartCount();

            // Redirigez l'utilisateur vers ajouter_au_panier.php en incluant les valeurs dans la requête
            window.location.href = 'controller/ajouter_au_panier.php?nom=' + nom + '&prix=' + prix + '&image=' + image + '&quantite=' + quantite;

        });
    });

    function updateCartCount() {

        var cartCountElement = document.getElementById("cart-count");
        var currentCount = parseInt(cartCountElement.innerText);
        var quantite = document.getElementById('quantite').value;

        cartCountElement.innerText = currentCount + parseInt(quantite);
        console.log(cartCountElement);
    }
</script>
</div>


<?php include 'template/footer.html'; ?>