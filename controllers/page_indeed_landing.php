<?php
global $db;

//indeed paginates differently, use offset for it
$page = $_GET['p']; 
if ($page !== "0")
	$start = (intval($page) - 1) * JOBS_PER_PAGE;
else
	$start = "0";

$paginationBase = URL_LANDING_SEARCHED;

$JOB_TYPE = "";

if (isset($_GET['query'])) {

	$QUERY =  $_GET['query'];
	$paginationUrl .= $QUERY;
	$paginationUrl = '/' . $QUERY;

} else {
	$QUERY = INDEED_DEFAULT_QUERY;
}

if (INDEED_HOMEPAGE_DROPDOWN == 'cities') {

	$COUNTRY = INDEED_COUNTRY;
	$LOCATION = $_GET['co'];

} else {

	 $LOCATION = "";
	 $COUNTRY = $_GET['co'];
}

if (isset($_GET['query'])) {

	$QUERY =  $_GET['query'];
	$paginationUrl = '/' . $_GET['co'] . '/' . $QUERY;

} else {
	$QUERY = INDEED_DEFAULT_QUERY;
	$paginationUrl = '/' . $_GET['co'];
}

try {
	require_once APP_PATH . '_lib/class.Indeed.php';
	$indeed = new Indeed(INDEED_PUBLISHER_ID, $QUERY, $LOCATION, $JOB_TYPE, $COUNTRY, INDEED_DAYS_BACK, $start, JOBS_PER_PAGE, urlencode($_SERVER['HTTP_USER_AGENT']), get_client_ip());
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