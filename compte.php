<?php
 ob_start();

include 'template/header.php';
include 'modele/ProduitsBDD.php';
?>

<!-------------- details compte--------------->




<div class="container">

    <div class="row">

        <div class="col-2">
            <img src="images/montage-2.png" width="100%">
        </div>

        <div class="col-2">
            <div class="form-container">
                <div class="form-btn">
                    <span onclick="login()">Connexion</span>
                    <span onclick="register()">Inscription</span>
                    <hr id="indicator">
                </div>

                <form id="LoginForm" method="post">
                    <input type="text" name="username2" placeholder="Nom d'utilisateur">
                    <input type="password" name="password2" placeholder="Mot de Passe">
                    <button type="submit" class="btn">Connection</button>
                    <a href="error.php">Mot de passe oublié</a>
                </form>

                <form id="RegForm" method="post">
                    <input type="text" name="username" placeholder="Nom d'utilisateur">
                    <!-- <input type="email" placeholder="E-mail"> -->
                    <input type="password" name="password" placeholder="Mot de passe">
                    <button type="submit" class="btn">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $bdd = new ProduitsBDD;
    $bdd->inscription($username, $password);
}



if (isset($_POST['username2'])) {
    $username2 = $_POST['username2'];
    $password2 = $_POST['password2'];
    $bdd = new ProduitsBDD;
    $bdd->connexion($username2, $password2);
}

?>


<script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("indicator");

    function register() {
        RegForm.style.transform = "translateX(0px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(100px)"

    };

    function login() {
        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(300px)";
        Indicator.style.transform = "translateX(0px)"
    };
</script>

<!----------Footer--------------->
<?php include 'template/footer.html' ?>