<?php include_once 'template/header.php';
include_once 'Model/ProduitsBDD.php';
include_once 'Model/DB.php';
$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USERNAME;
$db_pass = DB_PASSWORD;

try {
    $db = new PDO(
        'mysql:host=' . $db_host . ';dbname=' . $db_name . ';',
        $db_user,
        $db_pass,
    );
} catch (Exception $e) {
    die('erreur: ' . $e);
}

// Interrogez la base de données pour obtenir les détails du produits en fonction de la référence
$sqlQuery = "SELECT * FROM imagesCaroussel";
$donnees = $db->prepare($sqlQuery);

$donnees->execute();
$datas = $donnees->fetchAll(PDO::FETCH_ASSOC);
$db = null;



?>
<?php
if (isset($_SESSION['username'])) { ?>
    <h1>Bienvenue <?= $_SESSION['username']; ?></h1>
<?php
} ?>




<div id="demo" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
        <?php foreach ($datas as $i => $data) : ?>


            <button type="button" data-bs-target="#demo" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>"></button>
        <?php endforeach; ?>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        <?php foreach ($datas as $i => $data) : ?>
            <div class="carousel-item<?= $i === 0 ? ' active' : '' ?>">
                <img src="<?= $data['image'] ?>" alt="Image <?= $i + 1 ?>" class="d-block mx-auto" style="width:30%">
                <div class="carousel-caption d-none d-md-block">
                    <h3><?= $data['titre']?></h3>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

   
</div>

<div class="row mt-3">
        <?php foreach ($datas as $i => $data) : ?>
            <div class="col">
            <img src="<?= $data['image'] ?>" alt="Thumbnail <?= $i + 1 ?>" class="d-block mx-auto"  data-bs-target="#demo" data-bs-slide-to="<?= $i ?>">
        </div>
        <?php endforeach; ?>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {
        $('.carousel').carousel();
    });
</script>




<div class="row">
    <div class="col-2">

        <h1>EBconnections</h1>
        <h2>Vos Idées Produites Chez Nous</h2>
        <p class="parag">Fabrication de câbles sur mesure <br>
            Surmoulage de connecteurs pour milieu difficile <br>
            Conseil en intégration électronique <br>
            Conception de produits électroniques sur-mesure <br>
            Conception et réalisation de prototypes avant industrialisation série <br>
            SAV, garantie de pérennité sur toutes nos réalisations</p>
        <a href="solution" class="btn">Explorer &#8594;</a>
    </div>
    <div class="col-2">
        <img src="Public/images/montage-2.png">
    </div>

</div>

</div>
</div>
<!------------------ featured categories --------------->
<div class="categories">
    <div class="small-container">
        <div class="row">
            <div class="col-3">
                <img src="Public/images/switch-c-550x604.jpg">
            </div>
            <div class="col-3">
                <img src="Public/images/fabrication-550x604.jpg" alt="switch craft avec injection">
            </div>
            <div class="col-3">
                <img src="Public/images/usbfils1-550x604.jpg">
            </div>
        </div>
    </div>
</div>

<!-------------- Our Featured Products -------------->


<div class="small-container">
    <h2 class="title">Derniers produits</h2>
    <div class="row-usb">

        <?php


        $produit = new ProduitsBDD();
        $recipes = $produit->getProduit();
        $produit->close();



        foreach ($recipes as $recipe) {
            $nom = $recipe['nom'];
            $ref = $recipe['reference'];
            $image = $recipe['lienImage'];
            $norme = $recipe['norme'];
            $puissance = $recipe['puissance'];
            $connecteur = $recipe['connecteur'];
            $dataRate = $recipe['dataRate'];
            $longueur = $recipe['longueur'];
            $prix = $recipe['prix']; ?>




            <div class="col-usb">
                <a href="details?nom=<?= urlencode($recipe['nom']) ?>">
                    <h2><?= $recipe['nom'] ?></h2>

                    <img src="<?= $recipe['lienImage'] ?>">

                    <p>Puissance: <?= $puissance ?><br>
                        Connecteur: <?= $connecteur ?><br>
                        Debit: <?= $dataRate ?><br>
                        Longueur: <?= $longueur ?><br></p>
                    <p><?= $recipe['prix'] ?> €</p>
                </a>
            </div>






        <?php


        }



        ?>
    </div>
</div>





</div>

<!----------offer--------------->

<div class="offer">
    <div class="small-container">
        <div class="row">
            <div class="col-2">
                <img src="Public/images/Exclusive-700x613.png" class="offer-img">
            </div>
            <div class="col-2">
                <h2>Câbles entièrement personnalisables</h2>
                <h1>Nos Solutions Câbles</h1>
                <small class="parag">Nos câbles intelligents sont personnalisables à la demande</small>
                <br>
                <a href="usb" class="btn">Acheter &#8594;</a>
            </div>
        </div>
    </div>

</div>

<!----------testimonial--------------->

<div class="testimonial">
    <div class="small-container">
        <div class="row">
            <a href="ebco">
                <div class="col-3">

                    <img src="Public/images/Eric-belouet.jpg">
                    <h3>Qui sommes-nous?</h3>
                </div>
            </a>
            <a href="solution">
                <div class="col-3">

                    <img src="Public/images/fabrication-2.jpg">
                    <h3>Nos prestations</h3>
                </div>
            </a>
            <a href="usb">
                <div class="col-3">


                    <img src="Public/images/RS485-lg.png">
                    <h3>Nos câbles</h3>
                </div>
            </a>
        </div>
    </div>
</div>
<!----------Marques--------------->
<div class="brands">
    <div class="small-container">
        <div class="row">


            <div class="col-5">
                <img src="Public/images/logo-digikey.png">
            </div>
            <div class="col-5">
                <img src="Public/images/logo-pp.png">
            </div>
        </div>
    </div>
</div>
<!----------Footer--------------->

<?php include_once 'template/footer.html' ?>