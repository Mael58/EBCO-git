<?php include 'template/header.php';
ob_start();
include 'modele/ProduitsBDD.php';
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



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loginForm = document.getElementById("LoginForm");
            const regForm = document.getElementById("RegForm");
            const formAdresse = document.getElementById("formAdresse");
            const steps = document.querySelectorAll('.cart-item');


            function handleLogin() {

                formAdresse.style.display = "flex";
                loginForm.style.display = "none";
                regForm.style.display = "none";

                updateCompletedSteps(3);
            }

            // function handleAddAdresse() {

            //     formAdresse.style.display = "none";
            //     paiement.style.display = "flex";
            //     updateCompletedSteps(4);
            // }

            // Attach click event to the login button
            const loginButton = loginForm.querySelector('.btn');
            loginButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting
                handleLogin();
            });

            // const btnAdresse = document.getElementById('btnAdresse');
            // btnAdresse.addEventListener('click', function(event) {
            //     event.preventDefault(); // Prevent the form from submitting
            //     handleAddAdresse();
            // });





            function updateCompletedSteps(stepNumber) {
                steps.forEach(step => {
                    const currentStep = parseInt(step.getAttribute('data-step'));
                    step.classList.toggle('completed', currentStep <= stepNumber);
                });
            }
        });
    </script>






    <div class="co" id="LoginForm">
        <div class="contain">
            <h3>Connexion</h3>
            <form class="connexion" id="connexion" method="post">
                <input type="text" name="username2" placeholder="Saisir votre nom d'utilisateur">
                <input type="password" name="password2" placeholder="Saisir votre mot de passe">
                <!-- <div class="remember">
                        <input type="checkbox" class="check" name="remember" value="1">Se souvenir de moi
                    </div> -->
                <button type="submit" class="btn">Se connecter</button>
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



    if (isset($_POST['username2']) && isset($_POST['password2'])) {
        $username2 = $_POST['username2'];
        $password2 = $_POST['password2'];
        $bdd = new ProduitsBDD;
        $bdd->connexion($username2, $password2);
    }





    ?>



    <div class="container-achat" id="formAdresse">
        <h2 id="show">Adresse de livraison</h2>
        <div class="col-2-achat">
            <div class="form-container-achat">
                <form method='POST'>
                    <legend>Merci d'inscrire vos informations de livraison</legend>
                    <section class="section-nom">
                        <h2>1.Nom complet</h2>
                        <div class="div-nom">
                            <label for="prenom">Prénom*</label>
                            <input type="text" name="prenom" placeholder="Prénom">

                            <label for="nom">nom*</label>
                            <input type="text" name="nom" placeholder="Nom">
                        </div>

                    </section>
                    <section class="info">
                        <h2>2.Informations personnelles</h2>

                        <label for="mail">E-mail*</label>
                        <input type="email" name="email" placeholder="Email">

                        <label for="societe">Société</label>
                        <input type="text" name="societe" placeholder="Votre société pour qui vous achetez">

                        <label for="tel">Numéro de téléphone</label>
                        <input type="tel" name="tel" placeholder="Numéro de téléphone">

                    </section>

                    <section class="adresse">
                        <h2>3.Adresse</h2>


                        <label for="numRue">Numéro de rue*</label>
                        <input type="text" name="numRue" placeholder="Numéro de la rue">

                        <label for="rue">Rue*</label>
                        <input type="text" name="rue" placeholder="Nom de la rue">

                        <label for="cdp">Code postal*</label>
                        <input type="number" name="cdp" placeholder="Code postal">

                        <label for="ville">Ville*</label>
                        <input type="text" name="ville" placeholder="Ville">

                        <label for="pays">Pays</label>
                        <select name="pays">
                            <option value="FR" selected>France</option>
                            <option value="BE">Belgique</option>
                            <option value="CH">Suisse</option>
                            <option value="IT">Italie</option>
                            <option value="ES">Espagne</option>
                            <option value="">Autre</option>

                    </section>
                    <input type="submit" id="btnAdresse" class="btn" value="Ajouter votre adresse">
                </form>
            </div>
        </div>
    </div>










    <div class="titreVerif">


        <?php
        echo "<div class='info-item'><strong>Prénom:</strong> " . $_POST["prenom"] . "</div>";
        echo "<div class='info-item'><strong>Nom:</strong> " . $_POST["nom"] . "</div>";

        // echo "<div class='info-item'><strong>E-mail:</strong> " . $_POST["email"] . "</div>";
        // echo "<div class='info-item'><strong>Société:</strong> " . $_POST["societe"] . "</div>";
        // echo "<div class='info-item'><strong>Numéro de téléphone:</strong> " . $_POST["tel"] . "</div>";
        echo "<div class='info-item'><strong>Adresse:</strong> " . $_POST["numRue"] . " " . $_POST["rue"] . "</div>";
        echo "<div class='info-item'><strong>Code postal, Ville, Pays:</strong> " . $_POST["cdp"] . ", " . $_POST["ville"] . ", " . $_POST["pays"] . "</div>";
        ?>
    </div>

    <div class="verif">

        <div class="recapAdresse">


        </div>

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
                            echo '<td><input type="number" value="' . $produit['quantite'] . '"></td>';
                            echo '<td>' . $sousTotal . ' €</td>';
                            echo '</tr>';
                        }
                        // Vérifiez si le total est inférieur à 50 euros
                        // if ($total < 50) {
                        //     $total += $fraisPort;
                        // } else {
                        //     $fraisPort = 0;
                        // }
                    }
                }


                ?>

            </table>



        </div>
        <?php
        if (isset($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $produit) {
                if (isset($produit['nom']) && isset($produit['prix']) && isset($produit['quantite'])) {
                    $nomCommande[] = $produit['nom'];
                    $prix[] = $produit['prix'];
                    $quantite[] = $produit['quantite'];
                }
            }
            echo '<div class="recap">';


            for ($i = 0; $i < count($nomCommande); $i++) {
                $totalProduit = $prix[$i] * $quantite[$i];

                echo "<div class='produit-recap'>";
                echo "<p><strong>Produit:</strong> " . $nomCommande[$i] . "</p>";
                echo "<p><strong>Prix unitaire:</strong> " . $prix[$i] . " EUR</p>";
                echo "<p><strong>Quantité:</strong> " . $quantite[$i] . "</p>";
                echo "<p><strong>Total:</strong> " . $totalProduit . " EUR</p>";
                echo "</div>";
            }


            $montantTotal = array_sum(array_map(function ($p, $q) {
                return $p * $q;
            }, $prix, $quantite));

            echo "<p><strong>Montant total de la commande:</strong> " . $montantTotal . " EUR</p>"; ?>
            <div class="paiement">
                <div class="form-container-achat">
                    <form method='post'>
                        <div id="paypal-button-container"></div>

                        <script src="https://www.paypal.com/sdk/js?client-id=AVF-Rm38cZLM-9p7H_m-RR3cDm0xeo5_xBhDcLLvD58iWh63mZ8zMNVJ1rT63CTPNMDMzo2-0yELB_nC&currency=EUR"></script>

                        <script>
                            paypal.Buttons().render('#paypal-button-container');
                        </script>




                    </form>
                </div>
            </div><?php

                    echo "</div>";
                }
                    ?>




    </div>








    <?php include 'template/footer.html' ?>