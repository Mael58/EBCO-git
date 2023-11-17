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
            const modifier = document.getElementById('modifier');
            const verif = document.getElementById('verif');
            //const adresse = document.getElementById('adresseCommande');




            const loginButton = document.getElementById('bouton');
            loginButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting

                makeAjaxRequest();

            });


            function makeAjaxRequest() {
                var username = document.getElementById('username2').value;
                var password = document.getElementById('password2').value;
                var url = 'traitement.php?username2=' + encodeURIComponent(username) + '&password2=' + encodeURIComponent(password);


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
                    })


            }







            modifier.addEventListener("click", function() {
                handleLogin();
            });



            function handleLogin() {

                formAdresse.style.display = "flex";
                loginForm.style.display = "none";
                regForm.style.display = "none";
                verif.style.display = "none";
                adresse.style.display = "none";


                updateCompletedSteps(3);


            }













            const btnAdresse = document.getElementById('btnAdresse');
            btnAdresse.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting
                handleAddAdresse();
            });





            function handleAddAdresse() {

                formAdresse.style.display = "none";
                adresse.style.display = "flex";
                verif.style.display = "flex";
                updateCompletedSteps(4);
            }

            function updateCompletedSteps(stepNumber) {
                steps.forEach(step => {
                    const currentStep = parseInt(step.getAttribute('data-step'));
                    step.classList.toggle('completed', currentStep <= stepNumber);
                });
            }
        });
    </script>

    <?php
    if (isset($_SESSION['username'])) {
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '    const loginForm = document.getElementById("LoginForm");';
        echo '    const regForm = document.getElementById("RegForm");';
        echo '    const formAdresse = document.getElementById("formAdresse");';
        echo '    const steps = document.querySelectorAll(".cart-item");';
        echo '    const modifier = document.getElementById("modifier");';
        echo '    const verif = document.getElementById("verif");';
        echo '    const adresse = document.getElementById("adresseCommande");';
        echo '';
        echo '    function updateCompletedSteps(stepNumber) {';
        echo '        steps.forEach(step => {';
        echo '            const currentStep = parseInt(step.getAttribute("data-step"));';
        echo '            step.classList.toggle("completed", currentStep <= stepNumber);';
        echo '        });';
        echo '    }';
        echo '';
        echo '    function handleLogin() {';
        echo '        formAdresse.style.display = "flex";';
        echo '        loginForm.style.display = "none";';
        echo '        regForm.style.display = "none";';
        echo '        verif.style.display = "none";';
        echo '         adresse.style.display = "none";';
        echo '        updateCompletedSteps(4);';
        echo '    }';
        echo '';
        echo '    handleLogin();';

        echo '});';
        echo '</script>';
    }
    ?>






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



    // if (isset($_POST['username2']) && isset($_POST['password2'])) {
    //     $username2 = $_POST['username2'];
    //     $password2 = $_POST['password2'];
    //     $bdd = new ProduitsBDD;
    //     $bdd->connexion($username2, $password2);
    // }


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
                    <input type="submit" class="btn" id="btnAdresse" value="Ajouter votre adresse">
                </form>
            </div>
        </div>
    </div>

    <?php
    echo var_dump($_SESSION['adresse']);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les valeurs des champs du formulaire
        $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
        $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $societe = isset($_POST["societe"]) ? $_POST["societe"] : "";
        $tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
        $numRue = isset($_POST["numRue"]) ? $_POST["numRue"] : "";
        $rue = isset($_POST["rue"]) ? $_POST["rue"] : "";
        $cdp = isset($_POST["cdp"]) ? $_POST["cdp"] : "";
        $ville = isset($_POST["ville"]) ? $_POST["ville"] : "";
        $pays = isset($_POST["pays"]) ? $_POST["pays"] : "";
        if (isset($_SESSION['adresse'])) {
            // Mettre à jour uniquement les champs non vides
            $_SESSION['adresse']['prenom'] = !empty($prenom) ? $prenom : $_SESSION['adresse']['prenom'];
            $_SESSION['adresse']['nom'] = !empty($nom) ? $nom : $_SESSION['adresse']['nom'];
            $_SESSION['adresse']['email'] = !empty($email) ? $email : $_SESSION['adresse']['email'];
            $_SESSION['adresse']['societe'] = !empty($societe) ? $societe : $_SESSION['adresse']['societe'];
            $_SESSION['adresse']['tel'] = !empty($tel) ? $tel : $_SESSION['adresse']['tel'];
            $_SESSION['adresse']['numRue'] = !empty($numRue) ? $numRue : $_SESSION['adresse']['numRue'];
            $_SESSION['adresse']['rue'] = !empty($rue) ? $rue : $_SESSION['adresse']['rue'];
            $_SESSION['adresse']['cdp'] = !empty($cdp) ? $cdp : $_SESSION['adresse']['cdp'];
            $_SESSION['adresse']['ville'] = !empty($ville) ? $ville : $_SESSION['adresse']['ville'];
            $_SESSION['adresse']['pays'] = !empty($pays) ? $pays : $_SESSION['adresse']['pays'];
        } else {
            // Si $_SESSION['adresse'] n'existe pas, la créer
            $_SESSION['adresse'] = [
                'prenom' => $prenom,
                'nom' => $nom,
                'email' => $email,
                'societe' => $societe,
                'tel' => $tel,
                'numRue' => $numRue,
                'rue' => $rue,
                'cdp' => $cdp,
                'ville' => $ville,
                'pays' => $pays
            ];
        }
    }

    if (isset($_SESSION['adresse'])) {

        echo '<div id="adresseCommande" class="info-commande">';
        echo "Prénom: " . $_SESSION['adresse']['prenom'] . "<br>";
        echo "Nom: " . $_SESSION['adresse']['nom'] . "<br>";
        echo "Email: " . $_SESSION['adresse']['email'] . "<br>";
        echo "Société: " . $_SESSION['adresse']['societe'] . "<br>";
        echo "Téléphone: " . $_SESSION['adresse']['tel'] . "<br>";
        echo "Numéro de rue: " . $_SESSION['adresse']['numRue'] . " " . $_SESSION['adresse']['rue'] . "<br>";

        echo "Code postal: " . $_SESSION['adresse']['cdp'] . "<br>";
        echo "Ville: " . $_SESSION['adresse']['ville'] . "<br>";
        echo "Pays: " . $_SESSION['adresse']['pays'] . "<br>";
        echo  '<p id="modifier" class="modifier">modifier</p>';
        echo '</div>';
    }



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