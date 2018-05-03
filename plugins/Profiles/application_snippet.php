<?php 
//user already exists, fetch his info from db
$cl = new Applicant();

//session active?
if (isset($_SESSION['applicant'])) {
	$applicant = $cl->getDataById($_SESSION['applicant']); //get applicant profile

	$APPLICANT_ID = $applicant['id'];
	$ERROR = FALSE;

} else {
	if ($cl->authenticate($apply_email_existing, md5(trim($apply_pass_existing)))) {

		$applicant = $cl->getData();

		if (!$cl->isConfirmed($applicant['id'])) {
 			$ERROR = TRUE;
 		} else {
 			//set session
 			$_SESSION['applicant'] = $applicant['id'];
 			$APPLICANT_ID = $applicant['id'];
 			$_SESSION['applicant_name'] = $applicant['fullname'];
 		}
	} else {
		//application did not proceed
		$ERROR = TRUE;
	}
}
//for both flows
$data = array(
	"job_id" => $job_id,
	"name" => $applicant['fullname'],
	"occupation" => $applicant['occupation'],
	"email" => $applicant['email'],
	"phone" => $applicant['phone'],
	"location" => $applicant['location'],
	"message" =>  stripLineBreaks($applicant['message']),
	"shell_message" => strip_tags($applicant['message']), 
	"website" => $applicant['weblink'],
	"skills" => $applicant['skills'],
	"cv_path" => $applicant['cv_path'],
	"public_profile" => $public_profile,
	"password" => "123",
	"ip" => $ip,
	"sm_links" => $applicant['sm_links']
);	
?>