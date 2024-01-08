<?php

include_once './DB.php';
$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USERNAME;
$db_pass = DB_PASSWORD;

if (isset($_POST['nomProduit'])) {
    $nom = $_POST['nomProduit'];

    try {
        $db = new PDO(
            'mysql:host=' . $db_host . ';dbname=' . $db_name . ';',
            $db_user,
            $db_pass
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $sqlQuery = "SELECT DISTINCT LOWER(nom) as nom FROM vente WHERE LOWER(nom) LIKE :nom";
    $donnees = $db->prepare($sqlQuery);
    $donnees->bindValue(':nom', '%' . strtolower($nom) . '%', PDO::PARAM_STR);
    $donnees->execute();
    $resultats = $donnees->fetchAll(PDO::FETCH_COLUMN);

    $db = null;

    $categories = array_map('ucwords', $resultats);

    
    echo '<ul>';
    foreach ($categories as $categorie) {
        echo '<li><a href="details?nom=' . urlencode($categorie) . '">' . $categorie . '</a></li>';
    }
    echo '</ul>';
}
    
?>
