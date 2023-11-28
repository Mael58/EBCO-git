<?php
session_start();










// Récupère le chemin absolu du fichier en cours d'exécution (header.php)






?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catalogue des Produits | EBconnections</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->


</head>

<?php

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=ebcon_crm;',
        'root',
        ''
    );
} catch (Exception $e) {
    die('erreur: ' . $e);
}

$sqlQuery = "SELECT description FROM vente ";
$donnees = $db->prepare($sqlQuery);
$donnees->execute();
$categories = $donnees->fetchAll(PDO::FETCH_COLUMN);

$categoriesUniques = array_unique($categories);
?>

<body class="bleu">

    <div class="container">

        <div class="navbar-logo">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" width="200px"></a>



            </div>
            <ul>
                <li> <a href="cart.php"><img src="images/cart.png" width="30px" height="30px">
                        <span id="cart-count">
                            <?php

                            if (isset($_SESSION['nombreTotalArticles'])) {
                                echo max(0, $_SESSION['nombreTotalArticles']);
                            } else {
                                echo 0;
                            }

                            ?>
                        </span>
                        <img src="images/menu.png" onclick="menutoggle()" class="menu-icon">Panier</a>

                </li>

                <?php if (!isset($_SESSION['username'])) {
                    echo '<li><a href="compte.php"><img src="images/conn.png"  width="30px" height="30px"> Connexion</a></li>';
                } ?>



                <?php if (isset($_SESSION['username'])) {
                    echo '
    <form method="post">
        <input type="submit" class="btn" name="deconnexion" value="Déconnexion">
    </form>';
                }
                ?>
            </ul>
        </div>
        <div class="navbar">
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="EBconnections.php">EBconnections</a></li>
                    <li><a href="solutions.php">Solutions</a></li>
                    <div class="dropdown">
                        <li onclick="myFunction()" class="dropbtn">Produits</li>
                        <div id="menuDeroulant" class="dropdown-content">
                            <?php

                            $liens = [
                                'Cable USB' => 'usb.php',
                                'Objet connectes' => 'iot.php',
                                // Ajoutez d'autres catégories et URLs au besoin
                            ];


                            foreach ($categoriesUniques as $categorie) {
                                // Assurez-vous que la catégorie existe dans le tableau de liens
                                if (isset($liens[$categorie])) {
                                    $lien = $liens[$categorie];
                                } else {
                                    $lien = 'produits.php'; // Lien par défaut si la catégorie n'est pas trouvée
                                }
                                echo '<a href="' . $lien . '">' . $categorie . '</a>';
                            }
                            ?>

                        </div>
                    </div>

                    <script>
                        function myFunction() {
                            var menu = document.getElementById("menuDeroulant");
                            if (menu.style.display === "block") {
                                menu.style.display = "none";
                            } else {
                                menu.style.display = "block";
                            }
                        }
                    </script>


                    <li><a href="contact.php">Contact</a></li>



                </ul>
            </nav>


        </div>
    </div>
    <?php




    // Vérifiez si l'utilisateur est connecté et a cliqué sur le bouton de déconnexion
    if (isset($_SESSION['username'])) {
        if (isset($_POST['deconnexion'])) {
            // Détruisez la session actuelle

            $username = $_SESSION['username'];






            $cookie_expiration = time() + (7 * 24 * 60 * 60);
            setcookie("adresse-$username", json_encode($_SESSION['adresse']), $cookie_expiration, '/');



            setcookie("panier-$username", json_encode($_SESSION['panier']), $cookie_expiration, '/');


            session_destroy();

            // Redirigez l'utilisateur vers la page de connexion (ou une autre page de votre choix)
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }


    ?>






    <script>
        var MenuItems = document.getElementById("MenuItems");

        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>