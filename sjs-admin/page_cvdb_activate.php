<?php
	$id = $_POST['emp_id'];
	$class = new Employer();
	$class->grantCvdbAccess($id);
	echo 1;
	exit;
?>