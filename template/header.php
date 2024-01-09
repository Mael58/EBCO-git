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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cd2e96c95e.js" crossorigin="anonymous"></script>



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
$db = null;
$donnees->execute();
$categories = $donnees->fetchAll(PDO::FETCH_COLUMN);

$categoriesUniques = array_unique($categories);
?>

<body>

    <div class="bleu">

        <div class="navbar-logo">

            <div class="logo">
                <a href="Accueil"><img src="Public/images/logo.png" alt="logo-EBCO" width="130px"></a>
            </div>

<div class="containerRecherche">
            <form class="search" method="POST" autocomplete="off">
                <input type="text" class="recherche" name="nomProduit" placeholder=" Rechercher... "></input>
                <button class="searchButton" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <div class="resultat" id="resultats"></div>
            </div>

            <!-- <?php
$nom= $_POST['nomProduit'];
if(isset($_POST['nomProduit'])){
header("Location usb");
}
            ?> -->




            <script>
        $(document).ready(function () {
            $('.recherche').on('input', function () {
                var nomProduit = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'Model/recherche.php', 
                    data: { nomProduit: nomProduit },
                    success: function (data) {
                        $('#resultats').html(data);
                    }
                });
            });
        });
    </script>

          

            <div class="liste">
                <ul>
                    <li> <a href="Panier"><img src="Public/images/cart.png" alt="panier" width="30px" height="30px">
                            <span id="cart-count">
                                <?php

                                if (isset($_SESSION['nombreTotalArticles'])) {
                                    echo max(0, $_SESSION['nombreTotalArticles']);
                                } else {
                                    echo 0;
                                }

                                ?>
                            </span>Panier</a>


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
        </div>



        <div class="navbar">
            <nav>
                <ul>
                    <li><a href="Accueil">Accueil</a></li>
                    <li><a href="ebco">EBconnections</a></li>
                    <li><a href="solution">Solutions</a></li>

                    <li class="dropdown">
                        <a class="dropbtn">Produits</a>
                        <div id="menuDeroulant" class="dropdown-content">
                            <?php
                            $liens = [
                                'Câbles USB' => 'usb',
                                'Objet connectes' => 'iot.php',
                            ];

                            foreach ($categoriesUniques as $categorie) {
                                if (isset($liens[$categorie])) {
                                    $lien = $liens[$categorie];
                                }
                                echo '<a href="' . $lien . '">' . $categorie . '</a>';
                            }
                            ?>
                        </div>
                    </li>
                    <li><a href="Contact">Contact</a></li>
                </ul>
            </nav>

        </div>
        <a href="#" id="menuIcon"><img src="Public/images/menu.png" alt="menu" class="menu-icon"></a>
        <div class="overlay2" id="overlay2"></div>   
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

           
            header("Location: Accueil");
            exit;
        }
    }


    ?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var overlay = document.getElementById("overlay2");
    var resultat = document.querySelector(".resultat");
  
    var rechercheInput = document.querySelector(".recherche");
    console.log(resultat);

    rechercheInput.addEventListener("focus", function () {
        overlay.style.display = "block";
        resultat.style.display = "block";
       
    });

    rechercheInput.addEventListener("blur", function () {
     
        setTimeout(function () {
        overlay.style.display = "none";
        resultat.style.display = "none";
    }, 200);
       
     
    });

    resultat.addEventListener("focus", function(){
        resultat.style.display = "block";
    });

});
</script>