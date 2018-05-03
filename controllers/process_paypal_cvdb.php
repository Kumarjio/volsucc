<?php

 	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 * <support@niteosoft.co.uk>
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    Proprietary software license
	 * @website    simplejobscript.com
	 * 
	 * OFFICIAL PAYPAL PLUGIN
	 */

//Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if(isset($_GET["token"]) && isset($_GET["PayerID"]))
{
	//we will be using these two variables to execute the "DoExpressCheckoutPayment"
	//Note: we haven't received any payment yet.
	
	$token = $_GET["token"];
	$payer_id = $_GET["PayerID"];
	
	//get session variables
	$ItemPriceBeforeVAT = $_SESSION['ItemPriceBeforeVAT'];
	$ItemName 			= $_SESSION['ItemName']; //Item Name
	$ItemPrice 			= $_SESSION['ItemPrice'] ; //Item Price
	$ItemNumber 		= $_SESSION['ItemNumber']; //Item Number
	$ItemDesc 			= $_SESSION['ItemDesc']; //Item Number
	$ItemQty 			= $_SESSION['ItemQty']; // Item Quantity
	$ItemTotalPrice 	= $_SESSION['ItemTotalPrice']; //(Item Price x Quantity = Total) Get total amount of product; 
	$EMPLOYER_ID = $_SESSION['PAYPAL_EMPLOYER_ID'];

	$padata = 	'&TOKEN='.urlencode($token).
				'&PAYERID='.urlencode($payer_id).
				'&PAYMENTREQUEST_0_PAYMENTACTION='.urlencode("SALE").
				
				//set item info here, otherwise we won't see product details later	
				'&L_PAYMENTREQUEST_0_NAME0='.urlencode($ItemName).
				'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
				'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
				'&L_PAYMENTREQUEST_0_AMT0='.urlencode($ItemPrice).
				'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).

				'&PAYMENTREQUEST_0_ITEMAMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_AMT='.urlencode($ItemTotalPrice).
				'&PAYMENTREQUEST_0_CURRENCYCODE='.urlencode($PayPalCurrencyCode);
	
	//We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
	$paypal= new MyPayPal();
	$httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

	//Check if everything went ok..
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
	{

				$transactionId = urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);
			
				/*
				//Sometimes Payment are kept pending even when transaction is complete. 
				//hence we need to notify user about it and ask him manually approve the transiction
				*/
				
				if('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					$result_msg = $translations['paypal']['status_completed_msg'];
				}
				elseif('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"])
				{
					//$result_msg = $translations['paypal']['status_pending_msg'];
					$result_msg = $translations['paypal']['status_completed_msg'];
					// sending notification
					$mailer = new Mailer();
					$mailer->notifyPaypalPendingTransaction($transactionId, $EMPLOYER_ID, $JOB_ID);
				}

				// we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
				// GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
				$padata = 	'&TOKEN='.urlencode($token);
				$paypal= new MyPayPal();
				$httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

				if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) 
				{

					$data = array("transcation_id" => $transactionId, "tr_status" => urldecode($httpParsedResponseAr["ACK"]),
								  "tr_timestamp" => urldecode($httpParsedResponseAr["TIMESTAMP"]), "employer_id" => $EMPLOYER_ID,
								  "job_id" => '-', "paypal_payer_id" => urldecode($httpParsedResponseAr["PAYERID"]),
								  "payer_status" => urldecode($httpParsedResponseAr["PAYERSTATUS"]), "payer_email" => urldecode($httpParsedResponseAr["EMAIL"]),
								  "payer_name" => urldecode($httpParsedResponseAr["FIRSTNAME"]), "payer_surname" => urldecode($httpParsedResponseAr["LASTNAME"]),
								  "amount" => urldecode($httpParsedResponseAr["AMT"]), "currency" => urldecode($httpParsedResponseAr["CURRENCYCODE"]));

					$em = new Employer();
					$class = new Company();
					$job = new Job();

					//store the payment
					$em->createPayment($data);

					// currency / amount check
					if ((intval($httpParsedResponseAr["AMT"]) != intval($ItemTotalPrice)) || PAYPAL_CURRENCY_CODE != $httpParsedResponseAr["CURRENCYCODE"])  {
						$smarty->assign('msg', $translations['paypal']['paypal_err_msg'] . ' (' . $translations['paypal']['currency_amount_error'] . ')');
						$smarty->assign('view', 'paypal-error.tpl');
						$template =  'dashboard/dashboard.tpl';
						return;
					} else {
						 require_once APP_PATH . '_lib/class.MYPDF.php';
						 //generate invoice
				 		 $companyData = $class->getCompanyByEmployerId($EMPLOYER_ID);
						 $inv_data = array("name" => $companyData['name'], "Addr1" => $companyData['street'], 'Addr2' => $companyData['city_postcode']);

						 $orders[] = array('desc' => INVOICE_CVDB_DESCRIPTION, 'price' => CVDB_ACCESS_PRICE);

						 $date = date('YmdHi');
						 $invoice_id = $translations['invoice']['invoice'] . substr($date, 2, strlen($date)) . '/' . $EMPLOYER_ID;
						 $invoice_filename =  'invoice-' . substr($date, 2, strlen($date)) . '-' . $EMPLOYER_ID;
						 MYPDF::generateInvoice($invoice_id, $inv_data, $orders, $translations, $invoice_filename, $ItemTotalPrice, $ItemPriceBeforeVAT);

						 $em->createInvoice($EMPLOYER_ID, BASE_URL . 'uploads/invoices/' . $invoice_filename . '.pdf');
					     
					     // grant access for employer
					     $em->grantCvdbAccess($EMPLOYER_ID);
						
						 unset($_SESSION['ItemName']); unset($_SESSION['ItemTotalPrice']);
						 unset( $_SESSION['ItemPrice']); unset($_SESSION['ItemNumber']);
						 unset($_SESSION['ItemDesc']); unset($_SESSION['ItemQty']);
						 unset($_SESSION['PAYPAL_EMPLOYER_ID']); unset($_SESSION['ItemPriceBeforeVAT']);
						 
						 $_SESSION['PAYPAL_RESULT_MESSAGE'] = $result_msg;
						 redirect_to(BASE_URL . URL_DASHBOARD . '/' . URL_DASHBOARD_CVDATABASE . '/granted');
					}

				} else  {
					$smarty->assign('msg', $translations['paypal']['paypal_err_msg'] . ' (' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . ')');
					$smarty->assign('view', 'paypal-error.tpl');
					$template =  'dashboard/dashboard.tpl';
					return;
				}
	
	}else{
			$smarty->assign('msg', $translations['paypal']['paypal_err_msg'] . ' (' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . ')');
			$smarty->assign('view', 'paypal-error.tpl');
			$template = 'dashboard/dashboard.tpl';
			return;
	}
}

exit;

?>
