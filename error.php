<?php include 'Model/ProduitsBDD.php';
include 'template/header.php';

?>



<div class="container">
    <div class="row">
        <div class="col-2">
            <form method="post">
                <input type="text" name="user" placeholder="Saisir votre nom d'utilisateur">
                <!-- <input type="email" placeholder="E-mail"> -->
                <input type="password" name="pswd" placeholder="Saisir votre nouveau mot de passe">
                <button type="submit" class="btn">Enregistrer</button>
            </form>

            <?php
            if (isset($_POST['user']) && isset($_POST['pswd'])) {
                $username = $_POST['user'];
                $password = $_POST['pswd'];


                $bdd = new ProduitsBDD;
                $bdd->mdpOublie($username, $password);
            }


            ?>

            <a href="compte.php" class="btn">revenir à la page precedente &#8594;</a>
        </div>
    </div>
</div>

<!----------Footer--------------->

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col1">
                <h3>Coordonnées</h3>
                <ul>
                    <li>3 rue Saint Vincent de Paul</li>
                    <li>89420 Savigny-en-Terre-Plaine</li>
                    <li>03 86 32 59 50</li>
                    <li>eric.belouet@ebconnections.com</li>
                </ul>
            </div>
            <div class="footer-col2">
                <img src="Public/images/logo.png">
                <h4>Votre Partenaire "Connectique"</h4>
            </div>
            <div class="footer-col3">
                <h3>Liens Utiles</h3>
                <ul>
                    <li><a href="mentions.html" class="lien">Mentions légales</a></li>
                    <li><a href="politique.html" class="lien">Politique de confidentialité</a></li>
                    <li><a href="cookies.html" class="lien">Politique des cookies</a></li>
                    <li><a href="CGV.html" class="lien">CGV</a></li>
                </ul>
            </div>
            <div class="footer-col4">
                <h3>Suivez-nous</h3>
                <ul>
                    <li><a class="lien" href="https://www.linkedin.com/company/ebconnections/?originalSubdomain=fr">Linkedin</a></li>
                    <li><a class="lien" href="https://www.facebook.com/EbconnectionsFR/">Facebook</a>
                    <li>

                        <br>
                        <br>


                </ul>

            </div>
        </div>
        <hr>
        <p class="copyright">Copyright 2023 - EBconnections</p>
    </div>

</div>




<!-------------js for toggle menu-------------->

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



</body>

</html>