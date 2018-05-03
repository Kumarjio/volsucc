<?php 

// back btn clicked?
if (isset($goback)) {
	 $_SESSION['JOB_EDITED_ID'] = $job_id;
	 redirect_to(BASE_URL . URL_DASHBOARD . '/' . URL_DASHBOARD_POST . '/draft');
}

$price_total = 0;
if (isset($_POST['price_premium'])) {
	$price_total += PREMIUM_LISTING_PRICE;
	$_SESSION['PricePremium'] =  1; 
}
if (isset($_POST['price_ad'])) {
	$price_total += JOB_POSTED_PRICE;
	$_SESSION['PriceJobAd'] =  1; 
}

$price_before_vat = $price_total * VAT_KOEFICIENT;

// include VAT
if (VAT_KOEFICIENT != 0) { 
 $price_total = $price_total + ($price_total * VAT_KOEFICIENT);
}

$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';
//set session
$ItemName = $item_name; 
$ItemNumber = $item_number; 
$ItemDesc = $item_desc; 
$ItemQty = $item_qty; 
$ItemTotalPrice = $price_total;

//Parameters for SetExpressCheckout, which will be sent to PayPal
$padata = 	'&METHOD=SetExpressCheckout'.
			'&RETURNURL='.urlencode($PayPalReturnURL).
			'&CANCELURL='.urlencode($PayPalCancelURL).
			'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
			'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
			'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
			'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
			'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemTotalPrice).
			'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).
			'&NOSHIPPING=1'. //set 1 to hide buyer's shipping address, in-case products that does not require shipping
			'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
			'&PAYMENTREQUEST_0_AMT='.urlencode($ItemTotalPrice).
			'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode).
			'&LOGOIMG='. $_SERVER['HTTP_HOST'] . '/' . INVOICE_LOGO_PATH . //site logo
			'&CARTBORDERCOLOR=FFFFFF'. //border color of cart
			'&ALLOWNOTE=1';


$_SESSION['ItemPriceBeforeVAT'] = $price_before_vat; 
$_SESSION['ItemName'] =  $ItemName; 
$_SESSION['ItemPrice'] =  $ItemTotalPrice; 
$_SESSION['ItemNumber'] =  $ItemNumber; 
$_SESSION['ItemDesc'] =  $ItemDesc; 
$_SESSION['ItemQty'] =  $ItemQty; 
$_SESSION['ItemTotalPrice'] =  $ItemTotalPrice;
$_SESSION['PAYPAL_JOB_ID'] = $job_id;
$_SESSION['PAYPAL_EMPLOYER_ID'] = $employer_id;

//We need to execute the "SetExpressCheckOut" method to obtain paypal token
$paypal= new MyPayPal();
$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

//Respond according to message we receive from Paypal
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
{
	//Redirect user to PayPal store with Token received.
 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
 	clear_main_cache();
	//header('Location: '.$paypalurl);
	redirect_to($paypalurl);
	 
}else{
	$smarty->assign('msg', $translations['paypal']['paypal_err_msg'] . ' (' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . ')');
	$smarty->assign('view', 'paypal-error.tpl');
	$template = 'dashboard/dashboard.tpl';
	return;
}