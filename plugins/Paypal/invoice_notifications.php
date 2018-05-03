<?php 

//check for new invoices
$unseen_invoices = $class->checkInvoiceNotifications($_SESSION['user']);
if (intval($unseen_invoices['new_invoices']) > 0){
	$smarty->assign('NEW_INVOICE', true);
	$smarty->assign('new_invoice_msg', $translations['dashboard_recruiter']['new_invoice_text']);
}
if (intval($unseen_invoices['any_invoices']) > 0){
	$smarty->assign('SHOW_INVOICE_MENU', true);
}

?>