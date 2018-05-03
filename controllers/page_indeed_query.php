<?php

if ($id != '')
{
	$tmp = explode('|', $id);

	if (isset($tmp[1])) $url_query = trim($tmp[1]);
	else $url_query = $id;

	$id = urldecode($id);
}

 
if (strstr($id, '%7C'))
{
	$id = str_replace('%7C', '|', $id);
}

if (key_exists('keywords', $_POST)) {
	$requestKeywords = str_replace('"', '', urldecode($_POST['keywords']));

	$url_query = trim($_POST['keywords']);
}

if ($id != '' && !strstr($id, '|'))
{
	$keywords = $db->getConnection()->real_escape_string(trim($id));
}
else
{
	if (!empty($requestKeywords))
	{
		$keywords = $db->getConnection()->real_escape_string(trim($requestKeywords));
	}
	else if (strstr($id, '|'))
	{
		$tmp = explode('|', $id);
		$categ = trim($tmp[0]);
		$keywords = trim($tmp[1]);
		$keywords = str_replace('"', '', urldecode($keywords));
		// clicked on a city on the map
		if (isset($tmp[2]) && $tmp[2] == 'map')
		{
			$city = get_city_id_by_asciiname($keywords);
			$keywords = $city['name'];
		}
	}
	else
	{
		redirect_to(BASE_URL);
		exit;
	}
}

$requestKeywords = $db->getConnection()->real_escape_string(trim($keywords));

if ($requestKeywords != "")
	$QUERY = $requestKeywords;
else
	$QUERY = INDEED_DEFAULT_QUERY;

$start = "0";

if (isset($extra) && !empty($extra)){

	// location filtering
	$exp = explode('|', urldecode($extra));

	if (strcmp($exp[0], "loc") == 0) {
		// filter by country
		$COUNTRY = $exp[1];
		$LOCATION = "";

	} else if (strcmp($exp[0], "cit") == 0) {
		// filter by city
		$LOCATION = $exp[1];
		$COUNTRY = INDEED_COUNTRY;
	} else if (strcmp($exp[0], "type") == 0) {
		$JOB_TYPE = $exp[1];
		$LOCATION = INDEED_LOCATION;
		$COUNTRY = INDEED_COUNTRY;
	} else {
	    // default filtering
		$LOCATION = INDEED_LOCATION;
		$COUNTRY = INDEED_COUNTRY;
		$JOB_TYPE = INDEED_JOB_TYPE;
	}
}
else {
	$LOCATION = INDEED_LOCATION;
	$COUNTRY = INDEED_COUNTRY;
	$JOB_TYPE = INDEED_JOB_TYPE;
}


if ($_SESSION['CURRENT_PAGE']) {
	if (INDEED_HOMEPAGE_DROPDOWN == 'cities' && $_SESSION['CURRENT_PAGE'] == URL_LANDING_SEARCHED) {
		$LOCATION = $COUNTRY;
		$COUNTRY = INDEED_COUNTRY;
	}	
}

try {
	require_once APP_PATH . '_lib/class.Indeed.php';
	$indeed = new Indeed(INDEED_PUBLISHER_ID, $QUERY, $LOCATION, $JOB_TYPE, $COUNTRY, INDEED_DAYS_BACK, $start, JOBS_PER_PAGE, urlencode($_SERVER['HTTP_USER_AGENT']), get_client_ip());
	$url = $indeed->getUrl();
	$jobs = json_decode(file_get_contents($url));

	$smarty->assign('indeed_searched_query', $QUERY);
	$smarty->assign('jobtype', $JOB_TYPE);
	$smarty->assign('jobs', $jobs->results);
	$template = 'jobs/indeed-posts-loop.tpl';
} catch (Exception $e) {
	$smarty->assign('error_msg', 'There was a problem retrieving Indeed jobs.');
	$template = 'err/indeed-err.tpl';
}

?>