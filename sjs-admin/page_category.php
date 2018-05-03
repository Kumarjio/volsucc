<?php
	$category_var_name = $id;
	$INACTIVE = false;

	if ($category_var_name != 'all')
	{
		$category = get_category_by_var_name($category_var_name);
		$category_id = $category['id'];
	}
	else
	{
		$category = $category_var_name;
	}

	$type_var_name = $extra;

	$smarty->assign('current_type', $type_var_name);
	
	$type_id = get_type_id_by_varname($type_var_name);
	
	$jobsCount = 0;

	if (strcmp($id, "inactive") == 0) {
		$INACTIVE = true;
	}

	if ($category != 'all')
	{
		$jobsCount = $type_id ? $job->CountJobs($id, $type_id) : $job->CountJobs($id);
	}
	else
	{
		$jobsCount =  $job->CountJobs();
	}

	if ($INACTIVE)
		$jobsCount = $job->GetInActiveJobsCount();
	
	if ($INACTIVE)
		$paginatorLink = BASE_URL . URL_JOBS . "/inactive";
	else
		$paginatorLink = BASE_URL . URL_JOBS . "/$category_var_name";

	if (isset($type_var_name))
		$paginatorLink .= "/$type_var_name";
		

	$paginator = new Paginator($jobsCount, JOBS_PER_PAGE, @$_REQUEST['p']);
	$paginator->setLink($paginatorLink);
	$paginator->paginate();
	
	$firstLimit = $paginator->getFirstLimit();
	$lastLimit = $paginator->getLastLimit();
	
	if ($category != 'all')
	{
		$the_jobs = $job->GetPaginatedJobsForCategory($category_id, $firstLimit, JOBS_PER_PAGE, $type_id);
	}
	else
	{
		$the_jobs = $job->GetPaginatedJobs($firstLimit, JOBS_PER_PAGE, $type_id, false);
	}

	if ($INACTIVE) {
		if ($category != 'all')
		{
			$the_jobs = $job->GetInactivePaginatedJobsForCategory($category_id, $firstLimit, JOBS_PER_PAGE, $type_id);
		}
		else
		{
			$the_jobs = $job->GetInactivePaginatedJobs($firstLimit, JOBS_PER_PAGE, $type_id);
		}
	}
		

	$smarty->assign("pages", $paginator->pages_link);
	
	$smarty->assign('jobs', $the_jobs);
	$smarty->assign('jobs_count', $jobsCount);
	$smarty->assign('types', get_types_admin());
	$smarty->assign('current_category', $category_var_name);

	if ($INACTIVE){
		$name = 'Неактивные вакансии';
		$smarty->assign('current_category_name', $name);
		$smarty->assign('ACTIVE', 1);
	}
	else{
		$name = (!empty($id)) ? 'Активные вакансии / ' .$id: 'Активные вакансии';
		$smarty->assign('current_category_name', $name);
		$smarty->assign('ACTIVE', 2);
	}

	if ($id === "edited" || $extra === "edited") 
		$smarty->assign('JOB_EDITED', true);

	$template = 'category.tpl';
?>