<?php
$response = array();

$data = json_decode(file_get_contents("php://input"));


// Vous pouvez maintenant traiter les données, les insérer dans la base de données, etc.


$quantite = $data->quantite;
$prix = $data->prix;
$nomCommande = $data->nomCommande;
  

    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=ebcon_crm;',
            'root',
            ''
        );

        // Validate and sanitize input (not shown in this example)

        // Récupérer la quantité actuelle depuis la base de données
        if (isset($nomCommande) && is_array($nomCommande) && isset($quantite)) {
            for ($i = 0; $i < count($nomCommande); $i++) {
                $nomProduit = $nomCommande[$i];
                $quantiteProduit = $quantite[$i];
                
                $sqlQuantiteActuelle = "SELECT quantite FROM vente WHERE nom = :nom";
                $queryQuantiteActuelle = $db->prepare($sqlQuantiteActuelle);
                $queryQuantiteActuelle->bindParam(':nom', $nomProduit);
                $queryQuantiteActuelle->execute();
                $resultQuantiteActuelle = $queryQuantiteActuelle->fetch(PDO::FETCH_ASSOC);

                if ($resultQuantiteActuelle !== false) {
                    $quantiteActuelle = $resultQuantiteActuelle['quantite'];

                    // Vérifier que la quantité après la mise à jour ne sera pas négative
                    if ($quantiteActuelle - $quantiteProduit >= 0) {
                        $sqlUpdate = "UPDATE vente SET quantite = quantite - :quantite WHERE nom = :nom";
                        $queryUpdate = $db->prepare($sqlUpdate);
                        $queryUpdate->bindParam(':quantite', $quantiteProduit);
                        $queryUpdate->bindParam(':nom', $nomProduit);
                        $queryUpdate->execute();

                        $response['success'] = true;
                        $response['message'] = 'Quantité mise à jour avec succès pour le produit ' . $nomProduit;
                    } else {
                        $response['success'] = false;
                        $response['message'] = 'La quantité après la mise à jour serait négative pour le produit ' . $nomProduit;
                    }
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Erreur lors de la récupération de la quantité depuis la base de données pour le produit ' . $nomProduit;
                }
            }
        }
    } catch (PDOException $e) {
        $response['success'] = false;
        $response['message'] = 'Erreur PDO : ' . $e->getMessage();
    } catch (Exception $e) {
        $response['success'] = false;
        $response['message'] = 'Erreur : ' . $e->getMessage();
    } finally {
        // Close the database connection
        $db = null;
    }


// Encodage de la réponse en JSON
echo json_encode($response);
?>
