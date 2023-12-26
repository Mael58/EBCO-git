<?php

$sansPort= $_POST['sousTotal'];
$fraisPort= $_POST['fraisPort'];
$totalTAxe= $_POST['tvaPrix'];
$totalTAxeArrondi = round($totalTAxe, 2);
$prenom=$_POST['prenomLivraison'];
$nom=$_POST['nomLivraison'];
$numeroRue= $_POST['numLivraison'];
$rue= $_POST['rueLivraison'];
$ville= $_POST['villeLivraison'];
$codePostal= $_POST['cdpLivraison'];





                        
$handling = 0;
$insurance = 0;
$shipping_discount = 0;
$discount = 0;
if ($sansPort < 50) {
    $shipping = $fraisPort;
} else {
    $shipping = 0;
}


$totalAmount = $sansPort + $totalTAxeArrondi + $shipping + $handling + $insurance - $shipping_discount - $discount;

$order = [

    'purchase_units' => [
        [

            'amount' => [
                'value' =>  number_format($totalAmount, 2, '.', ''),
                'currency_code' => 'EUR',
                'breakdown' => [
                    'item_total' => [
                        'currency_code' => "EUR",
                        'value' => $sansPort
                    ],
                    'tax_total' => [
                        'currency_code' => 'EUR',
                        'value' => $totalTAxeArrondi
                    ],
                    'shipping' => [
                        'currency_code' => 'EUR',
                        'value' => $shipping,
                    ],
                    'handling' => [
                        'currency_code' => 'EUR',
                        'value' => 0,
                    ],
                    'insurance' => [
                        'currency_code' => 'EUR',
                        'value' => 0,
                    ],
                    'shipping_discount' => [
                        'currency_code' => 'EUR',
                        'value' => 0,
                    ],
                    'discount' => [
                        'currency_code' => 'EUR',
                        'value' => 0,
                    ],


                ],
                'shipping' => [
                    'name' => [
                        'full_name' => isset($prenom) && isset($nom) ? "{$prenom} {$nom}" : "Nom par défaut",
                    ],
                    'address' => [
                        'address_line_1' => isset($numeroRue) && isset($rue) ? "{$numeroRue} {$rue}" : "Adresse par défaut",
                        'admin_area_2' => isset($ville) ? $ville : "Ville par défaut",
                        'postal_code' => isset($codePostal) ? $codePostal : "Code postal par défaut",
                        'country_code' => isset($pays) ? $pays : "Pays par défaut",
                    ],
                ],

            ],
           
           
        ],
    ],
    
];
echo json_encode($order);
?>