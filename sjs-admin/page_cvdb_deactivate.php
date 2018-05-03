<?php
	$id = $_POST['emp_id'];
	$class = new Employer();
	$class->removeCvdbAccess($id);
	echo 1;
	exit;
?>