<?php 

require_once '_config/config.php';
global $db;

if (isset($_POST['emp_id'])) {

	$EID = intval($_POST['emp_id']);

	$sql = 'SELECT cv_downloads_left as "cdl" FROM employer WHERE id =' . $EID; 
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$new_cdl = intval($row['cdl']) - 1;

	$s = 'UPDATE employer SET cv_downloads_left = ' . $new_cdl . ' WHERE id =' . $EID;
	$db->query($s);

	exit;
}
exit;

?>