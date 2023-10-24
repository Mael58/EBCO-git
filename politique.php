<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité | EBconnections</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
   
   <div class="header">
       <div class="container">
          <div class="navbar">
              <div class="logo">
                  <a href="index.php"><img src="images/logo.png" width="200px"></a>
              </div>
              <nav>
                 <ul id="MenuItems">
                   <li><a href="index.php">Accueil</a></li>
                   <li><a href="EBconnections.php">EBconnections</a></li>
                   <li><a href="solutions.php">Solutions</a></li>
                   <li><a href="produits.php">Produits</a></li>
                   <li><a href="contact.php">Contact</a></li>
                   <li><a href="compte.php">Compte</a></li>
                </ul>
              </nav>
              <a href="cart.php"><img src="images/cart.png" width="30px" height="30px"></a>
              <img src="images/menu.png" onclick="menutoggle()" class="menu-icon">
          </div>
        </div>
   </div>

   <main class="mentions">

   </main>

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
                   <img src="images/logo.png">
                    <h4>Votre Partenaire "Connectique"</h4>
                </div>
                <div class="footer-col3">
                   <h3>Liens Utiles</h3>
                    <ul>
                        <li><a href="mentions.php" class="lien">Mentions légales</a></li>
                        <li><a href="politique.php" class="lien">Politique de confidentialité</a></li>
                        <li><a href="cookies.php" class="lien">Politique des cookies</a></li>
                        <li><a href="CGV.php" class="lien">CGV</a></li>
                    </ul>
                </div>
                <div class="footer-col4">
                   <h3>Suivez-nous</h3>
                    <ul>
                        <li><a href="https://www.linkedin.com/company/ebconnections/?originalSubdomain=fr">Linkedin</a></li>
                        <li><a href="https://www.facebook.com/EbconnectionsFR/">Facebook</a><li>
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
    
    function menutoggle()
    {
        if(MenuItems.style.maxHeight == "0px")
            {
                MenuItems.style.maxHeight = "200px";
            }else
            {
                MenuItems.style.maxHeight = "0px"
            } 
    }
    
</script>



</body>
</html>