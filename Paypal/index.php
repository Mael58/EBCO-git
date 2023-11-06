<?php

session_start();

// Récupérez les données depuis la query parameters
$prenom = isset($_GET['prenom']) ? urldecode($_GET['prenom']) : "";
$nom = isset($_GET['nom']) ? urldecode($_GET['nom']) : "";
$tel = isset($_GET['tel']) ? urldecode($_GET['tel']) : "";
$email = isset($_GET['email']) ? urldecode($_GET['email']) : "";
$cdp = isset($_GET['cdp']) ? urldecode($_GET['cdp']) : "";
$ville = isset($_GET['ville']) ? urldecode($_GET['ville']) : "";
$pays = isset($_GET['pays']) ? urldecode($_GET['pays']) : "";
$numRue = isset($_GET['numRue']) ? urldecode($_GET['numRue']) : "";
$rue = isset($_GET['rue']) ? urldecode($_GET['rue']) : "";
$societe = isset($_GET['societe']) ? urldecode($_GET['societe']) : "";

$nomCommande = $_GET['nomCommande'];
$prix = $_GET['prix'];
$quantite = $_GET['quantite'];






// The rest of your code can use these variables as needed.






// Récupérez le total depuis la session
if (isset($_SESSION['total'])) {
    $total = $_SESSION['total'];
}



/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/
require_once('dbclass.php');
$db = new DB;
$db->query("SELECT * FROM `vente`");
$products = $db->resultSet();
$db->close();
?>
<html>

<head>
    <title>Confirmation de paiment</title>
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>

