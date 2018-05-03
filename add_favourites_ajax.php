<?php 

require_once '_config/config.php';
//global $db;

if (isset($_POST['job_id'])) {
	array_push($_SESSION['favourites'], $_POST['job_id']);
	exit;
}
exit;

?>