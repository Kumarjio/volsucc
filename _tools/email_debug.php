	<?php

	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    MIT
     * @website    simplejobscript.com
	 * 
	 */

	/*
	 EMAIL TEMPLATE DEBUGING CLASS. EMAIL AND TEXT IS HARDCODED
	*/

	$m = new Mailer();

	$EMAIL = 'your.email@provider.com';
	$HASH = 'abchash';

	// # application email to applicant
	$job_data = array();
	$job_data['id'] = "99";
	$job_data['title'] = "PHP Developer";
	$job_data['company'] = "Microsoft";
	$job_data['url_title'] = "php-developer-at-microsoft";
	$m->sendAppliedEmail($job_data, $EMAIL);
	// #########

	// # registration confirmation
	$m->sendConfirmationEmail($EMAIL, $HASH);
	// #########

	// # contact email
	$m->sendContactEmail('John Goodman', 'john.good@gmail.com', 'Contact message');
	// ##################

	// # APPLICATION FOR EMPLOYER JOB
	$job = array();
	$job['title'] = "Zend Developer";
	$app = array();
	$app['name'] = "John Goodman";
	$app['phone'] = "4498743214";
	$app['email'] = "john@gmail.com";
	$app['skills'] = "#php #html #css";
	$app['location'] = "London";
	$app['website'] = "www.john.com";
	$app['message'] = "I need to work";

	$m->sendEmployerNewApplicationEmail($app, $job, $EMAIL);
	// #########################

	// # goodbye subscriber email
	$m->sendGoodbyeSubscriberMail($EMAIL);
	// ##################

	// # password recovery email
	$m->sendPasswordRecoveryEmail($EMAIL, $HASH, URL_RESET_PASSWORD_APPLICANTS);
	// ########

	// # user job published / activated email
	$data = array('id' => 35, 'url_title' => 'wp-designer', 'title' => 'WP Designer');
	$m->employerJobActivated($data, MAIN_URL, $EMAIL);
	// #####################

	// # Subscriber not confirmed email
	$m->subscriberNotConfirmedEmail($EMAIL, $HASH);
	// ###############

	// # Subscription updated
	$m->subscriptionUpdated($EMAIL);
	// ###############

	// # Tell a friend
	$m->tellAFriend($EMAIL, $EMAIL, 'Hey. Checkout this job !');
	// ##############

	// # welcome subscriber
	$m->welcomeSubscriber($EMAIL, $HASH);
	// ##############

	// # welcome subscriber
	$m->applicantRegisteredWelcome($EMAIL);
	// ##############

	$m->notifyDeletedCandidate($EMAIL, 'John');


	$m->reviewCandidateApplication($EMAIL, $job_data);


	$m->rejectCandidateApplication($EMAIL, $job_data);

	echo "Emails have been sent";
	die();

	?>