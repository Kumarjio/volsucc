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

class Indeed
{ 
	protected $_params = array(
		'publisher' => '',
		'v' => '2',
		'format' => 'json',
		'q' => '',
		'l' => '',
		'jt' => '',
		'start' => '',
		'limit' => '',
		'fromage' => '',
		'filter' => '1',
		'co' => '',
		'userip' => '1.2.3.4',
		'useragent' => 'Mozilla/%2F4.0%28Firefox%29'
	);

	function __construct($publisher_id, $default_query, $location, $job_type, $country, $days_back, $index, $limit, $user_agent, $ip) {
		$this->_params['publisher'] = $publisher_id;
		$this->_params['q'] = $default_query;
		$this->_params['l'] = $location;
		$this->_params['jt'] = $job_type;
		$this->_params['start'] = $index;
		$this->_params['limit'] = $limit;
		$this->_params['fromage'] = $days_back;
		$this->_params['co'] = $country;
		$this->_params['useragent'] = $user_agent;
		$this->_params['userip'] = $ip;
	}

	public function getUrl()
    {
    	$query = '';
    	foreach ($this->_params as $key => $value) {
    		$query .= $key. '=' . urlencode($value) . '&';
    	}
        return rtrim('http://api.indeed.com/ads/apisearch?'. $query, '&');
    }

}

?>