<?php 

escape($_POST);
$job = new Job();

if (REMOTE_PORTAL == 'deactivated' && isset($location_select))
	$city_id = intval($location_select);
else
	$city_id = 1;

$apply_online = (isset($apply_online_switch)) ? 1 : 0;

$HOW_TO_APPLY = $db->getConnection()->real_escape_string($_POST['howtoapply']);

$data = array(
	"type_id" => intval($type_select),
	"job_id" => intval($job_id),
	"category_id" => intval($cat_select),
	"title" => $title,
	"salary" => $salary,
	"description" => $db->getConnection()->real_escape_string($_POST['description']), //keed the tinymce characters
	"city_id" => $city_id,
	"apply_online" => $apply_online,
	"apply_desc" => $HOW_TO_APPLY
);

$result = $job->Edit($data);

//substract employer account info
if ($result) {
	//show success
	$smarty->assign('msg', $translations['dashboard_recruiter']['editjob_success']);
	$smarty->assign('view', 'success.tpl');
} else {
	//failure
	$smarty->assign('msg', $translations['dashboard_recruiter']['general_err']);
	$smarty->assign('view', 'error.tpl');
}

$template = 'dashboard/dashboard.tpl';

?>