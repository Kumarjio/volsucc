<?php


//indeed paginates differently, use offset for it
$page = $_GET['p']; 
if ($page !== "0")
	$start = (intval($page) - 1) * JOBS_PER_PAGE;
else
	$start = "0";

$paginationUrl = '/';
$paginationBase = URL_JOBS;

// job type
if ($id != '') {
	$JOB_TYPE = $id;
	$paginationUrl .= $id;
} else {
	$JOB_TYPE = INDEED_JOB_TYPE;
}

// city
if (isset($_GET['city']) && $_GET['city'] != "all") {
	 $LOCATION = $_GET['city'];
	 if ($LOCATION === "all"){
	 	$LOCATION = "";
	 }
	 else {
	 	$paginationUrl .= $LOCATION;
	 	$paginationBase = 'area';
	 	$COUNTRY = "";
	 }
} else {
	 $LOCATION = INDEED_LOCATION;
}

// country
if (isset($_GET['co']) && $_GET['co'] != "all") {
	 $COUNTRY = $_GET['co'];
	 if ($COUNTRY === "all"){
	 	$COUNTRY = "";
	 }
	 else {
	 	$paginationUrl .= $COUNTRY;
	 	$paginationBase = 'location';
	 	$LOCATION = "";
	 }
} else {
		$COUNTRY = INDEED_COUNTRY;
}

if (isset($_SESSION['indeed_jobs_in_city'])){
	$COUNTRY = INDEED_COUNTRY;
	$LOCATION = $JOB_TYPE;
	$JOB_TYPE = INDEED_JOB_TYPE;
	unset($_SESSION['indeed_jobs_in_city']);
}

if (isset($_SESSION['indeed_favourites'])) {
	$JOB_TYPE = INDEED_JOB_TYPE;
	unset($_SESSION['indeed_favourites']);
}	

try {
	require_once APP_PATH . '_lib/class.Indeed.php';
	$indeed = new Indeed(INDEED_PUBLISHER_ID, INDEED_DEFAULT_QUERY, $LOCATION, $JOB_TYPE, $COUNTRY, INDEED_DAYS_BACK, $start, JOBS_PER_PAGE, urlencode($_SERVER['HTTP_USER_AGENT']), get_client_ip());
	$url = $indeed->getUrl();
	$jobs = json_decode(file_get_contents($url));

	$paginatorLink = BASE_URL  . $paginationBase . $paginationUrl;

	$paginator = new Paginator($jobs->totalResults, JOBS_PER_PAGE, $page);
    $paginator->setLink($paginatorLink);
    $paginator->paginate();
    $offset = $paginator->getFirstLimit();
    $smarty->assign("pages", $paginator->pages_link);

	$smarty->assign('jobtype', $JOB_TYPE);
	$smarty->assign('jobs', $jobs->results);
	$template = 'jobs/indeed-posts-loop.tpl';
} catch (Exception $e) {
	$smarty->assign('error_msg', 'There was a problem retrieving Indeed jobs.');
	$template = 'err/indeed-err.tpl';
}

?>