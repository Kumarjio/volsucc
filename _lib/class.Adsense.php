<?php
 
 	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 * <support@niteosoft.co.uk>
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    Proprietary software license
	 * @website    simplejobscript.com
	 * 
	 * OFFICIAL ADSENSE PLUGIN
	 */

class Adsense
{ 

	function __construct() {}

	public function register($smarty) {

		global $db;

		$DIR_CONST = '';
		if (defined('__DIR__'))
			$DIR_CONST = __DIR__;
		else
			$DIR_CONST = dirname(__FILE__);

		// assign google adsense content
		$sql = 'SELECT listing_side_rectangle as "sidebar", listing_leaderboard as "listing", detail_rectangle as "detail", backoffice_rectangle as "backoffice" FROM '.DB_PREFIX.'adsense WHERE id=1';
		$result = $db->query($sql);
		$adsense_result = $result->fetch_assoc();
		if ($adsense_result != NULL && $adsense_result != "") {
			$smarty->assign('ADSENSE_SIDE_RECTANGLE_CODE', $adsense_result['sidebar']);
			$smarty->assign('ADSENSE_LEADERBOARD_CODE', $adsense_result['listing']);
			$smarty->assign('ADSENSE_DETAIL_CODE', $adsense_result['detail']);
			$smarty->assign('ADSENSE_BACKOFFICE_CODE', $adsense_result['backoffice']);
		} 
		//asign templates
		// LISTING SIDE RECTANGLE
		$tpl = $DIR_CONST . '/../plugins/Adsense/adsense_side_rectangle.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('adsense_side_rectangle','err/plugin-missing.tpl');
		} else {
			$smarty->assign('adsense_side_rectangle','../../../plugins/Adsense/adsense_side_rectangle.tpl');
		}
		//LISTING AD BETWEEN JOBS
		$tpl2 = $DIR_CONST . '/../plugins/Adsense/adsense_listing_leaderboard.tpl';
		if (!file_exists($tpl2)) {
			$smarty->assign('adsense_listing_leaderboard','err/plugin-missing.tpl');
		} else {
			$smarty->assign('adsense_listing_leaderboard','../../../plugins/Adsense/adsense_listing_leaderboard.tpl');
		}
		//JOB DETAIL ADSENSE
		$tpl3 = $DIR_CONST . '/../plugins/Adsense/adsense_detail_rectangle.tpl';
		if (!file_exists($tpl3)) {
			$smarty->assign('adsense_detail_rectangle','err/plugin-missing.tpl');
		} else {
			$smarty->assign('adsense_detail_rectangle','../../../plugins/Adsense/adsense_detail_rectangle.tpl');
		}
		//BACKOFFICE RECTANGLE
		$tpl4 = $DIR_CONST . '/../plugins/Adsense/adsense_backoffice_rectangle.tpl';
		if (!file_exists($tpl4)) {
			$smarty->assign('adsense_backoffice_rectangle','err/plugin-missing.tpl');
		} else {
			$smarty->assign('adsense_backoffice_rectangle','../../../plugins/Adsense/adsense_backoffice_rectangle.tpl');
		}

	}

	public function update($params) {
		global $db;
		$sql = 'UPDATE '.DB_PREFIX.'adsense  SET listing_leaderboard = "' . $params['home_leaderboard'] . '", listing_side_rectangle = "' . $params['home_sidebar'] . '", detail_rectangle = "' . $params['detail_rectangle'] . '", backoffice_rectangle = "' . $params['backoffice_rectangle'] . '" WHERE id = 1';
		$result = $db->query($sql);

		$s = 'UPDATE adsense_count SET count = ' . intval($params['adsense_count']);
		$db->query($s);
	}

}

?>
