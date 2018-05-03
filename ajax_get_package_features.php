<?php 

require_once '_config/config.php';
global $db;

if (isset($_POST['package_id'])) {

	$sql = 'SELECT * FROM packages WHERE id =' . intval($_POST['package_id']); 
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$price = intval($row['price']);
	
	if (VAT_KOEFICIENT != 0) {

		$price_vat_total = format_currency(WEBSITE_CURRENCY, $price + ($price * VAT_KOEFICIENT));
		$price_vat = format_currency(WEBSITE_CURRENCY, $price * VAT_KOEFICIENT);

	} 

	$price_formatted = format_currency(WEBSITE_CURRENCY, $price);

	echo json_encode(array('data' => $row, 'price' => $price_formatted, 'vat' => $price_vat, 'price_vat' => $price_vat_total));
	exit;
}
exit;

?>