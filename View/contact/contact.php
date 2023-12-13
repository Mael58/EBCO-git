<?php include 'template/header.php'; ?>

<main>
    <div class="row">
        <div class="col-2">
            <h1>Formulaire de contact</h1>

            <form action="#" method="post">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Numéro de téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Entrez votre numéro de contact" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control message" id="message" name="message" rows="3" required></textarea>
            </div>

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


    <div class="row">
        <div class="col-2">
            <h1>Contactez-nous :</h1>
            <hr>
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
                    Ebconnections!5e0!3m2!1sfr!2sfr!4v1686497805815!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" refer rerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>


</main>
</div>




<!----------Footer--------------->

<?php include 'template/footer.html' ?>


</body>

</html>