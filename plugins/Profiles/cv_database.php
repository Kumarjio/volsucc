<?php 

$employer = new Employer();

$smarty->assign('EMP_ID', $_SESSION['user']);
$loadLibraries = true;

if (PAYMENT_MODE == "3") {

	$package_data = $employer->getEmployerAccount($_SESSION['user']);

	if (intval($package_data['cv_downloads_left']) < 1) {
		$OVERRIDE_CVDB_ACCESS = true;
		$msg = $translations['post_step1']['no_cvs_left_msg'];
		$smarty->assign('lock_screen', true);
	}
	else {

		if (intval($package_data['cv_downloads_left']) == 0 || intval($package_data['cv_downloads_left']) > 1) {
			$suffix = $translations['post_step1']['cvs_left'];
		} else {
			$suffix = $translations['post_step1']['cv_left'];
		}

		$msg = $translations['post_step1']['account_plan'] . " " . $package_data['cv_downloads_left'] . " " . $suffix;
	}

	$smarty->assign('msg', $msg);
}



// verify access
if (PAYMENT_MODE == '2' && intval(CVDB_ACCESS_PRICE) > 0) {

	$access = $employer->checkCvDbAccess($_SESSION['user']);
	if ($access){
		$smarty->assign('CVDB_ACCESS_RESULT', true);
	}
	else {
		$price = format_currency(WEBSITE_CURRENCY, CVDB_ACCESS_PRICE);
		$msg = str_replace('{FEE}', $price, $translations['dashboard_recruiter']['cvdb_locked_text']);
		$smarty->assign('CVDB_MSG', $msg);
		$smarty->assign('CVDB_ACCESS_RESULT', false);
		$loadLibraries = false;
	}

} else {
	// show to all
	$smarty->assign('CVDB_ACCESS_RESULT', true);
}

if (PAYMENT_MODE == "3" && $OVERRIDE_CVDB_ACCESS) {
	$smarty->assign('CVDB_ACCESS_RESULT', false);
}

if ($loadLibraries) {
	$smarty->assign('LOAD_TAGL', true);
	$smarty->assign('TAGL_INIT_CVDB', true);

	$skills = $cvdb_location = $cvdb_occupation = '';
	if (isset($_POST['taggles']) || isset($_POST['cvdb_location'])) {
		escape($_POST);
		$skills = tagglesToString($taggles);
		$searchPerformed = false;

		if (!empty($cvdb_occupation) && strlen($cvdb_occupation) > 2){
			$smarty->assign('searched_occupation', $cvdb_occupation);
			$searchPerformed = true;
		}

		if (!empty($cvdb_location) && strlen($cvdb_location) > 2){
			$smarty->assign('searched_location', $cvdb_location);
			$searchPerformed = true;
		}

		if (!empty($skills) && strlen($skills) > 2){
			$smarty->assign('searched_skills', explode(",", $skills));
			$searchPerformed = true;
		}
		$smarty->assign('searchPerformed', $searchPerformed);

	} else {
		$skills = $cvdb_location = '';
	}

	//get applicants active in the last 3 months
	$class = new Applicant();

	$TOTAL = $class->getApplicationsCount($cvdb_occupation, $cvdb_location, $skills);

	 //pagination
	$paginatorLink = BASE_URL  . URL_DASHBOARD . '/' . URL_DASHBOARD_CVDATABASE;
	$paginator = new Paginator($TOTAL, APPLICATIONS_PER_PAGE, @$_REQUEST['p']);
	$paginator->setLink($paginatorLink);
	$paginator->paginate();
	$offset = $paginator->getFirstLimit();

	$list = $class->getCvDatabase($offset, $settings['theme'], $cvdb_occupation, $cvdb_location, $skills);

	//pagination
	$smarty->assign("pages", $paginator->pages_link);
	$smarty->assign('applicants_count', $TOTAL);

	if ($TOTAL > 0)
		$smarty->assign('init_modal_popups', '1');

	$smarty->assign('applications', $list);
}

if (isset($extra) && intval($extra) == 2){
	if (PAYMENT_MODE == '1' || PAYMENT_MODE == '3' || PAYMENT_MODE == '0' || intval(CVDB_ACCESS_PRICE) == 0) {
		redirect_to(BASE_URL . URL_DASHBOARD);
	}
	// price calculation
	$price = intval(CVDB_ACCESS_PRICE);
	$price_formated = format_currency(WEBSITE_CURRENCY, intval(CVDB_ACCESS_PRICE));

	if (VAT_KOEFICIENT != 0) {
		$price_vat_total_formated = format_currency(WEBSITE_CURRENCY, $price + ($price * VAT_KOEFICIENT));
		$price_vat_formated = format_currency(WEBSITE_CURRENCY, $price * VAT_KOEFICIENT);

		$smarty->assign('PRICE_VAT_TOTAL_FORMATED', $price_vat_total_formated);
		$smarty->assign('PRICE_VAT_FORMATED', $price_vat_formated);
	} 
	$smarty->assign('PRICE_FORMATED', $price_formated);
}

if ($extra == "granted") {
	$smarty->assign('ACCESS_GRANTED_MSG', $translations['paypal']['cvdb_order_completed_msg']);
}

$smarty->assign('JS_ID', 'cvdb-li');

?>