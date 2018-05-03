<?php 

escape($_POST);

$price_total = 0;

$PRICE_ORIG = intval(CVDB_ACCESS_PRICE);
$price_before_vat = $PRICE_ORIG * VAT_KOEFICIENT;
$price_total = 0;

if (VAT_KOEFICIENT != 0) { 
 	$price_total = $PRICE_ORIG + ($PRICE_ORIG * VAT_KOEFICIENT);
} else {
	$price_total = $PRICE_ORIG;
}

$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';

$ItemName = $translations['paypal']['checkout_item_name_cvdb'];
$ItemNumber = $translations['paypal']['checkout_item_number'];
$ItemDesc = $translations['paypal']['checkout_item_desc']; 
$ItemQty = '1'; 
$ItemTotalPrice = $price_total;

//Parameters for SetExpressCheckout, which will be sent to PayPal
$padata = 	'&METHOD=SetExpressCheckout'.
			'&RETURNURL='.urlencode($PayPalCVDBReturnURL).
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
$_SESSION['PAYPAL_EMPLOYER_ID'] = $employer_id;		

$paypal= new MyPayPal();
$httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

//Respond according to message we receive from Paypal
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
{
	//Redirect user to PayPal store with Token received.
 	$paypalurl ='https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"].'';
	redirect_to($paypalurl);
	 
}else{
	$smarty->assign('msg', $translations['paypal']['paypal_err_msg'] . ' (' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . ')');
	$smarty->assign('view', 'paypal-error.tpl');
	$template = 'dashboard/dashboard.tpl';
	return;
}