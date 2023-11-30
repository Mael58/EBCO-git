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
    $lienDriver = $recipe['lienDriver'];
    $quantite= $recipe['Quantite'];
    $TVA= $recipe['TVA'];

    

    $db=null;
    
    
    ?>


    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <img class="imgDetail" src="<?= $image ?>" width="100%" id="ProductImg">
            </div>
            <div class="col-2">
                <p>Accueil / <?= $des ?> / <?= $nom ?></p>
                <h1><?= $nom ?></h1>
                <h5><?= $ref ?></h5>

               
                <h4><?= $prix ?> €</h4>
            

                <p> Quantité: <?=$quantite?></p>

                <?php
                if($quantite>0){
    echo'<p style="color:green;">En stock</p>';
   echo '<input type="number" id="quantite" value="1" min="1" max='.$quantite.'>';
   echo '<a href="#" id="ajouter-au-panier" class="btn">Ajouter au panier</a>
      ';
              
                }else{
                    echo '<p style="color:red;">Produit indisponible</p>';
                }

                
                ?>
                
            

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


?><script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnAjouterAuPanier = document.getElementById('ajouter-au-panier');
        var inputQuantite = document.getElementById('quantite');
        var panierCounter = document.getElementById('cart-count'); // Assuming you have an element with id 'panier-counter'
       var quantiteDisponible= <?=$quantite?>;

        btnAjouterAuPanier.addEventListener('click', function(e) {
            e.preventDefault(); // Empêche le lien de rediriger immédiatement

            var quantite = inputQuantite.value;
            var nom = "<?= $nom ?>";

            if (parseInt(quantite) > quantiteDisponible || parseInt(quantite) <= 0) {
            alert("La quantité spécifiée n'est pas valide. Veuillez choisir une quantité comprise entre 1 et " + quantiteDisponible + ".");
            return; // Ne pas poursuivre l'ajout au panier
        }
          


           
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