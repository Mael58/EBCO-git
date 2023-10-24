<?php include 'template/header.php';
include 'modele/ProduitsBDD.php';

?>


<div class="small-container-usb">
    <div class="row-2-usb">
        <h2>Câbles USB: </h2>

        <!-- <p>Le composant FT232RL de FTDICHIP permet une connexion USB vers une liaison RS232 très rapide.<br>
Une liaison série virtuelle ou une programmation utilisant la
librairie DDL permet l'interfaçage aussi bien sous Windows,
Mac ou Linux</p> 
                 -->
        <select id="tri">
            <option>Trier par</option>
            <option class="prixCroissant">prix croissant</option>
            <option class="prixDecroissant">prix décroissant</option>
            <option class="triAlphabetique">ordre alphabétique</option>

        </select>
    </div>

    <div class="row-usb">

        <?php





        $recipeController = new ProduitsBDD();
        $recipes = $recipeController->getVente("USB");





        foreach ($recipes as $recipe) {
            $nom = $recipe['nom'];
            $ref = $recipe['reference'];
            $image = $recipe['lienImage'];
            $norme = $recipe['norme'];
            $puissance = $recipe['puissance'];
            $connecteur = $recipe['connecteur'];
            $dataRate = $recipe['dataRate'];
            $longueur = $recipe['longueur'];
            $prix = $recipe['prix'];
        ?>




            <div class="col-usb">
                <a href="details.php?nom=<?= $recipe['nom'] ?>">
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const triSelect = document.getElementById("tri");
        const rowUsb = document.querySelector(".row-usb");
        const recipes = <?php echo json_encode($recipes); ?>;

        triSelect.addEventListener("change", function() {
            const selectedOption = triSelect.options[triSelect.selectedIndex].classList;

            if (selectedOption.contains("prixCroissant")) {
                recipes.sort((a, b) => a.prix - b.prix);
            } else if (selectedOption.contains("prixDecroissant")) {
                recipes.sort((a, b) => b.prix - a.prix);
            } else if (selectedOption.contains("triAlphabetique")) {
                recipes.sort((a, b) => a.nom.localeCompare(b.nom));
            }

            // Effacez les éléments actuels de la liste
            while (rowUsb.firstChild) {
                rowUsb.removeChild(rowUsb.firstChild);
            }

            // Réaffichez les éléments triés
            recipes.forEach(function(recipe) {
                const colUsb = document.createElement("div");
                colUsb.classList.add("col-usb");
                colUsb.innerHTML = `
                <h2>${recipe.nom}</h2>
                <a href="details.php?nom=${recipe.nom}">
                    <img src="${recipe.lienImage}">
                </a>
                <p>${recipe.prix} €</p>
            `;
                rowUsb.appendChild(colUsb);
            });
        });
    });
</script>
</diV>

<?php include 'template/footer.html'; ?>