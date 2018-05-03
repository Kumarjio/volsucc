<?php 
	$class->invoicesSeen($_SESSION['user']); //remove notification
	$invoices = $class->getInvoicesByEmployerId($_SESSION['user']);
	$smarty->assign('invoices', $invoices);
?>