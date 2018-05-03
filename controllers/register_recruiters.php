<?php

	$smarty->assign('PLAIN_SITE_REGISTER', true);

	$captcha_enabled = ENABLE_RECAPTCHA;
	if ($captcha_enabled) {
		$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
		$token  = "";	
	}
	$smarty->assign('ENABLE_RECAPTCHA', $captcha_enabled);

	if (isset($_POST['step'])) {
		if ($_POST['step'] == "1") {

				if ($captcha_enabled) {
					if (!strcmp(sha1($_POST['captcha']), $_SESSION['encryptedToken']) == 0) {
						$smarty->assign('response_msg', $translations['contact']['captcha_err']);
						$smarty->assign('captcha_err', true);
						//generate new captcha and destroy old one
						unset($_SESSION['encryptedToken']);
						for( $i = 1; $i <= 6 ; $i++ )
						{
							$token .= $pattern{rand( 0, 35 )};
						}
						$encryptedToken = sha1( $token );

						// save the $encryptedToken in the session
						$_SESSION['encryptedToken'] = $encryptedToken;
						$rawCaptchaBytes =  base64_encode(simple_php_captcha($token));

						$the_captcha = str_replace('{RAW}', $rawCaptchaBytes, recaptcha_get_html());
						$the_captcha = str_replace('{CAPTCHA_LABEL}', $translations['captcha']['captcha_label'], $the_captcha);
						$smarty->assign('captcha_html', $the_captcha);
						$template = 'auth/register-recruiters.tpl';
						return;
					}

				}

				//create employer, show second step form
				$class = new Employer();
				//check location/IP address. From one IP address we dont want multiple accounts
				$ip = get_client_ip();

				$name = $db->getConnection()->real_escape_string(trim($_POST['register_name']));
				$email = $db->getConnection()->real_escape_string(trim($_POST['register_email']));
				$password = md5(trim($_POST['register_pass1']));

				$confirmed = 0; //by default not confirmed. need to approve a hash sent via email

				$data = array('name' => $name, 'email' => $email, 'password' => $password,
				'confirmed' => $confirmed, 'ip' => $ip);

				//enter employer and his hash data
				$hash = sha1($email . time());
				$exists = $class->checkIfUserExists($email);
				//create entry if this email doesnt exist yet but check ip
					if (ENABLE_SINGLE_ACCOUNT_REGISTRATION == 'enabled') {
							if (!$exists) {
								//check if user has not some other account!
								if ($class->userIpIsAlreadyRegistered($ip)) {
									$em = $class->getEmail();
									$msg = str_replace('{email}', $em, $translations['registration']['ip_multiple_err']);
									$smarty->assign('msg', $msg);
									$template = 'err/ip-already-registered.tpl';
									return;
								}	
							}
					}

					// if already exists but is not unconfirmed - update
					if ($class->checkIfEmailExists($email)) {
						$class->updateEntry($data, $hash);
						$smarty->assign('updatingEntry', true);
					} else {
						// if does not exist - create new entry 
						$class->createEntry($data, $hash); 
						$smarty->assign('updatingEntry', false);
					}

					//asign id of employer to the template
					$smarty->assign('second_step', true);
					$smarty->assign('employer_id', $class->getId());
					$smarty->assign('employer_hash', $hash);
					$smarty->assign('employer_email', $email);
					$template = 'auth/register-recruiters.tpl';

			} else if ($_POST['step'] == "2") {

				if (!empty($_FILES["company_logo"]['tmp_name'])) {
					$newNamePrefix = time() . '_';
					$manipulator = new ImageManipulator($_FILES['company_logo']['tmp_name']);

					$size = getimagesize($_FILES["company_logo"]['tmp_name']);
					$fileType = $size[2];
					if ($size[0] > 200) {
						//needs a resize
				        $newImage = $manipulator->resample(200, 200);		        
					}
					$final_path = COMPANIES_UPLOAD_FOLDER . $newNamePrefix . $_FILES['company_logo']['name'];
					$manipulator->save($final_path, $fileType);
				} else {
					$final_path = DEFAULT_LOGO_PATH;
				}

				//also if error use default image
				if (!empty($_FILES['company_logo']['error'])) {
					$final_path = DEFAULT_LOGO_PATH;
				}

				$employerClass = new Employer();
				//get employer id, get his mail, send confirmation mail, create company entry
				escape($_POST);
				$EMPLOYER_ID = $employerid;
				$company = new Company();
				if (isset($employerid)) {
						$data = array('company_name' => $company_name, 'company_desc' => $company_desc, 
						  'company_hq' => $company_hq,  'company_url' => $company_url, 
						   'employer_id' => $EMPLOYER_ID, 'logo_path' => $final_path, 'company_street' => $company_street,
						   'company_citypostcode' => $company_citypostcode);
				}

				// if already exists but is not unconfirmed - update
				if ($updatingEntry) {
					$company->updateEntry($data); 
				} else {
					// if does not exist - create new entry 
					$company->createCompany($data);
				}

				$eemail = $employer_email;

				$mailer = new Mailer();
				$result = $mailer->sendConfirmationEmail($eemail, $employer_hash);
				if (!$result) {
					require_once 'page_more_content.php';
					$msg = str_replace('{EMAIL}', $email, $translations['website_general']['email_not_sent']);
					$smarty->assign('error_msg', $msg);
					$template = 'err/err-general.tpl';
					return;
				} 

				$confirm_msg = str_replace('{email}', $eemail, $translations['registration']['registration_done_message']);
				$smarty->assign('msg', $confirm_msg);

				$_SESSION['user'] = $EMPLOYER_ID;
				redirect_to(BASE_URL . dashboard);
				
			} 
	} else {

		if ($captcha_enabled) {
			for( $i = 1; $i <= 6 ; $i++ ) {
				$token .= $pattern{rand( 0, 35 )};
			}
			$encryptedToken = sha1( $token );

			// save the $encryptedToken in the session
			$_SESSION['encryptedToken'] = $encryptedToken;
			$rawCaptchaBytes =  base64_encode(simple_php_captcha($token));

			$the_captcha = str_replace('{RAW}', $rawCaptchaBytes, recaptcha_get_html());
			$the_captcha = str_replace('{CAPTCHA_LABEL}', $translations['captcha']['captcha_label'], $the_captcha);
			$smarty->assign('captcha_html', $the_captcha);
		}
		$smarty->assign('ENABLE_RECAPTCHA', $captcha_enabled);

		//first initial open
		$template = 'auth/register-recruiters.tpl';
	}
	
?>