<body>

    <div style="width:700px; margin:50 auto;">
        <h2>Les informations de livraison suivante sont-elles bonnes ?</h2>

        <div class='product_wrapper'>
            <form method='post' action='<?php echo PAYPAL_URL; ?>'>

                <!-- PayPal business email to collect payments -->
                <!-- <input type='hidden' name='business' value='<?php echo PAYPAL_EMAIL; ?>'> -->

                <!-- Details of item that customers will purchase -->
                <!-- <input type='hidden' name='item_number' value='<?php echo '1'; ?>'>
                <input type='hidden' name='item_name' value='<?php echo 'total panier EBconnections'; ?>'>
                <input type='hidden' name='amount' value='<?php echo $_SESSION['total'] ?>'>
                <input type='hidden' name='currency_code' value='<?php echo CURRENCY; ?>'>
                <input type='hidden' name='no_shipping' value='1'> -->

                <!-- PayPal return, cancel & IPN URLs -->
                <!-- <input type='hidden' name='return' value='<?php echo RETURN_URL; ?>'>
        <input type='hidden' name='cancel_return' value='<?php echo CANCEL_URL; ?>'>
        <input type='hidden' name='notify_url' value='<?php echo NOTIFY_URL; ?>'> -->
                <div id="paypal-button-container"></div>
                <?php
                $order = [
                    'purchase_units' => [
                        [
                            'amount' => [
                                'value' => "0.1", // Montant en euros
                                'currency_code' => 'EUR'
                            ],
                            'shipping' => [
                                'address' => [
                                    'address_line_1' => "{$numRue} {$rue}",
                                    'admin_area_2' => $ville,
                                    'postal_code' => $cdp,
                                    'country_code' => $pays,
                                    'given_name' => $prenom,
                                    'surname' => $nom
                                ]
                            ],
                            'item_list' => [
                                'items' => []
                            ]
                        ]
                    ]
                ];

                for ($i = 0; $i < count($nomCommande); $i++) {
                    $item_name = $nomCommande[$i];
                    $item_prix = $prix[$i];
                    $item_qte = $quantite[$i];

                    $item = [
                        'name' => $item_name,
                        'unit_amount' => [
                            'price' => $item_prix,
                            'currency_code' => 'EUR'
                        ],
                        'quantity' => $item_qte
                    ];

                    // Utilisez [] pour ajouter un élément à la liste d'articles
                    $order['purchase_units'][0]['item_list']['items'][] = $item;
                }

                // Convertissez le tableau en JSON à la fin
                $order = json_encode($order);


                ?>
                <script src="https://www.paypal.com/sdk/js?client-id=AVb3qzYweFsCxGFdimPz957tf1ZdRwteKvaplwAqGdQUP_DsFPUC9TfR7i9SwkCv1-R79UWA_C0ThDi4&currency=EUR"></script>

                <script>
                    paypal.Buttons({
                        createOrder: function(data, actions) {
                            return actions.order.create(<?= $order ?>);
                        },

                        // JavaScript (Front-end)
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                // Afficher les détails de la transaction dans la console
                                console.log(details);

                                // Récupérer les détails de la commande
                                var nomCommande = [];
                                var prix = [];
                                var quantite = [];

                                <?php
                                // PHP (Back-end)
                                $cart = $_SESSION['cart'][$_SESSION['username']];
                                foreach ($cart as $produit) {
                                    $nomCommande = $produit['nom'];
                                    $quantite = $produit['quantite'];
                                    $prix = $produit['prix'];
                                    $total = $quantite * $prix;

                                    // Ici, vous pouvez stocker ces valeurs dans des tableaux JavaScript
                                    echo "nomCommande.push('" . $nomCommande . "');\n";
                                    echo "quantite.push(" . $quantite . ");\n";
                                    echo "prix.push(" . $prix . ");\n";

                                    // ... Autres opérations de base de données
                                }
                                ?>

                                // Maintenant, vous pouvez envoyer ces données au serveur via une requête AJAX
                                var xhr = new XMLHttpRequest();
                                xhr.open('POST', '../controller/ajout_commandes.php', true);
                                xhr.setRequestHeader('Content-Type', 'application/json');

                                var dataToSend = {
                                    nomCommande: nomCommande,
                                    quantite: quantite,
                                    prix: prix
                                    // Ajoutez d'autres données si nécessaire
                                };
                                console.log(dataToSend);

                                xhr.send(JSON.stringify(dataToSend));

                                // On affiche un message de succès
                                alert(details.payer.name.given_name + ' ' + details.payer.name.surname + ', votre transaction est effectuée. Vous allez recevoir une notification très bientôt lorsque nous validons votre paiement.');
                            });
                        },

                        onCancel: function(data) {
                            alert("Transaction annulée !");
                        }

                        // JavaScript (Front-end)


                    }).render('#paypal-button-container');
                </script>


                <!-- Specify a Pay Now button. -->
                <!-- <input type="hidden" name="cmd" value="_xclick"> -->
                <!-- <button type='submit' class='pay'>Oui, passer au paiement</button> -->
                <button class='pay'><a href="../cart.php">Non, revenir au panier</a></button>
            </form>
        </div>

    </div>

    <?php

    ?>
    <section class="commande">

        <ul>
            <li><strong>Prénom:</strong> <?= $prenom ?></li>
            <li><strong>Nom:</strong> <?= $nom ?></li>

            <li><strong>Société:</strong> <?= $societe; ?></li>

            <li><strong>E-mail:</strong> <?= $email ?></li>
            <li><strong>Numéro de téléphone:</strong> <?= $tel ?></li>
            <li><strong>Adresse:</strong> <?= $numRue ?> <?= $rue ?>, <?= $cdp ?> <?= $ville ?></li>
            <li><strong>Pays:</strong> <?= $pays ?></li>

        </ul>
    </section>



</body>

</html>





<!-- {


purchase_units: [{
    amount: {
        value: '<?= $total ?>', // Montant en euros
        currency_code: 'EUR'
    },
    shipping: {
        address: {


            address_line_1: "<?= $numRue ?> <?= $rue; ?>",

            admin_area_2: "<?= $ville; ?>",

            postal_code: "<?= $cdp; ?>",
            country_code: "<?= $pays; ?>",
            given_name: '<?= $prenom; ?>',
            surname: '<?= $nom; ?>'

        }

    },
    item_list: {
        items: [
            <?php
            for ($i = 0; $i < count($nomCommande); $i++) {
                $item_name = $nomCommande[$i];
                $item_prix = $prix[$i];
                $item_qte = $quantite[$i];

                echo "{\n";
                echo "name: '{$item_name}',\n";
                echo "unit_amount: {\n";
                echo "price: '{$item_prix}',\n";
                echo "currency_code: 'EUR'\n";
                echo "},\n";
                echo "quantity: '{$item_qte}'\n";
                echo "}";

                if ($i < count($nomCommande) - 1) {
                    echo ",\n";
                }
            }
            ?>
        ]
    }



}]

} -->