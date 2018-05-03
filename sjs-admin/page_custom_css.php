<?php 

	global $db;
	
	if (isset($_POST['cssarea'])) {

		$sql = 'UPDATE '.DB_PREFIX.'css SET cssarea="' . $_POST['cssarea'] . '" WHERE id=1';
		$result = $db->query($sql);
		$smarty->assign('updated', true);
	}

	$sql = 'SELECT * FROM '.DB_PREFIX.'css WHERE id=1';
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$smarty->assign('data', $row['cssarea']);
	$template = 'custom-css.tpl';
?>