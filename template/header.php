<?php
session_start();
include_once 'Model/DB.php';
$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USERNAME;
$db_pass = DB_PASSWORD;





?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catalogue des Produits | EBconnections</title>
    <link rel="stylesheet" href="Public/Style/style.css">
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" href="Public/Bootstrap/css/bootstrap.css"> -->
   


</head>

<?php

try {
    $db = new PDO(
        'mysql:host=' . $db_host . ';dbname=' . $db_name . ';',
        $db_user,
        $db_pass,
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
                <a href="index.php"><img src="Public/images/logo.png" width="200px"></a>



            </div>
            <ul>
                <li> <a href="Panier"><img src="Public/images/cart.png" width="30px" height="30px">
                        <span id="cart-count">
                            <?php

                            if (isset($_SESSION['nombreTotalArticles'])) {
                                echo max(0, $_SESSION['nombreTotalArticles']);
                            } else {
                                echo 0;
                            }

                            ?>
                        </span></a>
                       

                </li>

                <?php if (!isset($_SESSION['username'])) {
                    echo '<li><a href="compte"><img src="Public/images/conn.png"  width="30px" height="30px"> Connexion</a></li>';
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
                    <li><a href="ebco">EBconnections</a></li>
                    <li><a href="solution">Solutions</a></li>
                    <div class="dropdown">
                        <li class="dropbtn">Produits</li>
                        <div id="menuDeroulant" class="dropdown-content">
                            <?php

                            $liens = [
                                'Cable USB' => 'usb',
                                'Objet connectes' => 'iot.php',

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




                    <li><a href="Contact">Contact</a></li>



                </ul>
            </nav>
          


        </div>
        <a href="#" id="menuIcon"><img src="Public/images/menu.png" class="menu-icon"></a>
    </div>
    <?php




    // Vérifiez si l'utilisateur est connecté et a cliqué sur le bouton de déconnexion
    if (isset($_SESSION['username'])) {
        if (isset($_POST['deconnexion'])) {
            // Détruisez la session actuelle

            $username = $_SESSION['username'];






            $cookie_expiration = time() + (7 * 24 * 60 * 60);
            setcookie("adresse-$username", json_encode($_SESSION['adresse']), $cookie_expiration, '/', '', true, true);
            setcookie("adresseFacturation-$username", json_encode($_SESSION['adresseFacturation']), $cookie_expiration, '/', '', true, true);


            setcookie("panier-$username", json_encode($_SESSION['panier']), $cookie_expiration, '/', '', true, true);
            setcookie("nbArticle-$username", json_encode($_SESSION['nombreTotalArticles']), $cookie_expiration, '/', '', true, true);



            session_destroy();

            // Redirigez l'utilisateur vers la page de connexion (ou une autre page de votre choix)
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }


    ?>






    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var MenuItems = document.getElementById("MenuItems");
            MenuItems.style.maxHeight = "0px";

            function menutoggle() {
                if (MenuItems.style.maxHeight == "0px") {
                    MenuItems.style.maxHeight = "200px";
                } else {
                    MenuItems.style.maxHeight = "0px";
                }
            }

            // Assurez-vous que votre image a une balise d'ouverture <a> associée
            var menuIcon = document.getElementById("menuIcon");
            menuIcon.addEventListener("click", menutoggle);
        });
    </script>