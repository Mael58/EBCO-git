<?php session_start(); ?>
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



<body class="bleu">

    <div class="container">

        <div class="navbar">
            <div class="logo">
                <a href="index.html"><img src="images/logo.png" width="200px"></a>
            </div>

        </div>
    </div>







    <?php
    $message = "Vous devez avoir un compte pour acheter, vous allez être redirigé vers la page de compte.";
    echo "<div class='redirection'>
    
    <p>$message</p>
    
    </div>"; ?>
    <script>
        setTimeout(function() {
            window.location.href = 'compte.php';
        }, 1500); // Redirection après 3 secondes (3000 millisecondes)
    </script>

</body>