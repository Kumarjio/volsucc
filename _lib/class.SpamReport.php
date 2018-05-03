<?php

/**
 * Simplejobscript Copyright (©) 2016 Niteosoft
 *
 * @author     Niteosoft (niteosoft.co.uk)
 * @license    MIT
 * @website    simplejobscript.com
 */

class SpamReport
{
	private $mIp = false;
	private $mJobId = false;
	private $mCount = false;
	private $update = false;
	
	public function __construct($job_id)
	{
		global $db;
		$this->mJobId = $job_id;
		$sql = 'SELECT count
           FROM '.DB_PREFIX.'spam_reports
           WHERE job_id= ' . $job_id;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		if (empty($row)) 
			$this->mCount = 0;
		else {
			$this->update = true;
			$this->mCount = $row['count'];
		}		
	}
	
	// Report a job post as spam
	public function insertNewReport($msg)
	{
		global $db;
		$count = $this->mCount + 1;
		$ip = get_client_ip();

		if ($this->update) {
			$sql = 'UPDATE '.DB_PREFIX.'spam_reports SET count="'.$count.'" WHERE job_id="'.$this->mJobId.'"';
			return ($db->query($sql)) ? true : false;
		} else {

			$sql = 'INSERT INTO '.DB_PREFIX.'spam_reports (job_id, date, msg, count, ip)
				                    VALUES ("' . $this->mJobId . '", NOW(), "' . $msg . '", "' . $count.'", "' . $ip . '")';
			return ($db->query($sql)) ? true : false;
		}
	}
	
}
?>
