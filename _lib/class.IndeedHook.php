<?php 


 	/**
	 * Simplejobscript Copyright (©) 2016 Niteosoft
	 * <support@niteosoft.co.uk>
	 *
	 * @author     Niteosoft (niteosoft.co.uk)
	 * @license    Proprietary software license
	 * @website    simplejobscript.com
	 * 
	 * OFFICIAL INDEED PLUGIN
	 */

class IndeedHook
{ 

	function __construct() {}

	public function register($smarty)
    {

    	$DIR_CONST = '';
		if (defined('__DIR__'))
			$DIR_CONST = __DIR__;
		else
			$DIR_CONST = dirname(__FILE__);
    	
    	$tpl = $DIR_CONST . '/../plugins/Indeed/indeed-mobile-sidebar-content.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('indeed_tpl_mobile_sidebar','err/plugin-missing.tpl');
		} else {
			$smarty->assign('indeed_tpl_mobile_sidebar','../../../plugins/Indeed/indeed-mobile-sidebar-content.tpl');
		}

    	$tpl = $DIR_CONST . '/../plugins/Indeed/indeed-searchbar-content.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('indeed_tpl_searchbar','err/plugin-missing.tpl');
		} else {
			$smarty->assign('indeed_tpl_searchbar','../../../plugins/Indeed/indeed-searchbar-content.tpl');
		}

	    $tpl = $DIR_CONST . '/../plugins/Indeed/indeed-sidebar-content.tpl';
		if (!file_exists($tpl)) {
			$smarty->assign('indeed_tpl_sidebar','err/plugin-missing.tpl');
		} else {
			$smarty->assign('indeed_tpl_sidebar','../../../plugins/Indeed/indeed-sidebar-content.tpl');
		}	

    }

}

?>