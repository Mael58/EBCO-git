<?php include_once 'Model/ProduitsBDD.php';
include_once 'template/header.php';

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
                $bdd->close();
            }


            ?>

            <a href="compte" class="btn">revenir à la page precedente &#8594;</a>
        </div>
    </div>
</div>

<!----------Footer--------------->
<?php include_once 'template/footer.php' ?>