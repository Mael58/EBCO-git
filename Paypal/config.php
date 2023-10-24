<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/

// Database Configuration 
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'ebcon_crm'); 
define('DB_USERNAME', 'ebcon_crm'); 
define('DB_PASSWORD', ''); 
//2dD8Kf7VOpuG9ghI

// PayPal Configuration
define('PAYPAL_EMAIL', 'sb-derqf27796357@business.example.com'); 
define('RETURN_URL', 'Paypal/return.php'); 
define('CANCEL_URL', 'Paypal/cancel.php'); 
define('NOTIFY_URL', 'Paypal/notify.php'); 
define('CURRENCY', 'EUR'); 
define('SANDBOX', TRUE); // TRUE or FALSE 
define('LOCAL_CERTIFICATE', FALSE); // TRUE or FALSE

if (SANDBOX === TRUE){
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}else{
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
// PayPal IPN Data Validate URL
define('PAYPAL_URL', $paypal_url);