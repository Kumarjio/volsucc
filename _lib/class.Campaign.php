<?php
 
  	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 * <support@niteosoft.co.uk>
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    Proprietary software license
	 * @website    simplejobscript.com
	 * 
	 * OFFICIAL BANNER MANAGER PLUGIN
	 */

class Campaign
{ 
	function __construct() {}

	public function register($smarty) {
		global $db;

		$DIR_CONST = '';
		if (defined('__DIR__'))
			$DIR_CONST = __DIR__;
		else
			$DIR_CONST = dirname(__FILE__);

		// CANDIDATE DASHBOARD
		$result = $this->getBanner(BANNER_CANDIDATE_BACKOFFICE);
		if ($result != NULL && count($result) > 1) {
			$smarty->assign('banner_cd', $result);
		}

		$tpl = $DIR_CONST . '/../plugins/Banners/banners_candidate_dashboard.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('banners_cdb','err/plugin-missing.tpl');
		} else {
			$smarty->assign('banners_cdb','../../../plugins/Banners/banners_candidate_dashboard.tpl');
		}

		// LEADERBOARD
		$result = $this->getBanner(BANNER_LEADERBOARD);
		if ($result != NULL && count($result) > 1) {
			$smarty->assign('banner_l', $result);
		}

		$tpl = $DIR_CONST . '/../plugins/Banners/banners_leaderboard.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('banners_lb','err/plugin-missing.tpl');
		} else {
			$smarty->assign('banners_lb','../../../plugins/Banners/banners_leaderboard.tpl');
		}

		// JOB LISTING
		$result = $this->getBanner(BANNER_JOBLISTING);
		if ($result != NULL && count($result) > 1) {
			$smarty->assign('banner_jl', $result);
		}

		$tpl = $DIR_CONST . '/../plugins/Banners/banners_joblisting.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('banners_jlb','err/plugin-missing.tpl');
		} else {
			$smarty->assign('banners_jlb','../../../plugins/Banners/banners_joblisting.tpl');
		}

		// LISTING SIDE RECTANGLE
		$result = $this->getBanner(BANNER_LISTING);

		if ($result != NULL && count($result) > 1) {
			$smarty->assign('banner', $result);
		}
		
		$tpl = $DIR_CONST . '/../plugins/Banners/banners_sidebar_rectangle.tpl';

		if (!file_exists($tpl)) {
			$smarty->assign('banners_side_rectangle','err/plugin-missing.tpl');
		} else {
			$smarty->assign('banners_side_rectangle','../../../plugins/Banners/banners_sidebar_rectangle.tpl');
		}

		//job detail banner -----------------------------------------------------------
		$result = $this->getBanner(BANNER_DETAIL);	
	
		if ($result != NULL && count($result) > 1) {
			$smarty->assign('banner_detail', $result);
		}

		// LISTING SIDE RECTANGLE
		$tpl = $DIR_CONST . '/../plugins/Banners/banners_detail_rectangle.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('banners_detail_rectangle','err/plugin-missing.tpl');
		} else {
			$smarty->assign('banners_detail_rectangle','../../../plugins/Banners/banners_detail_rectangle.tpl');
		}

		//backoffice banner -----------------------------------------------------------
		$result = $this->getBanner(BANNER_BACKOFFICE);	

		if ($result != NULL && count($result) > 1) {
			$smarty->assign('banner_backoffice', $result);
		} 

		// LISTING SIDE RECTANGLE
		$tpl = $DIR_CONST . '/../plugins/Banners/banners_backoffice_rectangle.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('banners_backoffice_rectangle','err/plugin-missing.tpl');
		} else {
			$smarty->assign('banners_backoffice_rectangle','../../../plugins/Banners/banners_backoffice_rectangle.tpl');
		}

	}

	public function createCampaign($params) {
		global $db;

		$sql = 'INSERT INTO '.DB_PREFIX.'campaign (area_id, name, created_on, active, banner_path, url, clicks) VALUES (
		' .$params['area_id'] . ',
		"' . $params['c_name'] . '",
		NOW(),
		' . $params['is_active'] . ',
		"' . $params['banner_path'] . '",
		"' . $params['url'] . '",
		' . "0" . ')';
		$db->query($sql);	
	}

	public function deleteCampaign($id) {
		global $db;
		//extract number of hits on last hour
		$sql = 'DELETE FROM '.DB_PREFIX.'campaign WHERE id = ' . $id;
		$db->query($sql);
	}

	public function getCampaignUrlAndIncreaseClicks($id) {
		global $db;

		$ip = $_SERVER['REMOTE_ADDR'];

		//extract number of hits on last hour
		$sql = 'SELECT count(*) AS hits_last_hour '.
		       'FROM '.DB_PREFIX.'banner_hits WHERE campaign_id = ' . $id . ' AND ip = "' . $ip . '" AND '.
		       'created_on >= DATE_ADD(NOW(),INTERVAL - 1 HOUR)';
		$result = $db->QueryItem($sql);

		// to prevent creating multiple entries
	    if ($result < MAX_VISITS_PER_HOUR) {
			// update hits table
			$sql = 'INSERT INTO '.DB_PREFIX.'banner_hits (campaign_id, created_on, ip)
			                    VALUES (' . $id . ', NOW(), "' . $ip . '")';
			$db->query($sql);

			//increase count
			$sql = 'UPDATE '.DB_PREFIX.'campaign
		           SET clicks = clicks + 1 WHERE id = ' . $id;

			$db->query($sql);
		}

		//get url to redirect
		$sql = 'SELECT url FROM '.DB_PREFIX.'campaign
               WHERE active = 1 AND id = ' . $id;

		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		return $row['url'];
	}

	public function getBanner($areaId) {
		global $db;
		$sql = 'SELECT banner_path, id as "c_id" FROM '.DB_PREFIX.'campaign
               WHERE active = 1 AND area_id = ' . $areaId;

		$result = $db->query($sql);
		return $result->fetch_assoc();
	}

	public function getCampaigns() {
		global $db;
		$sql = 'SELECT a.name as "area_name", b.id as "c_id", b.area_id as "area_id", b.name as "c_name", UNIX_TIMESTAMP(b.created_on) as "created_on", b.active as "is_active", b.banner_path as "banner_path", b.url as "url", b.clicks as "clicks" FROM '.DB_PREFIX.'areas a JOIN '.DB_PREFIX.'campaign b
				ON a.id = b.area_id';

		$result = $db->query($sql);
		$final = array();
		while ($row = $result->fetch_assoc()) {
			$row['date_formated'] = date(DATE_FORMAT, floatval(stripslashes($row['created_on'])));
			$final[] = $row;
		}
	    return $final;
	}

	public function getAreas() { 
		global $db;
		$sql = 'SELECT id, name FROM '.DB_PREFIX.'areas';
		$result = $db->query($sql);
		$areas = array();
		while ($row = $result->fetch_assoc()) {
			$areas[] = $row;
		}
		return $areas;
	}

}

?>
