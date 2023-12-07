<?php
ob_start();
include_once 'template/header.php';
?>


<?php
// Récupérez la référence du produits depuis l'URL
$nomLien = $_GET['nom'];

try {
    $db = new PDO(
        'mysql:host=' . $db_host . ';dbname=' . $db_name . ';',
        $db_user,
        $db_pass,
    );
} catch (Exception $e) {
    die('erreur: ' . $e);
}

// Interrogez la base de données pour obtenir les détails du produits en fonction de la référence
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
    $quantite = $recipe['Quantite'];
    $_SESSION['TVA'] = $recipe['TVA'];
    $_SESSION['quantiteMax'] = $quantite;
  


    $db = null;

?>
    <div class="page-container">
        <div class="overlay" id="overlay"></div>

        <div class="small-container single-product" id="produit">
            <div class="row">
                <div class="col-2">
                    <img class="imgDetail" src="<?= $image ?>" width="100%" id="ProductImg">
                </div>
                <div class="col-2">
                    <p>Accueil / <?= $des ?> / <?= $nom ?></p>
                    <h1><?= $nom ?></h1>
                    <h5><?= $ref ?></h5>


                    <h4><?= $prix ?> €</h4>



                    <p> Quantité: <?= $quantite ?></p>

                    <?php
                    if ($quantite > 0) {
                        echo '<p style="color:green;">En stock</p>';
                        echo '<input type="number" id="quantite" value="1" min="1" max=' . $quantite . '>';
                        echo '<a href="#" id="ajouter-au-panier" class="btn">Ajouter au panier</a>';
                    } else {
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



        <div class="Panier" id="panier">
            <div class="Panier_header">
                <span>Panier</span>
                <button id="close" class="Panier_close">
                    <img src="Public/images/croix.png" alt="logo" width="50%">
                </button>
            </div>


            <div class="Panier_body" id="Panier_body">


            </div>


            <div class="Panier_footer">
                <p id="total"></p>



                <a href="Panier" class="btnPanier">Voir le panier</a>

                <p><small> Taxes incluses et frais de port calculés à la caisse</small></p>
            </div>

        <?php
    } else {
        echo '<p class="vide">Votre panier est vide.</p>';
    }
        ?>
        </div>
    </div>
    <script>
        const prixTotal = document.getElementById('total');
        document.addEventListener('DOMContentLoaded', function() {
            var btnAjouterAuPanier = document.getElementById('ajouter-au-panier');
            var inputQuantite = document.getElementById('quantite');
            var panierCounter = document.getElementById('cart-count'); // Assuming you have an element with id 'panier-counter'
            var quantiteDisponible = <?= $quantite ?>;

            var panier = document.getElementById('panier');
            var overlay = document.getElementById('overlay');
            var closeBtn = document.getElementById('close');
       

            function togglePanier() {

                panier.style.display = "flex"
                overlay.style.display = (panier.style.display === 'none') ? 'none' : 'block';

            }

            function Panier() {

                panier.style.display = "none"
                overlay.style.display = (panier.style.display === 'none') ? 'none' : 'block';
                location.reload();

            }


            closeBtn.addEventListener('click', Panier);




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


                fetch('Controller/ajouter_au_panier.php', {
                        method: 'POST', // ou 'GET' selon votre configuration
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'nom=' + encodeURIComponent(nom) +
                            '&prix=' + encodeURIComponent(prix) +
                            '&image=' + encodeURIComponent(image) +
                            '&quantite=' + encodeURIComponent(quantite),
                    })
                    .then(response => response.json())
                    .then(data => {

                        panierCounter.textContent = data.nombreTotalArticles;


                        console.log(data);
                        if (Array.isArray(data.produits)) {
                            const panierBody = document.getElementById('Panier_body');
                            // Effacez le contenu actuel du panier
                            var total = 0;
                            data.produits.forEach(produit => {
                                const produitHTML = `
            <div class="produit">
                <img src="${produit.image}" width="50%">
                <div>
                    <p>${produit.nom}</p>
                    <small>Prix: ${produit.prix} €</small>
                    <a href="Controller/supprimer.php?nom=${produit.nom}">
                        <img src="Public/images/poubelle.png" width="15px">
                    </a>
                    <input class="small-input" type="number" min="1" value="${produit.quantite}" 
                        id="quantite-${produit.nom}" data-prix="${produit.prix}" 
                        onchange="updateQuantitePrix(this, '${produit.nom}','${produit.prix}')">
                </div>
            </div>
        `;
                                var sousTotal = parseFloat(produit.prix) * parseFloat(produit.quantite);

                                total += sousTotal;


                                panierBody.innerHTML += produitHTML;
                            });
                        }
                        prixTotal.innerText = 'Total: ' + total + '€';
                        togglePanier();


                    })
                    .catch(error => {
                        console.error('Erreur lors de la requête AJAX:', error);
                    });

            });

        });

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

                        console.log(response.nouveauSousTotal);
                        prixTotal.innerHTML = 'Total: ' + response.nouveauSousTotal + '€';

                    }
                }
            };

            // Envoyer les données au serveur
            var params = "nomProduit=" + encodeURIComponent(nomProduit) + "&nouvelleQuantite=" + encodeURIComponent(nouvelleQuantite) + "&prix=" + encodeURIComponent(prix);
            xhr.send(params);
        }
    </script>
    <?php


    ob_end_flush();
    ?>
   
    <?php include 'template/footer.html'; ?>