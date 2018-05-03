<?php 

  /**
   * Simplejobscript Copyright (©) 2016 Niteosoft
   *
   * @author     Niteosoft
   * @license    MIT
   * 
   */

  require_once '../_config/cron_config.php';
  global $db;

  //parse params
  $params = explode(",", $argv[1]);

  $data = array(
	"job_id" => $params[0],
	"name" => $params[2],
	"email" => $params[1], //im already sending this
	"phone" => $params[3],
	"message" => $params[4],
	"website" => $params[5],
	"cv_path" => $params[6],
	"ip" => $params[7]
  );

  $public_profile = trim($params[8]);

  $mailer = new Mailer();
  $employer = new Employer(); 

  $job = new Job($params[0]);
  $job_info = $job->GetInfo();
  $employer_data = $employer->getEmployerById($job_info['employer_id']);

  //create new dashboard notification for employer
  $employer->createNotification($job_info['employer_id']);

  //applicant email
  $mailer->sendAppliedEmail($job_info, $params[1]);

  //employer email
  $mailer->sendEmployerNewApplicationEmail($data, $job_info, $employer_data['email']);

 if (intval($public_profile) == 1) { 
    //send welcome email
    $mailer->applicantRegisteredWelcome($params[1]);
 }

  exit;
?>