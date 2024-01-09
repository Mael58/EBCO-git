<?php include 'template/header.php'; ?>

<main>


    <div class="row-Form">
        <div class="col-2">
            <h1>Formulaire de contact</h1>

            <form  action="#" method="post">
                <div class="section1">
                    <h1>Demande</h1>

                    <label>Produit ou service</label>
                    <select>
                        <option value="cableSurMesure">Câbles sur mesure</option>
                        <option value="injection">Injection plastique</option>
                        <option value="etude">Étude</option>
                        <option value="autre">Autre</option>
                    </select><br>


                    <label>Pour un câble : Type de signal</label>
                    <select>
                        <option value="rs485">RS485</option>
                        <option value="rs232">RS232</option>
                        <option value="ttl5v">TTL 5V</option>
                        <option value="ttl3v3">TTL 3V3</option>
                    </select><br>

                    <label>Pour un câble : Connecteur</label>
                    <select>
                        <option value="fils">Fils</option>
                        <option value="micro usb">Micro USB</option>
                        <option value="rj45">RJ45</option>
                        <option value="rj11">RJ11</option>
                        <option value="rj9">RJ9</option>
                        <option value="switchcraft">Switchcraft</option>
                        <option value="db9">DB9</option>
                      
                    </select><br>
                    <label>Pour un câble : Longueur en mètre</label>
                    <input type="number" name="longueur" value="0.1" min="0.1" step="0.1"></input>
                    <label>Quantité</label>
                    <input type="number" name="qty" value="1" min="1" ></input>
                    <label>Upload schéma (formats : pdf, jpeg ou png)</label>  
                <input type="hidden" name="MAX_FILE_SIZE" value="50000000" />
                <input class="file" type="file" name="uploadp" accept="image/png, image/jpeg, .pdf">


              
             

                </div>
                <div class="section2">
        <h1>Contact</h1>
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="Prenom" name="nom" placeholder="Entrez votre prenom" required>
        


               
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail" required>
         

              
                    <label for="telephone" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Entrez votre numéro de contact" required>
       

          
                  
                </div>
                <div class="section3">
                <h1>Société</h1>
                <label>Nom*</label>
              <input type="text" name="societe" size="30" placeholder="Nom de la société" required>
            <label>Adresse</label>
              <input type="text" name="adresse" size="30" placeholder="Adresse de la société">
            <label>Code postal</label>
              <input type="number" name="codepostal" size="5" placeholder="Code postal de la société">
            <label>Ville</label>
              <input type="text" name="ville" size="30" placeholder="Ville de la société">
            <label>Numéro de téléphone</label>
              <input type="tel" name="stel" size="12" placeholder="Numéro de téléhpone de la société">
            <label>Email</label>
              <input type="text" name="semail" size="30" placeholder="Email de la société">
            <label>Pays</label>
              <select name="spays">
                <option value="france">France</option>
                <option value="belgique">Belgique</option>
                <option value="suisse">Suisse</option>
                <option value="italie">Italie</option>
                <option value="espagne">Espagne</option>
                <option value="autre">Autre</option>
              </select>
                </div>
                <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea> 
            

                <button type="submit" class="btn">Envoyer</button>
            </form>
        </div>


    </div>
    <?php
    if (isset($_POST["nom"], $_POST["email"], $_POST["telephone"], $_POST["message"])) {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];
        $message = $_POST["message"];
    }


    ?>

<div class="row-Contact">
        <div class="col-2-Contact">
            <h1>Contactez-nous </h1>
         
        
                  
                    <p> Adresse : 3 rue Saint Vincent de Paul - 89420 Savigny-en-Terre-Plaine</p>
          
                    <p> Téléphone : 03 86 32 39 50</p>
       
            
            
                    
                    <p> Email: ericbelouet@ebconnections.com</p>
          
              
              
                   
                    <p> Site web: www.ebconnections.com</p>
       
        </div>
      
    </div>

 <div class="carte">
            <iframe class="mentions" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4533.
                    683371922161!2d4.07342679474644!3d47.4948951788983!2m3!1f0!2f0!3f0!3m2!
                    1i1024!2i768!4f13.1!3m3!1m2!1s0x47ee079e24aac197%3A0x7b9d7c45a732318e!2s
                    Ebconnections!5e0!3m2!1sfr!2sfr!4v1686497805815!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" refer rerpolicy="no-referrer-when-downgrade"></iframe>
        </div> 
    


</main>
</div>




<!----------Footer--------------->

<?php include 'template/footer.html' ?>


</body>

</html>