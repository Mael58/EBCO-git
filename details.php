<?php
ob_start();
include 'template/header.php';
?>


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
    $des = $recipe['description'];
    $lienDoc = $recipe['lienDoc'];
    $lienDriver = $recipe['lienDriver']; ?>


    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <img class="imgDetail" src="<?= $image ?>" width="100%" id="ProductImg">
            </div>
            <div class="col-2">
                <p>Accueil / <?= $des ?> / <?= $nom ?></p>
                <h1><?= $nom ?></h1>
                <h5><?= $ref ?></h5>
                <!-- <p>Le composant FT232RL de FTDICHIP permet une
                    connexion USB vers une liaison <?= $nom ?> très rapide.<br>
                    Une liaison série virtuelle ou une programmation utilisant la
                    librairie DDL permet l'interfaçage aussi bien sous Windows,
                    Mac ou Linux</p> -->
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
                    <li>Lien de la documentation: <a class="lienDoc" href="<?= $lienDoc ?>"><?= $lienDoc ?></a></li>
                    <li>Telecharger les drivers <a href="<?= $lienDriver ?>" class="btn">Driver.zip</a></li>

                </ul>
                <br>



            </div>
        </div>
    </div>
<?php

} else {

    echo "Produit non trouvé.";
}


// if (isset($_SESSION['username'])) {


// L'utilisateur est connecté, permettez-lui d'ajouter au panier
// Insérez ici la logique pour ajouter au panier
?><script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnAjouterAuPanier = document.getElementById('ajouter-au-panier');
        var inputQuantite = document.getElementById('quantite');
        var panierCounter = document.getElementById('cart-count'); // Assuming you have an element with id 'panier-counter'


        btnAjouterAuPanier.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le lien de rediriger immédiatement

            var quantite = inputQuantite.value;
            var nom = "<?= $nom ?>";
            var prix = "<?= $prix ?>";
            var image = "<?= $image ?>";



            // Redirigez l'utilisateur vers ajouter_au_panier.php en incluant les valeurs dans la requête
            window.location.href = 'controller/ajouter_au_panier.php?nom=' + nom + '&prix=' + prix + '&image=' + image + '&quantite=' + quantite;

        });




    });
</script>
<?php

// } else {



//          // Supprimez le message de la session pour qu'il ne s'affiche qu'une fois

//     // L'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
//     header("Location: redirection.php");
//     exit;
// }
ob_end_flush();
?>


</div>


<?php include 'template/footer.html'; ?>