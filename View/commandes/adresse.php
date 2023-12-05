<?php include_once 'template/header.php';
ob_start();
include_once 'Model/ProduitsBDD.php';



if (isset($_SESSION['adresseFacturation'])) {
    $prenom = $_SESSION['adresseFacturation']['prenom'];
    $nom = $_SESSION['adresseFacturation']['nom'];
    $email = $_SESSION['adresseFacturation']['email'];

    $telephone = $_SESSION['adresseFacturation']['tel'];
    $codePostal = $_SESSION['adresseFacturation']['cdp'];
    $ville = $_SESSION['adresseFacturation']['ville'];
    $pays = $_SESSION['adresseFacturation']['pays'];
    $rue = $_SESSION['adresseFacturation']['rue'];
    $numeroRue = $_SESSION['adresseFacturation']['numRue'];
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
            if(isset($_SESSION['adresse'])){
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


                function AjaxRequest(url) {
                    return fetch(url, {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Vous pouvez accéder aux données encodées en JSON ici
                            // Traitez les données comme nécessaire
                          
                        })
                        .catch(error => {
                            console.error('Erreur lors de l\'envoi de la requête AJAX:', error);
                        });
                }

                Promise.all([
                        AjaxRequest('Controller/formAdresse.php'),
                        AjaxRequest('Controller/ajout_client.php'),
                    ]).then(results => {
                        // results est un tableau contenant les résultats des deux requêtes
                        const result1 = results[0];
                        const result2 = results[1];

                    })
                    .catch(error => {
                        console.error('Erreur lors de l\'exécution simultanée des requêtes:', error);
                    });


                formAdresse.style.display = "none";
                facturation.style.display = "none";
                // adresse.style.display = "flex";
                verif.style.display = "flex";
                recap.style.display = "block";
                updateCompletedSteps(4);




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

        <p><strong>Prénom:</strong> <?php echo $prenom; ?></p>
        <p><strong>Nom:</strong> <?php echo $nom; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Téléphone:</strong> <?php echo $telephone; ?></p>
        <p><strong>Code Postal:</strong> <?php echo $codePostal; ?></p>
        <p><strong>Adresse:</strong> <?php echo "$numeroRue $rue, $ville"; ?></p>
        <p id="modifier">Modifier</p>
    </div>




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

                            $total += $sousTotal; // Ajoutez le sous-total au total
                            echo '<td>' . $produit['prix'] . ' €</td>';
                            echo '<td><input type="number" min="1" value="' . $produit['quantite'] . '" id="quantite-' . $produit['nom'] . '" data-prix="' . $produit['prix'] . '" onchange="updateQuantitePrix(this, \'' . $produit['nom'] . '\',\'' . $produit['prix'] . '\')"></td>';
                            echo '<td>' . $sousTotal . ' €</td>';
                            echo '</tr>';
                        }
                    }
                }


                ?>

            </table>


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
             
                
                location.reload();
            } else {
              
            }
        }
    };

    // Envoyer les données au serveur
    var params = "nomProduit=" + encodeURIComponent(nomProduit) + "&nouvelleQuantite=" + encodeURIComponent(nouvelleQuantite) + "&prix=" + encodeURIComponent(prix);
    xhr.send(params);
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

            // Ajoutez ces valeurs aux tableaux
            $nomCommande[] = $nomProduit;
            $quantite[] = $quantiteProduit;
            $prix[] = $prixProduit;

            // ... Autres opérations de base de données
        }
        echo '<div class="recap">';







        for ($i = 0; $i < count($nomCommande); $i++) {

            $montantTotal = array_sum(array_map(function ($p, $q) {
                return $p * $q;
            }, $prix, $quantite));


            echo "<div class='produit-recap'>";
            // echo "<p><strong>Produit:</strong> " . $nomCommande[$i] . "</p>";
            echo "<p><strong>Prix unitaire:</strong> " . $prix[$i] . " EUR</p>";
            echo "<p><strong>Quantité:</strong> " . $quantite[$i] . "</p>";
            // echo "<p><strong>Total:</strong> " . $totalProduit . " EUR</p>";

            echo "</div>";
        }
        $total = (($TVA) / 100) * $montantTotal;

        $totalTAxe = round($total, 2);


        echo '<p><strong>Total HT:</strong> ' . $montantTotal . ' EUR </p>';

        echo "<p><strong>TVA:</strong> " . $total . " EUR</p>";
        echo "<h2>TOTAL : " . number_format((float)$montantTotal + $total, 2, '.',);



        ?>

        <div class="paiement">
            <div class="form-container-achat">
                <form method='post'>
                    <div id="paypal-button-container"></div>

                    <script src="https://www.paypal.com/sdk/js?client-id=AaOvluVx3_tbxX782Q3zyGBSmCPfnaEdHVcbwDqOXu_dgFCtxQmMGtdy-jDzY8JWPmpGL5bZm-ovGAyn&currency=EUR"></script>
                    <?php
                    $tax_total = 0;
                    $shipping = 0;
                    $handling = 0;
                    $insurance = 0;
                    $shipping_discount = 0;
                    $discount = 0;
                    $totalAmount = $montantTotal + $totalTAxe + $shipping + $handling + $insurance - $shipping_discount - $discount;

                    $order = [

                        'purchase_units' => [
                            [

                                'amount' => [
                                    'value' =>  number_format($totalAmount, 2, '.', ''), // Montant en euros
                                    'currency_code' => 'EUR',
                                    'breakdown' => [
                                        'item_total' => [
                                            'currency_code' => "EUR",
                                            'value' => $montantTotal
                                        ],
                                        'tax_total' => [
                                            'currency_code' => 'EUR',
                                            'value' => $totalTAxe
                                        ],
                                        'shipping' => [
                                            'currency_code' => 'EUR',
                                            'value' => 0,
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
                                    'name' => [  // Ajoutez cette partie pour spécifier le nom du destinataire
                                        'full_name' => "{$prenom} {$nom}"
                                    ],
                                    'address' => [
                                        'address_line_1' => "{$numeroRue} {$rue}",
                                        'admin_area_2' => $ville,
                                        'postal_code' => $codePostal,
                                        'country_code' => $pays,
                                    ],
                                ],
                                'items' => [],
                            ],

                        ],

                        "payer" => [
                            "name" => [
                                "given_name" => $prenom,
                                "surname" => $nom
                            ],
                            "email_address" => $email,

                        ]

                    ];
                    if (isset($nomCommande)) {
                        for ($i = 0; $i < count($nomCommande); $i++) {
                            $item_name = $nomCommande[$i];
                            $item_prix = $prix[$i];
                            $item_qte = $quantite[$i];
                            //echo $item_name;
                            $item = [

                                'name' => $item_name,
                                'unit_amount' => [
                                    'value' => $item_prix,
                                    'currency_code' => 'EUR'
                                ],
                                'quantity' => $item_qte
                            ];

                            // Utilisez [] pour ajouter un élément à la liste d'articles
                            $order['purchase_units'][0]['items'][] = $item;
                        }
                    }

                    // Convertissez le tableau en JSON à la fin
                    $order = json_encode($order);


                    ?>
                    <script>
                        console.log(<?= $order ?>);
                        paypal.Buttons({
                            createOrder: function(data, actions) {
                                return actions.order.create(<?= $order ?>);

                            },

                            // JavaScript (Front-end)
                            onApprove: function(data, actions) {


                                return actions.order.capture().then(function(details) {



                                    console.log(details);


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

                                        // Ici, vous pouvez stocker ces valeurs dans des tableaux JavaScript
                                        echo "nomCommande.push('" . $nomCommande . "');\n";
                                        echo "quantite.push(" . $quantite . ");\n";
                                        echo "prix.push(" . $prix . ");\n";

                                        // ... Autres opérations de base de données
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
                                            // Mettez à jour l'interface utilisateur ou effectuez d'autres actions si nécessaire
                                            console.log(xhr2.responseText);
                                            // Vous pouvez également mettre à jour le panierCounter ici
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

        echo "</div>";

        ?>


    </div>

    <?php include_once 'template/footer.html' ?>