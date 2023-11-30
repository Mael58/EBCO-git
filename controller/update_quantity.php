<?php

$response = array();

if (isset($_POST['quantite']) && $_POST['nom']) {
    $quantite = $_POST['quantite'];
    $nom = $_POST['nom'];

    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=ebcon_crm;',
            'root',
            ''
        );

        // Récupérer la quantité actuelle depuis la base de données
        $sqlQuantiteActuelle = "SELECT quantite FROM vente WHERE nom = :nom";
        $queryQuantiteActuelle = $db->prepare($sqlQuantiteActuelle);
        $queryQuantiteActuelle->bindParam(':nom', $nom);
        $queryQuantiteActuelle->execute();
        $resultQuantiteActuelle = $queryQuantiteActuelle->fetch(PDO::FETCH_ASSOC);

        if ($resultQuantiteActuelle !== false) {
            $quantiteActuelle = $resultQuantiteActuelle['quantite'];

            // Vérifier que la quantité après la mise à jour ne sera pas négative
            if ($quantiteActuelle - $quantite >= 0) {
                $sqlUpdate = "UPDATE vente SET quantite = quantite - :quantite WHERE nom = :nom";
                $queryUpdate = $db->prepare($sqlUpdate);
                $queryUpdate->bindParam(':quantite', $quantite);
                $queryUpdate->bindParam(':nom', $nom);
                $queryUpdate->execute();

                $response['success'] = true;
                $response['message'] = 'Quantité mise à jour avec succès.';
            } else {
                $response['success'] = false;
                $response['message'] = 'La quantité après la mise à jour serait négative.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'Erreur lors de la récupération de la quantité depuis la base de données.';
        }

        $db = null;
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = 'Erreur : ' . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Les données requises ne sont pas fournies.';
}

// Encodage de la réponse en JSON
echo json_encode($response);
?>
