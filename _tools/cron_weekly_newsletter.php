<?php

	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    MIT
	 * @website    simplejobscript.com
	 */

	require_once '../_config/cron_config.php';

	$EMAILS_IN_BATCH = 23;
	echo "******* STARTING WEEKLY NEWSLETTER JOBS CRONJOB *********". "\r\n";
	echo "DATE and TIME : " . date('Y-m-d H:i:s') . "\r\n";
	$class = new Newsletter();
	$class->createQueue();

	global $db;
	$sql = 'SELECT email FROM '.DB_PREFIX.'email_queue limit ' . $EMAILS_IN_BATCH;

	//send 90 emails daily, 23 emails every 6 hours
	//for example Google limits smtp requests for transactional emails to 100 per day. So here
	//we keep the limit and send 90 emails in 24 hours and never exceed it
	//if you want to send more, use transactional email provider
	do {
	    $result = $db->query($sql);

	    $result_assoc = $result->fetch_assoc();
	    $QUEUE_NOTEMPTY = !empty($result_assoc);

	    if ($QUEUE_NOTEMPTY) {
	    	echo "SENDING " . $EMAILS_IN_BATCH . " emails ". "\r\n";;
	    	$class->sendNewsletter($EMAILS_IN_BATCH);
		    //send 23 emails, wait 6 hours before sending again
		    sleep(21600);
	    }

	} while ($QUEUE_NOTEMPTY);

	echo "******* NEWSLETTER CRONJOB DONE *********". "\r\n";
	exit;

?>
