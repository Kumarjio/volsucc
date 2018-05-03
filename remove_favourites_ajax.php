<?php 

require_once '_config/config.php';
//global $db;

if (isset($_POST['job_id'])) {
	foreach($_SESSION['favourites'] as $k => $v) {
	  if($v == $_POST['job_id'])
	    unset($_SESSION['favourites'][$k]);
	}
	exit;
}
exit;

?>