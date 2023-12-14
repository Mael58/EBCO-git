<?php
ob_start();
include_once 'template/header.php';



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




    $db = null;


?>
    <p>Accueil / <?= $des ?> / <?= $nom ?></p><br>



    <div class="page-container">
        <div class="overlay" id="overlay"></div>


        <div class="row-details">
            <div class="col-detail-1">
                <h1><?= $nom ?></h1>
                <div class="produitContainer">
                    <div class="produit1">


                        <img class="imgDetail" alt="image-produit" src="<?= $image ?>" id="ProductImg">

                        <div class="spef">
                            <h3>Spécifications techniques:</h3>
                            <p class="spef-p">
                                <strong>Référence:</strong> <?= $ref ?>
                                </p>

                                <p class="spef-p">
                                <strong>Norme:</strong> <?= $norme ?>
                                </p>

                                <p class="spef-p">
                                <strong>Puissance:</strong> <?= $puissance ?>
                                </p>

                                <p class="spef-p">
                                <strong>Connecteur:</strong> <?= $connecteur ?>
                                </p>

                                <p class="spef-p">
                                <strong> Débit:</strong> <?= $dataRate ?>
                                </p>

                                <p class="spef-p">
                                <strong> Longueur:</strong> <?= $longueur ?>
                            </p>




                        </div>
                       
                        <div class="doc">
                            <h3>Documentations techniques</h3>
                            <p class="doc-p">
                                <strong>Lien de la documentation:</strong>
                                <a href="<?= $lienDoc ?>" alt="logo-pdf" target="_blank"><img class="pdf" title=" Fiche technique" src="Public/images/pdf.png"></a>
                            </p>
                            <p class="doc-p">
                                <strong>Télécharger les drivers:</strong>
                                <a href="<?= $lienDriver ?>" alt="logo-zip" download><img class="zip" title="Drivers.zip" src="Public\images\downloadZip-removebg-preview.png"></a>
                            </p>


                        </div>

                        <div class="produit2">
                        <h2 id="prix"> <?=$prix?> €</h2>



                        <?php


                        if ($quantite > 0) {
                            echo '<p style="color:green;">En stock</p>';
                            echo '<div class="container-quantite">';
                            echo '<h3 class="quantite">Quantité</h3>';
                           
                            echo '<input type="number" id="quantite" value="1" min="1" >';
                            echo '</div>';
                            echo '<a href="#" id="ajouter-au-panier" class="btn">Ajouter au panier</a>';
                        } else {
                            echo '<p style="color:red;">Produit indisponible</p>';
                        }


                        ?>
                    </div>
                    </div>


                    <!-- <div class="produit3">
                       

                    </div> -->


                 

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var inputQuantite = document.getElementById('quantite');
                                var prixElement = document.getElementById('prix');

                                inputQuantite.addEventListener('input', function() {
                                    var quantite = inputQuantite.value;

                                    var prixInitial = <?= $recipe['prix'] ?>;

                                    var prixReduit;

                                    if (quantite >= 10 && quantite < 50) {
                                        prixReduit = prixInitial * 0.97;
                                        console.log(prixReduit);
                                    } else if (quantite >= 50 && quantite < 100) {
                                        prixReduit = prixInitial * 0.931;
                                        console.log(prixReduit);
                                    } else if (quantite >= 100) {
                                        prixReduit = prixInitial * 0.866;
                                        console.log(prixReduit);
                                    } else {
                                        prixReduit = prixInitial;
                                    }

                                    // Affichage du prix réduit

                                    prixElement.innerHTML = '<h2>' + prixReduit.toFixed(2) + ' €</h2>';
                                });

                            });
                        </script>



                




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
    </div><br>
    <script>
        const prixTotal = document.getElementById('total');
        document.addEventListener('DOMContentLoaded', function() {
            var btnAjouterAuPanier = document.getElementById('ajouter-au-panier');
            var inputQuantite = document.getElementById('quantite');
            var panierCounter = document.getElementById('cart-count'); // Assuming you have an element with id 'panier-counter'
            // var quantiteDisponible = <?= $quantite ?>;

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

                        console.log('Produit dans le panier:', data);
                        console.log('Produit dans le panier:', data.produits);

                        panierCounter.textContent = data.nombreTotalArticles;



                        if (Array.isArray(data.produits) && data.produits.length > 0) {
                            const panierBody = document.getElementById('Panier_body');
                            panierBody.innerHTML = '';
                            var total = 0;

                            data.produits.forEach(produit => {
                                console.log('Produit dans le panier:', produit);

                                const produitHTML = `
            <div class="produit" id="quantite-${produit.nom}>
                <img src="${produit.image}" width="50%">
                <div>
                    <p>${produit.nom}</p>
                    <small id="prix-${produit.nom}">Prix: ${produit.prix} €</small>
                    <a href="Controller/supprimer.php?nom=${produit.nom}">
                        <img src="Public/images/poubelle.png" width="15px">
                    </a>
                    <input class="small-input" type="number" min="1"  value="${produit.quantite}" 
                        id="quantite-${produit.nom}" data-prix="${produit.prix}" 
                        onchange="updateQuantitePrix(this, '${produit.nom}','${produit.prix}')">
                </div>
            </div>`;
                                console.log(produit.prix);
                                console.log(produit.quantite);
                                var sousTotal = produit.sousTotal;


                                total += sousTotal;



                                panierBody.innerHTML += produitHTML;
                            });

                            prixTotal.innerText = 'Total: ' + total.toFixed(2) + '€';
                            togglePanier();

                        }
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

                        var prixAffiche = parseFloat(prix);

                        prixTotal.innerHTML = 'Total: ' + response.nouveauTotal.toFixed(2) + '€';
                        var quantite = response.quantite;
                        // var produitHTML = document.getElementById('quantite-' + nomProduit);
                        var prixElement = document.getElementById('prix-' + nomProduit);

                        if (quantite >= 10 && quantite < 50) {
                            prixAffiche *= 0.97;

                            prixElement.innerHTML = 'Prix: ' + prixAffiche.toFixed(2) + '€';
                        }
                        if (quantite >= 50 && quantite < 100) {
                            prixAffiche *= 0.93;

                            prixElement.innerHTML = 'Prix: ' + prixAffiche.toFixed(2) + '€';
                        }

                        if (quantite >= 100) {
                            prixAffiche *= 0.86;

                            prixElement.innerHTML = 'Prix: ' + prixAffiche.toFixed(2) + '€';

                        }



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




    <?php include_once 'template/footer.html'; ?>