<?php include 'template/header.php'?>
<!----------Footer---------------> 

<main class="mentions">
    <h1 class="cgv">Mentions Légales</h1>
    <p>Découvrez ci dessous toutes nos informations légales concernant la 
        société propriétaire du site EBconnections.com <br>
        Société propriétaire du Site
        
        EBconnections <br>
        3 rue Saint Vincent de Paul - 89420 Savigny-en-Terre-Plaine FRANCE<br>
        Téléphone : 03 86 32 59 50<br>
        Siret : 489 034 975<br>
        RCS : Auxerre<br>
        Siren : 489 034 975<br>
        N° de Tva Intracommunautaire : FR16489034975<br>
        Capital :  2625 €<br>
        Société basée en France<br>
        Droit de rétractation 14 jours*<br>
        Navigation et paiement sécurisé<br>
        Réalisation & Conception : EBconnections<br>
        
        Le site a été réalisé par la société EBconnections, tous droits réservés : <br>
        EBconnections - SARL au capital de 2 625 Euros - RCS 489 034 975 Auxerre <br>
        Adresse : 3 rue Saint Vincent de Paul - 89420 Savigny-en-Terre-Plaine FRANCE <br>
        Tel : 03 86 32 59 50 <br>
        
        Hébergement <br>
        
        La Gestion, la Maintenance et le Suivi de l'hébergement est 
        réalisé par la société EBconnections.
        <br>
        Droits d'auteurs<br>
        
        En application du Code français de la Propriété Intellectuelle et,
         plus généralement, des traités et accords internationaux comportant
          des dispositions relatives à la protection des droits d'auteurs,
           vous vous interdirez de reproduire pour un usage autre que privé
            mais aussi de vendre, distribuer, émettre, diffuser, adapter, modifier,
             publier, communiquer intégralement ou partiellement, sous quelque forme 
             que ce soit, les données, la présentation ou l'organisation du site sans
              l'autorisation écrite préalable de EBconnections©.
        <br>
        Législation française relative au droit d'accès au fichier informatisé
        <br>
        Conformément à la loi française N· 78-17 du 6 janvier 1978 
        relative à l'informatique, aux fichiers et aux libertés (CNIL), 
        tout utilisateur ayant déposé sur ce site des informations 
        directement ou indirectement nominatives, peut demander la 
        communication des informations nominatives le concernant en 
        s'adressant à : EBconnections - 3 rue Saint Vincent de Paul - 89420 Savigny-en-Terre-Plaine  FRANCE et les faire rectifier le cas échéant.
        <br>
        <br>
        <hr>
        <br>
        Accès au site Internet
        <br>
        L'accès au Site est possible 24 heures sur 24, 7 jours sur 7, 
        sauf en cas de force majeure ou d'un événement hors du contrôle 
        de EBconnections et sous réserve des éventuelles pannes et 
        interventions de maintenance nécessaires au bon fonctionnement 
        du Site et des matériels afférents. 
        <br>
        L'accès au service se fait 
        à partir d'un micro-ordinateur connecté à un réseau de télécommunication 
        permettant l'accès au Site selon les protocoles de communication utilisés
         sur le réseau d'Internet.</p>

</main>

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
                    <li><a href="CGV.php" class="lien">Plan du site</a></li>
                </ul>
            </div>
            <div class="footer-col4">
               <h3>Suivez-nous</h3>
                <ul>
                    <li><a class="lien" href="https://www.linkedin.com/company/ebconnections/?originalSubdomain=fr">Linkedin</a></li>
                    <li><a class="lien" href="https://www.facebook.com/EbconnectionsFR/">Facebook</a><li>
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