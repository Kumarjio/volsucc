<?php 

//make sure session() has started
$PayPalMode 			= (PAYPAL_SANDBOX == 1) ? 'sandbox' : ''; // sandbox or live
$PayPalApiUsername 		= trim(PAYPAL_MERCHANT_API_EMAIL); // API Username
$PayPalApiPassword 		= trim(PAYPAL_MERCHANT_API_PASSWORD); // API password
$PayPalApiSignature 	= trim(PAYPAL_MERCHANT_API_SIGNATURE); // API Signature
$PayPalCurrencyCode 	= PAYPAL_CURRENCY_CODE; // Currency Code
$PayPalReturnURL 		= PROTOCOL . MAIN_URL . 'process_paypal'; // Return url from Paypal
$PayPalCVDBReturnURL 	= PROTOCOL . MAIN_URL . 'process_paypal_cvdb'; // CVDB url from Paypal
$PayPalACCOUNTReturnURL = PROTOCOL . MAIN_URL . 'process_paypal_account';
$PayPalCancelURL 		= PROTOCOL . MAIN_URL . 'cancel_paypal'; // Cancel URL if user clicks cancel

if ($cache->testCache('CACHE_PAYMENT_MODE')) 
{
 	$PAYMENT_MODE = $cache->loadCache('CACHE_PAYMENT_MODE');
} 
else 
{
	$sql = 'SELECT id FROM payment_mode WHERE active = 1';
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$PAYMENT_MODE = $row['id'];
	$cache->saveCache($row['id'], 'CACHE_PAYMENT_MODE');
}

define('PAYMENT_MODE', $PAYMENT_MODE);

?>