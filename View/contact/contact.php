<?php include 'template/header.php';?>

        <main>
            <div class="row">
                <div class="col-2">
                    <h1>Formulaire de contact</h1>
                        
                    <label for="formGroupExampleInput" class="form-label" style="display: flex; align-items: left;">Nom</label>
                    <br>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Entrez votre nom">
                
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label" style="display: flex; align-items: left;">E-mail</label><br>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Entrez votre e-mail">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label" style="display: flex; align-items: left;">Numéro de téléphone</label><br>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Entrez votre numéro de contact">
                        </div>
                        <div class="mb-3">
                            <label  for="exampleFormControlTextarea1" class="form-label" style="display: flex; align-items: left;">Message</label><br>
                            <textarea class="form-control message" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <!-- <button class="btn btn-primary">Envoyer</button> -->
                        <a href="Solutions.html" class="btn">Envoyer &#8594;</a>
                </div>
                
               
            </div>
             <div class="row">
                <div class="col-2">
                    <h1>Contactez-nous :</h1><hr>
                    <div class="mt-4">
                        <div class="d-flex">
                            <i class="bi bi-geo-alt-fill"></i>
                            <p> Adresse : 3 rue Saint Vincent de Paul - 89420 Savigny-en-Terre-Plaine</p>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <i class="bi bi-telephone-fill"></i>
                            <p> Contact : 03 86 32 39 50</p>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <i class="bi bi-envelope-fill"></i>
                            <p> Email: ericbelouet@ebconnections.com</p>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <i class="bi bi-browser-chrome"></i>
                            <p> Adresse du site: www.ebconnections.com</p>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="col-2">
                    <iframe class="mentions" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4533.
                    683371922161!2d4.07342679474644!3d47.4948951788983!2m3!1f0!2f0!3f0!3m2!
                    1i1024!2i768!4f13.1!3m3!1m2!1s0x47ee079e24aac197%3A0x7b9d7c45a732318e!2s
                    Ebconnections!5e0!3m2!1sfr!2sfr!4v1686497805815!5m2!1sfr!2sfr" width="600"
                    height="450" style="border:0;" allowfullscreen="" loading="lazy" refer
                    rerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div> 
    
           
        </main>
    </div>


    
    
<!----------Footer---------------> 

<?php include 'template/footer.html'?>


    </body>
</html>