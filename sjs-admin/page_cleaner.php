<?php 
	$smarty->assign('ACTIVE', 12);

	$cl = new Maintenance();

	if (!empty($id)) {
		if ($id == "tmp"){
			$cl->deleteTmpJobs();
		}
		else{
			if (strcmp(EXPIRED_JOBS_ACTION, "deactivate") === 0) {
				$cl->deactivateExpiredJobs();
			} else {
				$cl->deleteExpiredJobs();
			}
		}

		$smarty->assign('popup', true);
	}

	$smarty->assign('tmp_count', $cl->getTmpJobs());
	$smarty->assign('exp_count', $cl->getExpiredJobs());

	$template = 'cleaner.tpl';
?>