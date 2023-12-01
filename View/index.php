<?php include_once 'template/header.php';
include_once 'Model/ProduitsBDD.php';

 

?>
<?php
if(isset($_SESSION['username'])){?>
<h1>Bienvenue <?=$_SESSION['username'];?></h1>
<?php
}?>
           <div class="row">
                <div class="col-2">

                    <h1>EBconnections</h1>
                    <h1>Vos Idées<br>Produites<br>Chez Nous</h1>
                    <p class="parag">Fabrication de câbles sur mesure <br>
                        Surmoulage de connecteurs pour milieu difficile <br>
                        Conseil en intégration électronique <br>
                        Conception de produits électroniques sur-mesure <br>
                        Conception et réalisation de prototypes avant industrialisation série <br>
                        SAV, garantie de pérennité sur toutes nos réalisations</p>
                    <a href="Solutions.php" class="btn">Explorer &#8594;</a>
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


$produit=new ProduitsBDD();
$recipes=$produit->getProduit();



foreach ($recipes as $recipe) {
    $nom = $recipe['nom'];
    $ref = $recipe['reference'];
    $image = $recipe['lienImage'];
    $norme = $recipe['norme'];
    $puissance = $recipe['puissance'];
    $connecteur = $recipe['connecteur'];
    $dataRate = $recipe['dataRate'];
    $longueur = $recipe['longueur'];
    $prix = $recipe['prix'];?>




<div class="col-usb">
<a href="details.php?nom=<?= $recipe['nom'] ?>">
<h2><?= $recipe['nom'] ?></h2>

    <img src="<?= $recipe['lienImage'] ?>">

 <p>Puissance: <?= $puissance ?><br>
Connecteur: <?= $connecteur ?><br>
Debit:  <?= $dataRate ?><br>
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
               <a href="usb.php" class="btn">Acheter &#8594;</a>
           </div>
       </div>
       </div>
       
   </div>
   
<!----------testimonial--------------->   
  
   <div class="testimonial">
       <div class="small-container">
       <div class="row">
            <a href="EBconnections.php"> <div class="col-3">
                   
                       <img src="Public/images/Eric-belouet.jpg">
                       <h3>Qui sommes-nous?</h3>
           </div></a>
            <a href="Solutions.php"><div class="col-3">
                   
                       <img src="Public/images/fabrication-2.jpg">
                       <h3>Nos prestations</h3>
           </div></a>
            <a href="usb.php"><div class="col-3">
                    
                      
                       <img src="Public/images/RS485-lg.png">
                       <h3>Nos câbles</h3>
           </div></a> 
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

<?php include_once 'template/footer.html'?>