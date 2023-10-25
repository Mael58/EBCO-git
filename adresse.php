<?php include 'template/header.php';

?>

<body>



    <div class="container-achat">
        <div class="col-2-achat">
            <div class="form-container-achat">
                <form method='post' action="controller/ajout_client.php">
                    <legend>Merci d'inscrire vos informations de livraison</legend>
                    <div class="section-1">
                        <label for="prenom">Prénom*</label>
                        <input type="text" name="prenom" placeholder="Votre prénom" required="required">

                        <label for="nom">nom*</label>
                        <input type="text" name="nom" placeholder="Votre nom" required="required">

                        <label for="mail">E-mail*</label>
                        <input type="email" name="email" placeholder="Votre email" required="required">

                        <label for="societe">Société</label>
                        <input type="text" name="societe" placeholder="Votre société pour qui vous achetez">

                        <label for="tel">Numéro de téléphone</label>
                        <input type="tel" name="tel" placeholder="Votre numéro de téléphone" required="required">
                    </div>


                    <div class="section-2">
                        <label for="rue">Rue*</label>
                        <input type="text" name="rue" placeholder="Nom de la rue" required="required">

                        <label for="numRue">Numéro de rue*</label>
                        <input type="text" name="numRue" placeholder="Numéro de la rue" required="required">

                        <label for="cdp">Code postal*</label>
                        <input type="number" name="cdp" placeholder="Code postal" required="required">

                        <label for="ville">Ville*</label>
                        <input type="text" name="ville" placeholder="Ville" required="required">

                        <label for="pays">Pays</label>
                        <select name="pays">
                            <option value="FR" selected>France</option>
                            <option value="BE">Belgique</option>
                            <option value="CH">Suisse</option>
                            <option value="IT">Italie</option>
                            <option value="ES">Espagne</option>
                            <option value="">Autre</option>
                        </select>
                    </div>

                    <input type="submit" class="btn" value="Vérifier votre adresse">
                </form>




            </div>
        </div>
    </div>



    <?php include 'template/footer.html' ?>