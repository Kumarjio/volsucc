<?php
	
	$smarty->assign('LOAD_TAGL', true);

	// get SM profiles
	$sm_profiles = $job->getSMprofiles();
	$smarty->assign('SM_PROFILES', $sm_profiles);

	global $db;
	$cl = new Applicant();
	$applicant = $cl->getDataByIdForProfile($_SESSION['applicant']);
	$skills_arr = explode(",", $applicant['skills']);
	
	$smarty->assign('skills_arr', $skills_arr);
	$smarty->assign('profile', $applicant);

	$subs_data = $cl->getSubscriptionDetailsByEmail($applicant['email']);
	$smarty->assign('subs_data', $subs_data);

	if (!empty($id)) {
		switch($id){
			case URL_PROFILE_EDIT:
				$smarty->assign('TAGL_INIT_PROFILE_EDIT', true);
				$explode = explode(".",$applicant['cv_path']);
				if (strcmp(end($explode), "pdf") == 0) {
					$smarty->assign('img_path', "fa fa-file-pdf-o fa-lg pdf-el");
				} else {
					$smarty->assign('img_path', "fa fa-file-word-o fa-lg word-el");
				}

				$applicant['message'] = convertLineBreaks($applicant['message']); 

				$smarty->assign('applicant', $applicant);
				$smarty->assign('ACTIVE', $PROFILE_ROUTING[URL_PROFILE_EDIT]);
				$smarty->assign('title', $translations['profile']['edit_profile']);
			break;
			case 'profile-edited':
				$smarty->assign('TAGL_INIT_PROFILE_EDIT', true);
				escape($_POST);
				$flag = (isset($public_profile)) ? 1 : 0;

				$subs_flag = (isset($subscription_flag)) ? 1 : 0;

				$cl->updateSubscription($applicant['email'], $subs_flag);

				//new cv. upload file and save the path
				if (!empty($_FILES["applicantCv"]['tmp_name'])) {
						$f = pathinfo($_FILES['applicantCv']['name']);
						$f_rename = pathinfo(cleanString($_FILES['applicantCv']['name']));

						$UID = uniqid();
						$basefilename = $f_rename['filename'] . '_' . $UID;
						$filename = $basefilename . '.' . $f['extension'];

						$suffix = 0;
						while (file_exists(FILE_UPLOAD_DIR . $filename)) {
							$suffix++;
							$filename = $basefilename . '_' . $suffix . '.' . $f['extension'];
						}

						if (move_uploaded_file($_FILES['applicantCv']['tmp_name'], FILE_UPLOAD_DIR . $filename))
						{
							// uploading new CV and has hold already? remove the old file
							if (strlen($applicant['cv_path']) > 1 && file_exists($DIR_CONST .  '/../' . $applicant['cv_path'])) {
								try {
									unlink($DIR_CONST .  '/../' . $applicant['cv_path']);
								} catch (Exception $e) {}
							}

							$cv_path = FILE_UPLOAD_DIR . $filename;
						}
						else
						{
							$cv_path = $currentCv;
						}

						if (!empty($_FILES['applicantCv']['error'])) {
							$cv_path = $currentCv;
						}

					} else {
					//cv path not updated
					$cv_path = $currentCv;
				}
				chmod($cv_path, 0777);

				$skills = tagglesToString($taggles);

				$sm_links = array();

				if (isset($sm_url_1) && $sm_url_1 != "") {
					$obj1 = constructSMlink($sm_url_1, $sm_select_1);
					$sm_links["first"] = $obj1;
				} else {
					$sm_links["first"] = "-";
				}

				if (isset($sm_url_2) && $sm_url_2 != "") {
					$obj2 = constructSMlink($sm_url_2, $sm_select_2);
					$sm_links["second"] = $obj2;
				} else {
					$sm_links["second"] = "-";
				}

				if (isset($sm_url_3) && $sm_url_3 != "") {
					$obj3 = constructSMlink($sm_url_3, $sm_select_3);
					$sm_links["third"] = $obj3;
				} else {
					$sm_links["third"] = "-";
				}

				if (isset($sm_url_4) && $sm_url_4 != "") {
					$obj4 = constructSMlink($sm_url_4, $sm_select_4);
					$sm_links["fourth"] = $obj4;
				} else {
					$sm_links["fourth"] = "-";
				}

				$data = array("fullname" => $fullname, "occupation" => $occupation, "phone" => $phone, "location" => $location, "message" => $msg, "weblink" => $weblink, "skills" => $skills, "public_profile" => $flag, "cv_path" => $cv_path, "sm_links" => $sm_links);
				$cl->updateApplicant($data, $applicant['id']);
				$smarty->assign('msg', $translations['profile']['profile_edited']);
				$smarty->assign('title', $translations['profile']['op_success']);
				$smarty->assign('ACTIVE', 'success');

			break;
			case URL_PROFILE_APPLICATIONS:
				$applications = $cl->getJobApplicationsById($applicant['id']);
				$smarty->assign('apps', $applications);
				$smarty->assign('ACTIVE', $PROFILE_ROUTING[URL_PROFILE_APPLICATIONS]); 
				$smarty->assign('title', $translations['profile']['recent_applications']);
			break;
			case URL_PROFILE_CHANGEPASSWORD:
				$smarty->assign('ACTIVE', $PROFILE_ROUTING[URL_PROFILE_CHANGEPASSWORD]); 
				$smarty->assign('title', $translations['profile']['passchange']);
			
			break;
			case URL_PROFILE_DELETE:
				$smarty->assign('ACTIVE', $PROFILE_ROUTING[URL_PROFILE_DELETE]); 
				$smarty->assign('title', $translations['profile']['delete_acc_label']);
			break;
			case 'logout':
				unset($_SESSION['applicant']); $_SESSION['applicant'] = null;
				unset($_SESSION['applicant_name']); $_SESSION['applicant_name'] = null;
				redirect_to(BASE_URL);
			break;
			case 'pass-edited':
				escape($_POST);
				$sql = 'UPDATE '.DB_PREFIX.'applicant SET password = "' . md5(trim($pass1)) . '" WHERE id =' . intval($applicant['id']);
				$db->query($sql);
				$smarty->assign('msg', $translations['profile']['pass_changed']);
				$smarty->assign('title', $translations['profile']['op_success']);
				$smarty->assign('ACTIVE', 'success');

			break;
			case 'deleteacc':
				//remove from subscribers
				$sql = 'SELECT auth FROM '.DB_PREFIX.'subscribers WHERE email = "' . $applicant['email'] . '"';
				$result = $db->QueryRow($sql);
				if (!empty($result)) {
					Subscriber::unsubscribe($result['auth']);
				}
				//delete all his applications
				$cl->removeJobApplicationsById($applicant['id']);
				//delete applicant himself
				$cl->deleteApplicant($applicant['id']);
				//send goodbye email - todo in next version
				//send home
				unset($_SESSION['applicant']); $_SESSION['applicant'] = null;
				unset($_SESSION['applicant_name']); $_SESSION['applicant_name'] = null;
				redirect_to(BASE_URL . 'deactivation-successful');
			break;

			default:
				$smarty->assign('ACTIVE', '404');
				$smarty->assign('title', 'Page does not exist');
			break;
		}

	} else { //default route
		$applications = $cl->getJobApplicationsById($applicant['id']);
		$smarty->assign('apps', $applications);
		$smarty->assign('ACTIVE', $PROFILE_ROUTING[URL_PROFILE_APPLICATIONS]); 
		$smarty->assign('title', $translations['profile']['recent_applications']);
	}

	$smarty->assign('seo_title', SEO_APPLICANT_DASHBOARD_TITLE . ' - ' . $applicant['fullname']);
	$smarty->assign('seo_desc', SEO_APPLICANT_DASHBOARD_DESCRIPTION);
	$smarty->assign('seo_keys', SEO_APPLICANT_DASHBOARD_TITLE . ', ' . $applicant['fullname']);
	$template = 'profile/profile.tpl';
?>
