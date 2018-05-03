<?php

class Mailer extends Translator {
	private $_mailer = null; 

	function __construct(){
		parent::__construct(LANG_CODE);
		$this->_mailer = $this->getConfiguredMailer();
	}

	private function getEmailData($section, $replace=array())
	{
		$e = $this->translations[$section];
		$subject = $e['subject'];
		$message = $e['message'];

		if (is_array($replace) && !empty($replace))
		{
			foreach ($replace as $search_for => $replace_with)
			{
				$subject = str_replace('{' . $search_for . '}', $replace_with, $subject);
				$message = str_replace('{' . $search_for . '}', $replace_with, $message);
			}
		}

		return array('subject' => $subject, 'message' => $message);
	}

	public function sendAppliedEmail($job_data, $email){
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'JOB_TITLE' => $job_data['title'],
			'COMPANY' => $job_data['company']
		);
		$translated = $this->getEmailData('email_Applied', $replace);

		return $this->_email($email, $translated);

	}

	public function reviewCandidateApplication($candidate_email, $job_data) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'JOB_URL' => PROTOCOL . MAIN_URL . URL_JOB ."/" . $job_data['id'] . "/" . $job_data['url_title'] . "/",
			'JOB_TITLE' => $job_data['title'],
			'COMPANY' => $job_data['company']
		);
		$translated = $this->getEmailData('email_ReviewApplicant', $replace);

		return $this->_email($candidate_email, $translated);
	}

	public function rejectCandidateApplication($candidate_email, $job_data) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'JOB_URL' => PROTOCOL . MAIN_URL . URL_JOB ."/" . $job_data['id'] . "/" . $job_data['url_title'] . "/",
			'JOB_TITLE' => $job_data['title'],
			'COMPANY' => $job_data['company']
		);
		$translated = $this->getEmailData('email_RejectApplicant', $replace);

		return $this->_email($candidate_email, $translated);
	}
	
	public function applicantRegisteredWelcome($email) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'URL_PROFILE' => URL_PROFILE
		);
		$translated = $this->getEmailData('email_WelcomeApplicant', $replace);

		return $this->_email($email, $translated);
	}

	public function employerJobActivated($data, $url, $employer_email) {

		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'JOB_URL' => $url . URL_JOB ."/" . $data['id'] . "/" . $data['url_title'] . "/",
			'JOB_TITLE' => $data['title'],
			'JOB_MANAGE_URL' => $url . URL_DASHBOARD . "/" . URL_DASHBOARD_JOBS,
			'JOB_APPLICANTS_URL' => $url . URL_DASHBOARD . "/" . URL_DASHBOARD_APPLICATIONS,
			'STATISTICS_URL' => $url . URL_DASHBOARD . "/" . URL_DASHBOARD_STATISTICS
		);
		$translated = $this->getEmailData('email_PublishToUser', $replace);

		return $this->_email($employer_email, $translated);
	}

	public function applicantVerificationEmail($email, $hash) {
 		$replace = array(
 			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
 			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
 			'URL_APPLICANT_ACCOUNT_CONFIRMATION' => URL_APPLICANT_ACCOUNT_CONFIRMATION,
 			'HASH' => $hash
 		);
 
 		$translated = $this->getEmailData('email_confirmationRequestApplicant', $replace);
 
 		return $this->_email($email, $translated);
 	}

	public function sendEmployerNewApplicationEmail($application, $job, $email){

		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'JOB_ROLE' => $job['title'],
			'NAME' => $application['name'],
			'OCCUPATION' => $application['occupation'],
			'EMAIL' => $application['email'],
			'PHONE' => $application['phone'],
			'LOCATION' => $application['location'],
			'SKILLS' => $application['skills'],
			'PORTFOLIO' => $application['website'],
			'MSG' => $application['message'],
			'MANAGE_URL' => PROTOCOL . MAIN_URL . URL_DASHBOARD . '/' . URL_DASHBOARD_APPLICATIONS
		);
		$translated = $this->getEmailData('email_EmployerNewApplication', $replace);

		if (strlen($application['cv_path']) != 0 && !empty($application['cv_path']))
			return $this->_emailWithAttachment($email, $translated, $application['cv_path']);
		else 
			return $this->_email($email, $translated);
	}

	public function sendContactEmail($name, $from_email, $msg) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'NAME' => $name,
			'EMAIL' => $from_email,
			'INNER_EMAIL' => $from_email,
			'MSG' => $msg
		);

		$translated = $this->getEmailData('email_contactEmail', $replace);
		return $this->_email(ADMIN_EMAIL, $translated);
	}

	public function tellAFriend($from, $to, $msg) {

		$subject = $this->translations['email_tellAfriend']['subject'];

		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'MSG' => $msg,
			'FROM' => $from
		);

		$translated = $this->getEmailData('email_tellAfriend', $replace);

		try {
			// Create a message
			$message = Swift_Message::newInstance($subject)
			  ->setFrom(array($from))
			  ->setTo(array($to))
			  ->setReplyTo($from)
			  ->setContentType("text/html")
			  ->setBody($translated['message']);

		  	$result = $this->_mailer->send($message);
		  } catch (Exception $e) {
		  	if (ENVIRONMENT == 'dev')
			{
				var_dump($e->getMessage()); die();
			}
			return false;
		  }
		  return true;
	}

	public function notifyDeletedCandidate($email, $name) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'CANDIDATE_NAME' => $name
		);

		$translated = $this->getEmailData('email_notifyDeletedCandidate', $replace);
 
 		return $this->_email($email, $translated);
	}

	public function sendPasswordRecoveryEmail($email, $hash, $reset_url) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'RESET_URL' => $reset_url,
			'HASH' => $hash
		);

		$translated = $this->getEmailData('email_passwordRecovery', $replace);
		return $this->_email($email, $translated);
	}

	public function subscriptionUpdated($email, $hash) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'MANAGE_URL' => processUrlForEmail(MAIN_URL),
			'URL_SUBSCRIBE' => URL_SUBSCRIBE,
			'URL_UNSUBSCRIBE' => URL_UNSUBSCRIBE,
			'HASH' => $hash
		);	
		$translated = $this->getEmailData('email_SubscriptionUpdated', $replace);
		return $this->_email($email, $translated);	
	}

	public function subscriberNotConfirmedEmail($email, $hash) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'URL_SUBSCRIBE_CONFIRMATION' => URL_SUBSCRIBE_CONFIRMATION,
			'HASH' => $hash
		);	

		$translated = $this->getEmailData('email_subscriberNotConfirmedEmail', $replace);
		return $this->_email($email, $translated);	
	}


	public function sendGoodbyeSubscriberMail($email) {
		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'URL_SUBSCRIBE' => URL_SUBSCRIBE
		);	

		$translated = $this->getEmailData('email_goodbyeSubscriber', $replace);
		return $this->_email($email, $translated);	
	}

	public function welcomeSubscriber($email, $hash) {

		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'URL_SUBSCRIBE_CONFIRMATION' => URL_SUBSCRIBE_CONFIRMATION,
			'URL_SUBSCRIBE' => URL_SUBSCRIBE,
			'HASH' => $hash
		);	

		$translated = $this->getEmailData('email_welcomeSubscriber', $replace);

		return $this->_email($email, $translated);
	}

	public function sendConfirmationEmail($email, $hash) {

		$replace = array(
			'BASE_URL' => processUrlForEmailTrimEnd(MAIN_URL),
			'BASE_URL_LINK' => processUrlForEmail(MAIN_URL),
			'URL_RECRUITER_ACCOUNT_CONFIRMATION' => URL_RECRUITER_ACCOUNT_CONFIRMATION,
			'HASH' => $hash
		);

		$translated = $this->getEmailData('email_confirmationRequest', $replace);

		return $this->_email($email, $translated);
	}

	public function notifyPaypalPendingTransaction($transaction_id, $employer_id, $job_id) {
		$translated = array();
		$translated['subject'] = "Paypal payment - new pending transaction";
		$translated['message'] = "TRANSACTION ID: " . $transaction_id . " EmployerId: " . $employer_id . " Job id: " . $job_id;
		return $this->_email(ADMIN_EMAIL, $translated);
	}

	private function _email($email, $translated) {

		try {
			// Create a message
			$message = Swift_Message::newInstance($translated['subject'])
			  ->setFrom(array(ADMIN_EMAIL => MAILER_SENT_FROM))
			  ->setTo(array($email))
			  ->setContentType("text/html")
			  ->setBody($translated['message']);

		  	$result = $this->_mailer->send($message);

		  } catch (Exception $e) {
		  	if (ENVIRONMENT == 'dev')
			{
				var_dump($e->getMessage()); die();
			}
			return false;
		  }
		  return true;
	}

	private function _emailWithAttachment($email, $translated, $attachment) {

		$var = explode("/", $attachment);
		$attachment_name = end($var);

		if (!file_exists(PATH_PREFIX . $attachment))
			$PATH = $attachment;
		else
			$PATH = PATH_PREFIX . $attachment;

		try {
			// Create a message
			$message = Swift_Message::newInstance($translated['subject'])
			  ->setFrom(array(ADMIN_EMAIL => MAILER_SENT_FROM))
			  ->setTo(array($email))
			  ->setContentType("text/html")
			  ->attach(Swift_Attachment::fromPath($PATH)->setFilename($attachment_name))
			  ->setBody($translated['message']);

		  	$result = $this->_mailer->send($message);
		  } catch (Exception $e) {
		  	if (ENVIRONMENT == 'dev')
			{
				var_dump($e->getMessage()); die();
			}
			return false;
		  }
		  return true;
	}

	private function getConfiguredMailer()
	{
		global $settings;

		if(strtolower(SMTP_CLIENT) == 'enabled')
		{
			$transporter = Swift_SmtpTransport::newInstance($settings['mailer_smtp_host'], $settings['mailer_smtp_port'], $settings['mailer_smtp_secure_connection_prefix'])
			 ->setUsername($settings['mailer_smtp_username'])
			 ->setPassword($settings['mailer_smtp_password']);

			$mailer = Swift_Mailer::newInstance($transporter);
			//for bulk emails. send 20 emails then wait for 20 seconds
			$mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(20, 20));

		} else {
			$transport = Swift_MailTransport::newInstance();
			$mailer = Swift_Mailer::newInstance($transport);
		}

		return $mailer;
	}

	/* newsletter sending from cron */
	public function sendBulkEmail($emails) {
		global $db;
		//get template
		$replace = array(
			'WEBSITE' => processUrlForEmail(PROTOCOL_URL),
			'URL_UNSUBSCRIBE' => URL_UNSUBSCRIBE,
			'BASE_URL' => PROTOCOL_URL,
			'BASE_URL_JOBS' => PROTOCOL_URL . URL_JOBS
		);

		$html = $this->getEmailData('email_weeklyNewsletter', $replace);
		//------------------------------------------------------------

		// Create a message
		$message = Swift_Message::newInstance($html['subject'])
		  ->setFrom(array(ADMIN_EMAIL => MAILER_SENT_FROM));

		$failedRecipients = array();
		$numSent = 0;

		foreach ($emails as $email => $job_ids)
		{

			$dynamicHtml = '';
			foreach ($job_ids as $id) {
				$job = new Job($id);
				$data = $job->GetInfo();
				$job_template = $this->translations['email_weeklyNewsletter']['jobtpl'];
				//$IMG_PATH = BASE_URL . $data['company_logo_path'];

				$IMG_PATH = PROTOCOL_URL . rawurlencode($data['company_logo_path']);
	
				//replace with real content
				$replaced = str_replace('{JOB_TITLE}', $data['title'], $job_template);
				$replaced = str_replace('{JOB_DESC}', strip_tags($data['description_short']), $replaced);
				$replaced = str_replace('{JOB_LOGO}', $IMG_PATH, $replaced);
				$replaced = str_replace('{JOB_URL}', $data['full_url'], $replaced);
				
				$dynamicHtml .= $replaced;

			}

		  $ss = 'SELECT auth FROM '.DB_PREFIX.'subscribers WHERE email = "' . $email . '"';
		  $partialResult = $db->QueryRow($ss);

		  $html_final = str_replace('{JOBS_CONTENT}', $dynamicHtml, $html['message']);
		  $html_final = str_replace('{HASH}', $partialResult['auth'], $html_final);

			
		  echo "SENDING EMAIL TO: " . $email . "\r\n";
		  
		  $message->setTo(array($email));
		  $message->setContentType("text/html");
		  $message->setBody($html_final);

		  try {
		  	 $result = $this->_mailer->send($message);
		  	 if ($result) {
		  	 	//remove from the queue
		  	 	$sql = 'DELETE FROM '.DB_PREFIX.'email_queue WHERE email = "' . $email . '"';
		  	 	$res = $db->query($sql);
		  	 	echo "EMAIL SUCCESSFULY SENT AND DELETED FROM QUEUE: " . "\r\n";
		  	 }
		  } catch (Exception $e) {
		  	echo $e->getMessage();
		  }
		  echo "----------------------------------------------------------"  . "\r\n";
		}
	}

}