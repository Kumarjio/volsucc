<?php

//$id ~ hash
$class = new Applicant();
$result = $class->confirmUser($id);
$applicant_email = $class->getEmail();
$APPLICANT_ID = $class->getIdByEmail($applicant_email);

$mailer = new Mailer();
$mailer->applicantRegisteredWelcome($applicant_email);

if ($APPLICANT_ID != NULL && !empty($APPLICANT_ID))
	$class->updateApplicantActivity(1, $APPLICANT_ID);

// confirm subscription
Subscriber::confirmSubscriberByEmail($applicant_email);

//set status
$smarty->assign('confirm_result', $result);
$template = 'auth/applicant-confirmation.tpl';

?>