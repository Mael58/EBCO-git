<?php include 'template/header.php';
include 'modele/ProduitsBDD.php';
?>

<body>


    <div class="cont">
        <div class="paiement">

            <h2>Compte</h2>
            <a href="#" id="showLoginForm">
                <p>Cliquez ici, pour vous connecter </p>
            </a>
            <div class="co" id="LoginForm">
                <h3>Connexion</h3>
                <form class="connexion" method="post">
                    <input type="text" name="username2" placeholder="Saisir votre nom d'utilisateur">
                    <input type="password" name="password2" placeholder="Saisir votre mot de passe">
                    <!-- <div class="remember">
                        <input type="checkbox" class="check" name="remember" value="1">Se souvenir de moi
                    </div> -->
                    <button type="submit" class="btn">Connexion</button>
                    <a href="error.php">Mot de passe oublié</a>
                </form>
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

            <div class="separator"></div>

            <script>
                document.getElementById('showLoginForm').addEventListener('click', function() {
                    var login = document.getElementById('LoginForm');

                    // Check the current display state
                    if (login.style.display === 'none' || login.style.display === '') {
                        login.style.display = 'block'; // Display the form
                    } else {
                        login.style.display = 'none'; // Hide the form
                    }
                });
            </script>



            <h3>Inscription</h3>
            <form id="RegForm" class="reg" method="post">
                <input type="text" name="username" placeholder="Saisir votre nom d'utilisateur">
                <!-- <input type="email" placeholder="E-mail"> -->
                <input type="password" name="password" placeholder="Saisir votre mot de passe">
                <button type="submit" class="btn">Enregistrer</button>
            </form>
            <div class="separator"></div>

            <h2 id="show">Adresse de livraison</h2>
            <div class="container-achat" id="formAdresse">
                <div class="col-2-achat">
                    <div class="form-container-achat">
                        <form method='post'>
                            <legend>Merci d'inscrire vos informations de livraison</legend>
                            <div class="section-1">
                                <label for="prenom">Prénom*</label>
                                <input type="text" name="prenom" placeholder="Votre prénom">

                                <label for="nom">nom*</label>
                                <input type="text" name="nom" placeholder="Votre nom">

                                <label for="mail">E-mail*</label>
                                <input type="email" name="email" placeholder="Votre email">

                                <label for="societe">Société</label>
                                <input type="text" name="societe" placeholder="Votre société pour qui vous achetez">

                                <label for="tel">Numéro de téléphone</label>
                                <input type="tel" name="tel" placeholder="Votre numéro de téléphone">
                            </div>


                            <div class="section-2">
                                <label for="rue">Rue*</label>
                                <input type="text" name="rue" placeholder="Nom de la rue">

                                <label for="numRue">Numéro de rue*</label>
                                <input type="text" name="numRue" placeholder="Numéro de la rue">

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
                                </select>
                            </div>

                            <input type="submit" class="btn" value="Ajouter votre adresse">
                        </form>
                    </div>
                </div>
            </div>

            <?php
            $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
            $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
            $tel = isset($_POST['tel']) ? $_POST['tel'] : "";
            $email = isset($_POST['email']) ? $_POST['email'] : "";
            $cdp = isset($_POST['cdp']) ? $_POST['cdp'] : "";
            $ville = isset($_POST['ville']) ? $_POST['ville'] : "";
            $pays = isset($_POST['pays']) ? $_POST['pays'] : "";
            $numRue = isset($_POST['numRue']) ? $_POST['numRue'] : "";
            $rue = isset($_POST['rue']) ? $_POST['rue'] : "";
            $societe = isset($_POST['societe']) ? $_POST['societe'] : "";



            ?>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Récupérer les références aux éléments de formulaire
                    var formAdresse = document.getElementById("formAdresse");
                    var formCommande = document.getElementById("commande");

                    // Ajouter un gestionnaire d'événements pour le formulaire d'adresse
                    formAdresse.addEventListener("submit", function(event) {
                        event.preventDefault();

                        var formData = new FormData(event.target);
                        var prenom = formData.get("prenom");
                        var nom = formData.get("nom");
                        var tel = formData.get("tel");
                        var email = formData.get("email");
                        var cdp = formData.get("cdp");
                        var ville = formData.get("ville");
                        var pays = formData.get("pays");
                        var numRue = formData.get("numRue");
                        var rue = formData.get("rue");
                        var societe = formData.get("societe");

                        // Ajouter les données à la liste des adresses dans le formulaire de commande
                        var adresseHtml = "<input type='radio' name='adresse' checked>" +
                            "<label>" +
                            "<p>" + prenom + " " + nom + ", " + numRue + " " + rue + ", " + ville + ", " + cdp + ", " + pays + "</p>" +
                            "</label>" +
                            "<p class='lien-adresse'><a href='#' id='modifierAdresse'>Modifier une adresse</a></p>";

                        document.getElementById("commande").innerHTML = "<h2>Vos adresses</h2><div class='commande'>" + adresseHtml + "</div><p><a href='#'>Ajouter une nouvelle adresse</a></p>";

                        // Cacher le formulaire d'adresse
                        formAdresse.style.display = "none";

                        // Afficher le formulaire de commande
                        formCommande.style.display = "block";

                        // Ajouter un gestionnaire d'événements pour le lien "Modifier une adresse"
                        document.getElementById("modifierAdresse").addEventListener("click", function(event) {
                            event.preventDefault();

                            // Remplir le formulaire d'adresse avec les données actuelles
                            document.querySelector("#formAdresse [name=prenom]").value = prenom;
                            document.querySelector("#formAdresse [name=nom]").value = nom;
                            document.querySelector("#formAdresse [name=tel]").value = tel;
                            document.querySelector("#formAdresse [name=email]").value = email;
                            document.querySelector("#formAdresse [name=cdp]").value = cdp;
                            document.querySelector("#formAdresse [name=ville]").value = ville;
                            document.querySelector("#formAdresse [name=pays]").value = pays;
                            document.querySelector("#formAdresse [name=numRue]").value = numRue;
                            document.querySelector("#formAdresse [name=rue]").value = rue;
                            document.querySelector("#formAdresse [name=societe]").value = societe;

                            // Afficher le formulaire d'adresse
                            formAdresse.style.display = "block";

                            // Cacher la div de commande
                            formCommande.style.display = "none";
                        });
                    });
                });
            </script>


            <div class="form-Commande" id="commande">
                <h2>Vos adresses</h2>
                <!-- <div class="commande">
            <input type="radio" checked>
            <label for="adresse1">
                <p><?= "$prenom $nom, $numRue $rue, $ville, $cdp, $pays" ?></p>
            </label>
            <p class="lien-adresse"><a href="#">Modifier une adresse</a></p>
        </div> -->
                <!-- 
        <p><a href="#">Ajouter une nouvelle adresse</a></p> -->

            </div>

            <div class="separator"></div>
            <h2 id="showPaiement">Mode de paiement</h2>

        </div>
        <?php
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $produit) {
                $nomCommande[] = $produit['nom'];
                $prix[] = $produit['prix'];
                $quantite[] = $produit['quantite'];
            }
            echo '<div class="recap">';
            echo "<h2>Récapitulatif de commande</h2>";

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

            echo "<p><strong>Montant total de la commande:</strong> " . $montantTotal . " EUR</p>";

            echo "</div>";
        }
        ?>

        <script>
            document.getElementById('show').addEventListener('click', function() {
                var formAdresse = document.getElementById('formAdresse').style.display = 'block';
            })
            document.getElementById('showPaiement').addEventListener('click', function() {
                document.getElementById('formAdresse').style.display = 'block';
            })
        </script>

    </div>

    <div class="container-achat">
        <div class="col-2-achat">
            <div class="form-container-achat">
                <form method='post'>
                    <div id="paypal-button-container"></div>
                    <?php
                    $order = [
                        'purchase_units' => [
                            [
                                'amount' => [
                                    'value' => "0.1", // Montant en euros
                                    'currency_code' => 'EUR'
                                ],
                                'shipping' => [
                                    'address' => [
                                        'address_line_1' => "{$numRue} {$rue}",
                                        'admin_area_2' => $ville,
                                        'postal_code' => $cdp,
                                        'country_code' => $pays,
                                        'given_name' => $prenom,
                                        'surname' => $nom
                                    ]
                                ],
                                'item_list' => [
                                    'items' => []
                                ]
                            ]
                        ]
                    ];

                    for ($i = 0; $i < count($nomCommande); $i++) {
                        $item_name = $nomCommande[$i];
                        $item_prix = $prix[$i];
                        $item_qte = $quantite[$i];

                        $item = [
                            'name' => $item_name,
                            'unit_amount' => [
                                'price' => $item_prix,
                                'currency_code' => 'EUR'
                            ],
                            'quantity' => $item_qte
                        ];

                        // Utilisez [] pour ajouter un élément à la liste d'articles
                        $order['purchase_units'][0]['item_list']['items'][] = $item;
                    }

                    // Convertissez le tableau en JSON à la fin
                    $order = json_encode($order);


                    ?>
                    <script src="https://www.paypal.com/sdk/js?client-id=AVb3qzYweFsCxGFdimPz957tf1ZdRwteKvaplwAqGdQUP_DsFPUC9TfR7i9SwkCv1-R79UWA_C0ThDi4&currency=EUR"></script>

                    <script>
                        paypal.Buttons({
                            createOrder: function(data, actions) {
                                return actions.order.create(<?= $order ?>);
                            },

                            // JavaScript (Front-end)
                            onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                    // Afficher les détails de la transaction dans la console
                                    console.log(details);

                                    // Récupérer les détails de la commande
                                    var nomCommande = [];
                                    var prix = [];
                                    var quantite = [];

                                    <?php
                                    // PHP (Back-end)
                                    $cart = $_SESSION['cart'];
                                    foreach ($cart as $produit) {
                                        $nomCommande = $produit['nom'];
                                        $quantite = $produit['quantite'];
                                        $prix = $produit['prix'];
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
                                    xhr.open('POST', '../controller/ajout_commandes.php', true);
                                    xhr.setRequestHeader('Content-Type', 'application/json');

                                    var dataToSend = {
                                        nomCommande: nomCommande,
                                        quantite: quantite,
                                        prix: prix

                                    };


                                    xhr.send(JSON.stringify(dataToSend));


                                    alert(details.payer.name.given_name + ' ' + details.payer.name.surname + ', votre transaction est effectuée. Vous allez recevoir une notification très bientôt lorsque nous validons votre paiement.');
                                });
                            },

                            onCancel: function(data) {
                                alert("Transaction annulée !");
                            }




                        }).render('#paypal-button-container');
                    </script>



                    <button class='pay'><a href="../cart.php">Non, revenir au panier</a></button>
                </form>
            </div>
        </div>
    </div>






    <?php include 'template/footer.html' ?>