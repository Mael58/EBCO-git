<?php include_once 'template/header.php';
ob_start();
include_once 'Model/ProduitsBDD.php';






if (isset($_SESSION['adresse'])) {
    $prenom = $_SESSION['adresse']['prenom'];
    $nom = $_SESSION['adresse']['nom'];
    $email = $_SESSION['adresse']['email'];

    $telephone = $_SESSION['adresse']['tel'];
    $codePostal = $_SESSION['adresse']['cdp'];
    $ville = $_SESSION['adresse']['ville'];
    $pays = $_SESSION['adresse']['pays'];
    $rue = $_SESSION['adresse']['rue'];
    $numeroRue = $_SESSION['adresse']['numRue'];
}


if (isset($_SESSION['TVA'])) {
    $TVA = $_SESSION['TVA'];
} else {
    $TVA = 20;
}


?>

<body>





    <div class="step">
        <div class="step-content">

            <a href="../EBCO-git/cart.php" class="cart-item completed" data-step="1">

                <span class="text">Panier</span>
            </a>
            <a class="cart-item completed" data-step="2">
                <span class="text">Se connecter</span>
            </a>
            <a class="cart-item" data-step="3">
                <span class="text">Adresse</span>
            </a>

            <a class="cart-item" data-step="4">
                <span class="text">Verification</span>
            </a>
            <!-- Add more steps as needed -->
        </div>
    </div>







    <div class="co" id="LoginForm">
        <div class="contain">
            <h3>Connexion</h3>
            <form class="connexion" method="post">
                <input type="text" name="username2" id="username2" placeholder="Saisir votre nom d'utilisateur">
                <input type="password" name="password2" id="password2" placeholder="Saisir votre mot de passe">
                <!-- <div class="remember">
                        <input type="checkbox" class="check" name="remember" value="1">Se souvenir de moi
                    </div> -->
                <button type="submit" class="btn" id="bouton">Se connecter</button>
                <a href="error.php">Mot de passe oublié</a>
            </form>
        </div>



        <div class="form-separator"></div>
        <div class="contain">
            <h3>Inscription</h3>
            <form id="RegForm" class="reg" method="post">
                <input type="text" name="username" placeholder="Saisir votre nom d'utilisateur">
                <!-- <input type="email" placeholder="E-mail"> -->
                <input type="password" name="password" placeholder="Saisir votre mot de passe">
                <button type="submit" class="btn">S'inscrire</button>
            </form>
        </div>


    </div>
    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $bdd = new ProduitsBDD;
        $bdd->inscription($username, $password);
    }






    ?>





    <div class="container-achat" id="formAdresse">

        <div class="col-2-achat">
            <div class="form-container-achat">
                <h2 id="show">Adresse de livraison</h2>
                <form method='POST'>
                    <legend>Merci d'inscrire vos informations de livraison</legend>
                    <section class="section-nom">
                        <h2>1.Nom complet</h2>
                        <div class="div-nom">
                            <label for="prenom">Prénom*</label>
                            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo isset($_SESSION['adresse']['prenom']) ? $_SESSION['adresse']['prenom'] : '';  ?>">

                            <label for="nom">nom*</label>
                            <input type="text" name="nom" placeholder="Nom" value="<?php echo isset($_SESSION['adresse']['nom']) ? $_SESSION['adresse']['nom'] : '';  ?>">
                        </div>

                    </section>
                    <section class="info">
                        <h2>2.Informations personnelles</h2>

                        <label for="mail">E-mail*</label>
                        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_SESSION['adresse']['email']) ? $_SESSION['adresse']['email'] : '';  ?>">

                        <label for="societe">Société</label>
                        <input type="text" name="societe" placeholder="Votre société pour qui vous achetez" value="<?php echo isset($_SESSION['adresse']['societe']) ? $_SESSION['adresse']['societe'] : '';  ?>">

                        <label for="tel">Numéro de téléphone</label>
                        <input type="tel" name="tel" placeholder="Numéro de téléphone" value="<?php echo isset($_SESSION['adresse']['tel']) ? $_SESSION['adresse']['tel'] : '';  ?>">

                    </section>

                    <section class="adresse">
                        <h2>3.Adresse</h2>


                        <label for="numRue">Numéro de rue*</label>
                        <input type="text" name="numRue" placeholder="Numéro de la rue" value="<?php echo isset($_SESSION['adresse']['numRue']) ? $_SESSION['adresse']['numRue'] : '';  ?>">

                        <label for="rue">Rue*</label>
                        <input type="text" name="rue" placeholder="Nom de la rue" value="<?php echo isset($_SESSION['adresse']['rue']) ? $_SESSION['adresse']['rue'] : '';  ?>">

                        <label for="cdp">Code postal*</label>
                        <input type="number" name="cdp" placeholder="Code postal" value="<?php echo isset($_SESSION['adresse']['cdp']) ? $_SESSION['adresse']['cdp'] : '';  ?>">

                        <label for="ville">Ville*</label>
                        <input type="text" name="ville" placeholder="Ville" value="<?php echo isset($_SESSION['adresse']['ville']) ? $_SESSION['adresse']['ville'] : '';  ?>">

                        <label for="pays">Pays</label>
                        <select name="pays">
                            <option value="FR" <?php echo (isset($_SESSION['adresse']['pays']) && $_SESSION['adresse']['pays'] == 'FR') ? 'selected' : ''; ?>>France</option>
                            <option value="BE" <?php echo (isset($_SESSION['adresse']['pays']) && $_SESSION['adresse']['pays'] == 'BE') ? 'selected' : ''; ?>>Belgique</option>
                            <option value="CH" <?php echo (isset($_SESSION['adresse']['pays']) && $_SESSION['adresse']['pays'] == 'CH') ? 'selected' : ''; ?>>Suisse</option>
                            <option value="IT" <?php echo (isset($_SESSION['adresse']['pays']) && $_SESSION['adresse']['pays'] == 'IT') ? 'selected' : ''; ?>>Italie</option>
                            <option value="ES" <?php echo (isset($_SESSION['adresse']['pays']) && $_SESSION['adresse']['pays'] == 'ES') ? 'selected' : ''; ?>>Espagne</option>
                            <option value="" <?php echo (empty($_SESSION['adresse']['pays'])) ? 'selected' : ''; ?>>Autre</option>

                    </section>
                    <input type="submit" class="btn" id="btnAdresse" <?php if (isset($_SESSION['adresse'])) {
                                                                            echo 'value="continuer"';
                                                                        } else {
                                                                            echo 'value="Ajouter votre adresse"';
                                                                        } ?>>
                </form>
            </div>
            <div class="livraison-container">
                <input type="checkbox" name="livraison" id="livraison" class="livraison" checked>
                <label for="livraison">Utiliser l'adresse de livraison comme l'adresse de facturation</label>
            </div>



        </div>

    </div>







    <div class="container-facturation" id="container-facturation">

        <div class="col-2-achat">
            <div class="form-container-achat">
                <h2 class="titre" id="show">Adresse de facturation</h2>
                <form method='POST'>
                    <legend>Merci d'inscrire vos informations de livraison</legend>
                    <section class="section-nom">
                        <h2>1.Nom complet</h2>
                        <div class="div-nom">
                            <label for="prenom">Prénom*</label>
                            <input type="text" name="prenom" placeholder="Prénom" value="<?php echo isset($_SESSION['adresseFacturation']['prenom']) ? $_SESSION['adresseFacturation']['prenom'] : '';  ?>">

                            <label for="nom">nom*</label>
                            <input type="text" name="nom" placeholder="Nom" value="<?php echo isset($_SESSION['adresseFacturation']['nom']) ? $_SESSION['adresseFacturation']['nom'] : '';  ?>">
                        </div>

                    </section>
                    <section class="info">
                        <h2>2.Informations personnelles</h2>

                        <label for="mail">E-mail*</label>
                        <input type="email" name="email" placeholder="Email" value="<?php echo isset($_SESSION['adresseFacturation']['email']) ? $_SESSION['adresseFacturation']['email'] : '';  ?>">

                        <label for="societe">Société</label>
                        <input type="text" name="societe" placeholder="Votre société pour qui vous achetez" value="<?php echo isset($_SESSION['adresseFacturation']['societe']) ? $_SESSION['adresseFacturation']['societe'] : '';  ?>">

                        <label for="tel">Numéro de téléphone</label>
                        <input type="tel" name="tel" placeholder="Numéro de téléphone" value="<?php echo isset($_SESSION['adresseFacturation']['tel']) ? $_SESSION['adresseFacturation']['tel'] : '';  ?>">

                    </section>

                    <section class="adresse">
                        <h2>3.Adresse</h2>


                        <label for="numRue">Numéro de rue*</label>
                        <input type="text" name="numRue" placeholder="Numéro de la rue" value="<?php echo isset($_SESSION['adresseFacturation']['numRue']) ? $_SESSION['adresseFacturation']['numRue'] : '';  ?>">

                        <label for="rue">Rue*</label>
                        <input type="text" name="rue" placeholder="Nom de la rue" value="<?php echo isset($_SESSION['adresseFacturation']['rue']) ? $_SESSION['adresseFacturation']['rue'] : '';  ?>">

                        <label for="cdp">Code postal*</label>
                        <input type="number" name="cdp" placeholder="Code postal" value="<?php echo isset($_SESSION['adresseFacturation']['cdp']) ? $_SESSION['adresseFacturation']['cdp'] : '';  ?>">

                        <label for="ville">Ville*</label>
                        <input type="text" name="ville" placeholder="Ville" value="<?php echo isset($_SESSION['adresseFacturation']['ville']) ? $_SESSION['adresseFacturation']['ville'] : '';  ?>">

                        <label for="pays">Pays</label>
                        <select name="pays">
                            <option value="FR" <?php echo (isset($_SESSION['adresseFacturation']['pays']) && $_SESSION['adresseFacturation']['pays'] == 'FR') ? 'selected' : ''; ?>>France</option>
                            <option value="BE" <?php echo (isset($_SESSION['adresseFacturation']['pays']) && $_SESSION['adresseFacturation']['pays'] == 'BE') ? 'selected' : ''; ?>>Belgique</option>
                            <option value="CH" <?php echo (isset($_SESSION['adresseFacturation']['pays']) && $_SESSION['adresseFacturation']['pays'] == 'CH') ? 'selected' : ''; ?>>Suisse</option>
                            <option value="IT" <?php echo (isset($_SESSION['adresseFacturation']['pays']) && $_SESSION['adresseFacturation']['pays'] == 'IT') ? 'selected' : ''; ?>>Italie</option>
                            <option value="ES" <?php echo (isset($_SESSION['adresseFacturation']['pays']) && $_SESSION['adresseFacturation']['pays'] == 'ES') ? 'selected' : ''; ?>>Espagne</option>
                            <option value="" <?php echo (empty($_SESSION['adresseFacturation']['pays'])) ? 'selected' : ''; ?>>Autre</option>

                    </section>
                    <input type="submit" class="btn" id="btnLivraison" <?php if (isset($_SESSION['adresse de facturation '])) {
                                                                            echo 'value="continuer"';
                                                                        } else {
                                                                            echo 'value="Ajouter votre adresse de facturation"';
                                                                        } ?>>
                </form>
            </div>
        </div>
    </div>






    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginForm = document.getElementById("LoginForm");
            const regForm = document.getElementById("RegForm");
            const formAdresse = document.getElementById("formAdresse");
            const steps = document.querySelectorAll('.cart-item');
            const modifier = document.getElementById('modifier');
            const verif = document.getElementById('verif');
            const checkbox = document.getElementById("livraison");
            const facturation = document.getElementById("container-facturation");
            const boutton = document.getElementById("btnAdresse");
            const adresse = document.getElementById('adresseCommande');
            const recap = document.getElementById("recapAdresse");
            var reloadPage = true;



            const loginButton = document.getElementById('bouton');
            loginButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting
                makeAjaxRequest();
            });

            function makeAjaxRequest() {
                var username = document.getElementById('username2').value;
                var password = document.getElementById('password2').value;
                var url = 'Model/traitement.php?username2=' + encodeURIComponent(username) + '&password2=' + encodeURIComponent(password);

                fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(function(response) {
                        return response.json(); // Attend une réponse JSON
                    })
                    .then(function(data) {
                        location.reload();
                    });
            }




            <?php
            if (isset($_SESSION['username'])) {
                echo 'handleLogin();';
            }
            if (isset($_SESSION['adresse'])) {
                echo 'handleAddAdresse()';
            }

            ?>



            function handleLogin() {
                formAdresse.style.display = "flex";
                loginForm.style.display = "none";
                regForm.style.display = "none";
                verif.style.display = "none";
                recap.style = "none";
                // adresse.style.display = "none";
                updateCompletedSteps(3);
            }



            function handleAddAdresse() {


                const prenomLivraison = document.querySelector('#formAdresse input[name="prenom"]').value;
                const nomLivraison = document.querySelector('#formAdresse input[name="nom"]').value
                const emailLivraison = document.querySelector('#formAdresse input[name="email"]').value;
                const societeLivraison = document.querySelector('#formAdresse input[name="societe"]').value;
                const telLivraison = document.querySelector('#formAdresse input[name="tel"]').value;
                const numRueLivraison = document.querySelector('#formAdresse input[name="numRue"]').value;
                const rueLivraison = document.querySelector('#formAdresse input[name="rue"]').value;
                const cdpLivraison = document.querySelector('#formAdresse input[name="cdp"]').value;
                const villeLivraison = document.querySelector('#formAdresse input[name="ville"]').value;
                const paysLivraison = document.querySelector('#formAdresse select[name="pays"]').value;

                const prenomFacturation = document.querySelector('#container-facturation input[name="prenom"]').value;
                const nomFacturation = document.querySelector('#container-facturation input[name="nom"]').value;
                const emailFacturation = document.querySelector('#container-facturation input[name="email"]').value;
                const societeFacturation = document.querySelector('#formAdresse input[name="societe"]').value;
                const telFacturation = document.querySelector('#formAdresse input[name="tel"]').value;
                const numRueFacturation = document.querySelector('#formAdresse input[name="numRue"]').value;
                const rueFacturation = document.querySelector('#formAdresse input[name="rue"]').value;
                const cdpFacturation = document.querySelector('#formAdresse input[name="cdp"]').value;
                const villeFacturation = document.querySelector('#formAdresse input[name="ville"]').value;
                const paysFacturation = document.querySelector('#formAdresse select[name="pays"]').value;





                const formData = new FormData();
                const formData2 = new FormData();


                formData.append('prenomLivraison', prenomLivraison);
                formData.append('nomLivraison', nomLivraison);
                formData.append('emailLivraison', emailLivraison);
                formData.append('societeLivraison', societeLivraison);
                formData.append('telLivraison', telLivraison);
                formData.append('numRueLivraison', numRueLivraison);
                formData.append('rueLivraison', rueLivraison);
                formData.append('cdpLivraison', cdpLivraison);
                formData.append('villeLivraison', villeLivraison);
                formData.append('paysLivraison', paysLivraison);

                formData.append('prenomFacturation', prenomFacturation);
                formData.append('nomFacturation', nomFacturation);
                formData.append('emailFacturation', emailFacturation);
                formData.append('societeFacturation', societeFacturation);
                formData.append('telFacturation', telFacturation);
                formData.append('numRueFacturation', numRueFacturation);
                formData.append('rueFacturation', rueFacturation);
                formData.append('cdpFacturation', cdpFacturation);
                formData.append('villeFacturation', villeFacturation);
                formData.append('paysFacturation', paysFacturation);

                formData2.append('prenomLivraison', prenomLivraison);
                formData2.append('nomLivraison', nomLivraison);
                formData2.append('emailLivraison', emailLivraison);
                formData2.append('societeLivraison', societeLivraison);
                formData2.append('telLivraison', telLivraison);
                formData2.append('numRueLivraison', numRueLivraison);
                formData2.append('rueLivraison', rueLivraison);
                formData2.append('cdpLivraison', cdpLivraison);
                formData2.append('villeLivraison', villeLivraison);
                formData2.append('paysLivraison', paysLivraison);


                function AjaxRequest(url) {
                    return fetch(url, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .catch(error => {
                            console.error('Erreur lors de l\'envoi de la requête AJAX:', error);
                        });
                }


                AjaxRequest('Controller/formAdresse.php')
                    .then(result1 => {






                        updateFacturation(result1);
                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'exécution de la première requête AJAX:', error);
                    });


                fetch('Controller/ajout_client.php', {
                        method: 'POST',
                        body: formData2
                    })
                    .then(response => response.json())
                    .catch(error => {
                        console.error('Erreur lors de l\'envoi de la requête AJAX:', error);
                    });





                formAdresse.style.display = "none";
                facturation.style.display = "none";
                // adresse.style.display = "flex";
                verif.style.display = "flex";
                recap.style.display = "block";
                updateCompletedSteps(4);




            }

            // function getPays(data) {
            //     var pays1 = data.livraison.pays;
            //     return pays1;

            // }


            function updateFacturation(data) {
                document.getElementById('LivraisonPrenom').innerHTML = `<strong>Prénom:</strong> ${data.livraison.prenom}`;
                document.getElementById('LivraisonNom').innerHTML = `<strong>Nom:</strong> ${data.livraison.nom}`;
                document.getElementById('LivraisonEmail').innerHTML = `<strong>Email:</strong> ${data.livraison.email}`;
                document.getElementById('LivraisonTelephone').innerHTML = `<strong>Téléphone:</strong> ${data.livraison.tel}`;
                document.getElementById('LivraisonCodePostal').innerHTML = `<strong>Code Postal:</strong> ${data.livraison.cdp}`;
                document.getElementById('LivraisonAdresse').innerHTML = `<strong>Adresse:</strong> ${data.livraison.numRue} ${data.livraison.rue}, ${data.livraison.ville}`;


            }







            modifier.addEventListener('click', function() {
                handleLogin();
            })


            const btnAdresse = document.getElementById('btnAdresse');
            const btnLivraison = document.getElementById("btnLivraison");
            btnLivraison.addEventListener('click', function(event) {
                event.preventDefault();
                handleAddAdresse();



            });

            btnAdresse.addEventListener('click', function(event) {
                event.preventDefault();

                handleAddAdresse();



            });


            function updateCompletedSteps(stepNumber) {
                steps.forEach(step => {
                    const currentStep = parseInt(step.getAttribute('data-step'));
                    step.classList.toggle('completed', currentStep <= stepNumber);
                });
            }







            checkbox.addEventListener("click", function() {
                if (this.checked) {
                    facturation.style.display = "none";
                    boutton.style.display = "block"
                } else {
                    facturation.style.display = "flex";
                    boutton.style.display = "none"
                }
            })



        });
    </script>




    <div class="recapAdresse" id="recapAdresse">


        <p id="LivraisonPrenom"><strong>Prénom:</strong> </p>
        <p id="LivraisonNom"><strong>Nom:</strong> </p>
        <p id="LivraisonEmail"><strong>Email:</strong> </p>
        <p id="LivraisonTelephone"><strong>Téléphone:</strong> </p>
        <p id="LivraisonCodePostal"><strong>Code Postal:</strong> </p>
        <p id="LivraisonAdresse"><strong>Adresse:</strong> </p>


        <p id="modifier">Modifier</p>
    </div>



    <?php

    ?>
    <div class="verif" id="verif">






        <div class="cart">
            <table class="table">
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Sous total</th>

                </tr>

                <?php

                $montantTotal = 0;
                $total = 0;
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
                            echo '<a href="controller/supprimer.php?nom=' . $produit['nom'] . '">Supprimer</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';

                            // echo '<td>' .$sousTotal= ($produit['prix'] * $produit['quantite']) . ' €</td>';
                            // echo '</tr>';
                            $sousTotal = floatval($produit['prix']) * floatval($produit['quantite']);

                            $montantTotal += $produit['sousTotal'];
                            echo '<td>' . $produit['prix'] . ' €</td>';
                            echo '<td><input type="number" min="1" value="' . $produit['quantite'] . '" id="quantite-' . $produit['nom'] . '" data-prix="' . $produit['prix'] . '" onchange="updateQuantitePrix(this, \'' . $produit['nom'] . '\',\'' . $produit['prix'] . '\')"></td>';
                            echo '<td>' . $produit['sousTotal'] . ' €</td>';
                            echo '</tr>';
                        }
                    }
                } else {
                    echo '<tr><td colspan="3">Votre panier est vide.</td></tr>';
                }


                ?>

            </table>


            <script>
                var sousTotal;
                var frais_port;
                var tvaPrix;
                var prenomLivraison = "<?php echo $prenom; ?>";
                var nomLivraison = "<?php echo $nom; ?>";
                var numRue = "<?php echo $numeroRue; ?>";
                var rue = "<?php echo $rue; ?>";

                var quantite;
                var montantUnitaire;
                var nomProduit1;
                

                var cdpLivraison = "<?php echo $codePostal; ?>";

                var villeLivraison = "<?php echo $ville; ?>";
                var paysLivraison = "<?php echo $pays; ?>";


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
                                var pays = response.pays;
                               
                                var sousTotalCell = input.parentNode.nextElementSibling;
                                sousTotalCell.innerHTML = response.nouveauSousTotal.toFixed(2) + ' €';


                                sousTotal = response.nouveauTotal.toFixed(2);
                                frais_port = <?= $fraisPort ?>;

                                if (pays == "FR") {
                                    if (sousTotal < 50) {
                                        var TotalFraisPort = parseFloat(sousTotal) + frais_port;
                                        document.getElementById('TotalPort').innerHTML = '<p><strong>Total avec frais de port:</strong> ' + TotalFraisPort + ' EUR </p>'
                                        var TVA = "<?php echo $TVA ?>";
                                        tvaPrix = (TotalFraisPort * TVA) / 100;
                                        var total = ((1 + TVA / 100) * TotalFraisPort).toFixed(2);
                                        document.getElementById('total').innerText = "TOTAL : " + total + " €";
                                        document.getElementById('TotalPort').style.display = "block";
                                        document.getElementById('fraisPort').style.display = "block";
                                    } else {
                                        var TVA = "<?php echo $TVA ?>";
                                        tvaPrix = (sousTotal * TVA) / 100;
                                        var total = ((1 + TVA / 100) * sousTotal).toFixed(2);
                                        document.getElementById('total').innerText = "TOTAL : " + total + " €";
                                        document.getElementById('TotalPort').style.display = "none";
                                        document.getElementById('fraisPort').style.display = "none";
                                    }
                                } else {
                                    if (sousTotal < 70) {
                                        var TotalFraisPort = parseFloat(sousTotal) + frais_port;
                                        document.getElementById('TotalPort').innerHTML = '<p><strong>Total avec frais de port:</strong> ' + TotalFraisPort + ' EUR </p>'
                                        var TVA = "<?php echo $TVA ?>";
                                        tvaPrix = (TotalFraisPort * TVA) / 100;
                                        var total = ((1 + TVA / 100) * TotalFraisPort).toFixed(2);
                                        document.getElementById('total').innerText = "TOTAL : " + total + " €";
                                        document.getElementById('TotalPort').style.display = "block";
                                        document.getElementById('fraisPort').style.display = "block";
                                    } else {
                                        var TVA = "<?php echo $TVA ?>";
                                        tvaPrix = (sousTotal * TVA) / 100;
                                        var total = ((1 + TVA / 100) * sousTotal).toFixed(2);
                                        document.getElementById('total').innerText = "TOTAL : " + total + " €";
                                        document.getElementById('TotalPort').style.display = "none";
                                        document.getElementById('fraisPort').style.display = "none";
                                    }
                                }


                             
                                document.getElementById('TotalHT').innerHTML = '<p id="TotalHT"><strong>Total HT:</strong> ' + sousTotal + ' </p>';


                                quantite = response.quantite;
                                nomProduit1 = response.nomProduit;
                                montantUnitaire = (response.nouveauSousTotal) / quantite;
                              
                                document.getElementById('quantiteProduits-' + nomProduit1).innerHTML = "<p id='quantiteProduits-" + nomProduit1 + "'><strong>Quantité:</strong> " + quantite + "</p>";
                                document.getElementById('prix-' + nomProduit1).innerHTML = "<p id='prix-" + nomProduit1 + "'><strong>Prix unitaire:</strong> " + montantUnitaire.toFixed(2) + "</p>";

                                configurerBoutonPayPal();



                            } else {

                            }
                        }
                    };

                    // Envoyer les données au serveur
                    var params = "nomProduit=" + encodeURIComponent(nomProduit) + "&nouvelleQuantite=" + encodeURIComponent(nouvelleQuantite) + "&prix=" + encodeURIComponent(prix);
                    xhr.send(params);
                }






                function configurerBoutonPayPal() {
                    let form = new FormData();
                    var formdata = new FormData();

                    var nom;
                    var prenom;

                    formdata.append("sousTotal", sousTotal);
                    formdata.append("fraisPort", frais_port);
                    formdata.append("tvaPrix", tvaPrix);
                    formdata.append('prenomLivraison', prenomLivraison);
                    formdata.append('nomLivraison', nomLivraison);


                    formdata.append('numLivraison', numRue);
                    formdata.append('rueLivraison', rue);


                    formdata.append('cdpLivraison', cdpLivraison);
                    formdata.append('villeLivraison', villeLivraison);
                    formdata.append('paysLivraison', paysLivraison);

                    form.append("prix", montantUnitaire.toFixed(2));
                    form.append("quantite", quantite);
                    form.append("nomProduit", nomProduit1);

                    console.log(montantUnitaire);
                    console.log(quantite);
                    console.log(nomProduit1);
                    var request = new XMLHttpRequest();
                    request.open('POST', 'controller/Paypal_order.php', true);
                    request.onreadystatechange = function() {
                        if (request.readyState === 4 && request.status === 200) {
                            var apiData = JSON.parse(request.responseText);

                            document.getElementById('paypal-button-container').innerHTML = ""


                            paypal.Buttons({
                                createOrder: function(data, actions) {
                                    return actions.order.create({
                                        purchase_units: apiData.purchase_units.map(unit => {
                                            return {
                                                amount: unit.amount,
                                                // Autres propriétés nécessaires à la construction de l'objet order
                                            };
                                        })
                                    });
                                },
                                onApprove: function(data, actions) {


                                    return actions.order.capture().then(function(details) {



                                       


                                        var nomCommande = [];
                                        var prixArray = [];
                                        var quantite = [];
                                        var dataToSend;

                                        fetch("Controller/get_cart_data.php", {
                                            header: 'Content-Type: application/json',
                                                method: 'POST',
                                                body: form
                                            }).then(response => response.json())
                                            .then(data => {
                                            

                                                var cartData = data.cartData;
                                                var quantitetest= parseInt(data.cartData.quantite);
                                                var prix = parseFloat(data.cartData.montantUnitaire);
                                                var nom= data.cartData.nomProduit;
                                                


                                              
                                                   
                                                    quantite.push(quantitetest);
                                                    prixArray.push(prix);
                                                    nomCommande.push(nom);
                                                    
                                           
                                                var xhr = new XMLHttpRequest();
                                                xhr.open('POST', 'Controller/ajout_commandes.php', true);
                                                xhr.setRequestHeader('Content-Type', 'application/json');

                                                dataToSend = {
                                                    nomCommande: nomCommande,
                                                    quantite: quantite,
                                                    prix: prixArray

                                                }
                                                
                                                xhr.send(JSON.stringify(dataToSend));
                                                
                                            
                                                


                                        var xhr2 = new XMLHttpRequest();
                                        xhr2.open('POST', 'Controller/update_quantity.php', true);
                                        xhr2.setRequestHeader('Content-Type', 'application/json');

                                        xhr2.onreadystatechange = function() {
                                            if (xhr2.readyState == 4 && xhr2.status == 200) {
                                               
                                            }
                                        };
                                        xhr2.send(JSON.stringify(dataToSend));
                                         prenom = '<?= $prenom ?>';
                                         nom = '<?= $nom ?>';


                                               

                                            })
                                            .catch(error => console.error('Error fetching cart data:', error));

                                           
                                        alert(prenom + ' ' + nom + ', votre transaction est effectuée. Vous allez recevoir une notification très bientôt lorsque nous validons votre paiement.');
                                    });
                                },

                                onCancel: function(data) {
                                    alert("Transaction annulée !");
                                }
                                // onApprove: function(data, actions) {
                                //     return actions.order.capture().then(function(details) {
                                //         // Insertion de la logique de confirmation ici
                                //     });
                                // }
                            }).render('#paypal-button-container');
                        }
                    };

                    request.send(formdata);
                }
            </script>



        </div>

        <?php
        $nomCommande = [];
        $prix = [];
        $quantite = [];
        $cart = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];


        foreach ($cart as $produit) {
            $nomProduit = isset($produit['nom']) ? $produit['nom'] : '';
            $quantiteProduit = isset($produit['quantite']) ? $produit['quantite'] : 0;
            $prixProduit = isset($produit['prix']) ? $produit['prix'] : 0;


            $nomCommande[] = $nomProduit;
            $quantite[] = $quantiteProduit;
            $prix[] = $prixProduit;
        }

        ?>


        <?php
        echo '<div class="recap">';








        for ($i = 0; $i < count($nomCommande); $i++) {


     

            echo "<div class='produit-recap'>";

            echo "<p id='prix-" . $nomCommande[$i] . "'><strong>Prix unitaire:</strong> " . $prix[$i] . " EUR</p>";
            echo "<p id='quantiteProduits-" . $nomCommande[$i] . "'><strong>Quantité:</strong> " . $quantite[$i] . "</p>";

            echo "</div>";
        }



        echo '<p id="TotalHT"><strong>Total HT:</strong> ' . $montantTotal . ' EUR </p>';
        $sansPort = $montantTotal;
        $sansPortArrondi = round($sansPort, 2);
        if ($pays === "FR") {
            if ($montantTotal < 50) {
                $montantTotal += $fraisPort;
            }
        } else {
            if ($montantTotal < 70) {
                $montantTotal += $fraisPort;
            }
        }
        $total = (($TVA) / 100) * $montantTotal;


        $totalTAxe = round($total, 2);
        // echo $montantTotal;

        $totalTTC = number_format((float)$montantTotal + $total, 2, '.',);


        echo '<p id="fraisPort"><strong>Frais de port:</strong> ' . $fraisPort . ' EUR </P>';
        echo '<p id="TotalPort"><strong>Total avec frais de port:</strong> ' . $montantTotal . ' EUR </p>';
        echo "<p><strong>TVA:</strong> " . $TVA . " %</p>";
        echo "<h2 id='total'>TOTAL : " . $totalTTC . " € </h2>";



        if ($montantTotal != 0) {



        ?>
            <div class="paiement">
                <div class="form-container-achat">
                    <form method='post'>
                        <div id="paypal-button-container"></div>

                        <script src="https://www.paypal.com/sdk/js?client-id=AaOvluVx3_tbxX782Q3zyGBSmCPfnaEdHVcbwDqOXu_dgFCtxQmMGtdy-jDzY8JWPmpGL5bZm-ovGAyn&currency=EUR"></script>
                        <?php


                        $handling = 0;
                        $insurance = 0;
                        $shipping_discount = 0;
                        $discount = 0;
                        if ($sansPort < 50) {
                            $shipping = $fraisPort;
                        } else {
                            $shipping = 0;
                        }


                        $totalAmount = $sansPort + $totalTAxe + $shipping + $handling + $insurance - $shipping_discount - $discount;

                        $order = [

                            'purchase_units' => [
                                [

                                    'amount' => [
                                        'value' =>  number_format($totalAmount, 2, '.', ''),
                                        'currency_code' => 'EUR',
                                        'breakdown' => [
                                            'item_total' => [
                                                'currency_code' => "EUR",
                                                'value' => $sansPortArrondi
                                            ],
                                            'tax_total' => [
                                                'currency_code' => 'EUR',
                                                'value' => $totalTAxe
                                            ],
                                            'shipping' => [
                                                'currency_code' => 'EUR',
                                                'value' => $shipping,
                                            ],
                                            'handling' => [
                                                'currency_code' => 'EUR',
                                                'value' => 0,
                                            ],
                                            'insurance' => [
                                                'currency_code' => 'EUR',
                                                'value' => 0,
                                            ],
                                            'shipping_discount' => [
                                                'currency_code' => 'EUR',
                                                'value' => 0,
                                            ],
                                            'discount' => [
                                                'currency_code' => 'EUR',
                                                'value' => 0,
                                            ],


                                        ],

                                    ],
                                    'shipping' => [
                                        'name' => [
                                            'full_name' => isset($prenom) && isset($nom) ? "{$prenom} {$nom}" : "Nom par défaut",
                                        ],
                                        'address' => [
                                            'address_line_1' => isset($numeroRue) && isset($rue) ? "{$numeroRue} {$rue}" : "Adresse par défaut",
                                            'admin_area_2' => isset($ville) ? $ville : "Ville par défaut",
                                            'postal_code' => isset($codePostal) ? $codePostal : "Code postal par défaut",
                                            'country_code' => isset($pays) ? $pays : "Pays par défaut",
                                        ],
                                    ],

                                ],
                            ],
                            'payer' => [
                                'name' => [
                                    'given_name' => isset($prenom) ? $prenom : "Prénom par défaut",
                                    'surname' => isset($nom) ? $nom : "Nom par défaut",
                                ],
                                'email_address' => isset($email) ? $email : "Email par défaut",
                            ],
                        ];

                        $totalItemAmount = 0;
                        if (isset($nomCommande)) {
                            for ($i = 0; $i < count($nomCommande); $i++) {
                                $item_name = $nomCommande[$i];
                                $item_prix = $prix[$i];
                                $item_qte = $quantite[$i];
                               



                                $item = [

                                    'name' => $item_name,
                                    'unit_amount' => [
                                        'value' => $item_prix,
                                        'currency_code' => 'EUR'
                                    ],
                                    'quantity' => $item_qte
                                ];

                                // Utilisez [] pour ajouter un élément à la liste d'articles
                                // $order['purchase_units'][0]['items'][] = $item;
                            }
                        }
                        // $order['purchase_units'][0]['amount']['breakdown']['item_total']['value'] = number_format($totalItemAmount, 2, '.', '');

                        // Convertissez le tableau en JSON à la fin
                        $order = json_encode($order);


                        ?>
                        <script>
                            paypal.Buttons({
                                createOrder: function(data, actions) {
                                    return actions.order.create(<?= $order ?>);

                                },

                                // JavaScript (Front-end)
                                onApprove: function(data, actions) {


                                    return actions.order.capture().then(function(details) {



                                      


                                        var nomCommande = [];
                                        var prix = [];
                                        var quantite = [];

                                        <?php
                                        // PHP (Back-end)
                                        $cart = $_SESSION['panier'];
                                        foreach ($cart as $produit) {

                                            $nomCommande = isset($produit['nom']) ? $produit['nom'] : '';
                                            $quantite = isset($produit['quantite']) ? $produit['quantite'] : 0;
                                            $prix = isset($produit['prix']) ? $produit['prix'] : 0;
                                            $total = $quantite * $prix;


                                            echo "nomCommande.push('" . $nomCommande . "');\n";
                                            echo "quantite.push(" . $quantite . ");\n";
                                            echo "prix.push(" . $prix . ");\n";
                                        }


                                        ?>

                                        // Maintenant, vous pouvez envoyer ces données au serveur via une requête AJAX
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'Controller/ajout_commandes.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/json');

                                        var dataToSend = {
                                            nomCommande: nomCommande,
                                            quantite: quantite,
                                            prix: prix

                                        }
                                        xhr.send(JSON.stringify(dataToSend));

                                        var xhr2 = new XMLHttpRequest();
                                        xhr2.open('POST', 'Controller/update_quantity.php', true);
                                        xhr2.setRequestHeader('Content-Type', 'application/json');

                                        xhr2.onreadystatechange = function() {
                                            if (xhr2.readyState == 4 && xhr2.status == 200) {
                                              
                                            }
                                        };
                                        xhr2.send(JSON.stringify(dataToSend));
                                        var prenom = '<?= $prenom ?>';
                                        var nom = '<?= $nom ?>';

                                        alert(prenom + ' ' + nom + ', votre transaction est effectuée. Vous allez recevoir une notification très bientôt lorsque nous validons votre paiement.');
                                    });
                                },

                                onCancel: function(data) {
                                    alert("Transaction annulée !");
                                }
                            }).render('#paypal-button-container');
                        </script>




                    </form>
                </div>
            </div>


        <?php
        }
        echo "</div>";

        ?>


    </div>

    <?php include_once 'template/footer.html' ?>