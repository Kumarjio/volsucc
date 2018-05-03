<?php

	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    MIT
	 * @website    simplejobscript.com
	 * 
	 *
	 *  There are no license limitations, modifications nor restrictions placed upon 
	 *  and no rights have been transfered to all third-party software parts of this product. You are granted to use these libraries
	 *  and sub-parts while following their individual license specifications and terms of service
	 *
	 */

	require_once '../_config/cron_config.php';

	$janitor = new Maintenance();

	// delete temporary posts older than 5 days
	$janitor->deleteTmpJobs();

	// what to do with expired jobs ?
	if (strcmp(EXPIRED_JOBS_ACTION, "deactivate") === 0) {
		$janitor->deactivateExpiredJobs();
	} else {
		$janitor->deleteExpiredJobs();
	}

?>
