<?php 

global $db;

$smarty->assign('ACTIVE', 77);
$MODE_FLOW = false;

// form processing
if (!empty($id)) {

	if (isset($_POST)) {
		escape($_POST);
	}

	if ($id == "mode"){
		$MODE_FLOW = true;

		// deactivate old mode
		$sql = 'UPDATE payment_mode SET active = 0 WHERE id =' . intval($old_mode_id);
		$db->query($sql);

		// activate new mode
		$sql = 'UPDATE payment_mode SET active = 1 WHERE id =' . intval($payment_mode_select);
		$db->query($sql);
		$smarty->assign('POPUP', true);

		clear_main_cache();
	}
}

// page router
if (isset($id) && $id != "") {

	if ($id == "fees") {

		if (isset($extra) && $extra == "updated") {
		
				if (isset($_POST)) {
					foreach ($_POST as $name => $value) {
						try {
							if ($name == 'submit')
								continue;

							//echo $name . " => " . $value . "<br />";
							$sql = 'UPDATE '.DB_PREFIX.'payment_settings_fees SET `value` = "' .  $value . '" WHERE `name` = "' . $name . '"';
							$db->query($sql);
						} catch (Exception $e) {
							var_dump($e);
						}
					}	
					clear_main_cache();
					$smarty->assign('POPUP', true);
				}

		}

		$sql = 'SELECT * FROM '.DB_PREFIX.'payment_settings_fees ORDER BY ordering ASC';
		$result = $db->query($sql);

		$fields = array();
		
		while ($row = $result->fetch_assoc())
		{
			if ($row['input_type'] == 'select') {
				$select_options = explode("|", $row['input_options']);
				$fields[] = array($row['name'], $row['value'], $row['title'], $row['description'], $row['input_type'], $row['input_options'], $select_options);
			} else {
				$fields[] = array($row['name'], $row['value'], $row['title'], $row['description'], $row['input_type'], $row['input_options']);
			}
		}

		$smarty->assign('fields', $fields);
		$template = 'payment-fees-settings.tpl';

	} else if ($id == "packages") {

		$s = 'SELECT * FROM packages';
		$r = $db->query($s);
		$package_ids_arr = array();

		while ($row = $r->fetch_assoc()) {
			$package_ids_arr[] = intval($row['id']);
		}

		if (isset($extra) && $extra == "updated") {
			if (isset($_POST)) {

				// update standard plan
				$NAME = $_POST["pid" . $package_ids_arr[0] . "_name"];
				$JL = intval($_POST["pid" . $package_ids_arr[0] . "_jl"]);
				$JP = intval($_POST["pid" . $package_ids_arr[0] . "_jp"]);
				$CVD = intval($_POST["pid" . $package_ids_arr[0] . "_cvd"]);
				$PRICE = intval($_POST["pid" . $package_ids_arr[0] . "_price"]);

				$sql1 = 'UPDATE packages SET name="' . $NAME . '", jobs_left = ' . $JL . ', job_period = ' . $JP . ', cv_downloads = ' . $CVD . ', price =' . $PRICE . ' WHERE id = ' . $package_ids_arr[0];
				$db->query($sql1);

				// premium
				$NAME = $_POST["pid" . $package_ids_arr[1] . "_name"];
				$JL = intval($_POST["pid" . $package_ids_arr[1] . "_jl"]);
				$JP = intval($_POST["pid" . $package_ids_arr[1] . "_jp"]);
				$CVD = intval($_POST["pid" . $package_ids_arr[1] . "_cvd"]);
				$PRICE = intval($_POST["pid" . $package_ids_arr[1] . "_price"]);

				$sql2 = 'UPDATE packages SET name="' . $NAME . '", jobs_left = ' . $JL . ', job_period = ' . $JP . ', cv_downloads = ' . $CVD . ', price =' . $PRICE . ' WHERE id = ' . $package_ids_arr[1];
				$db->query($sql2);

				// pro
				$NAME = $_POST["pid" . $package_ids_arr[2] . "_name"];
				$JL = intval($_POST["pid" . $package_ids_arr[2] . "_jl"]);
				$JP = intval($_POST["pid" . $package_ids_arr[2] . "_jp"]);
				$CVD = intval($_POST["pid" . $package_ids_arr[2] . "_cvd"]);
				$PRICE = intval($_POST["pid" . $package_ids_arr[2] . "_price"]);

				$sql3 = 'UPDATE packages SET name="' . $NAME . '", jobs_left = ' . $JL . ', job_period = ' . $JP . ', cv_downloads = ' . $CVD . ', price =' . $PRICE . ' WHERE id = ' . $package_ids_arr[2];
				$db->query($sql3);
				
				//assign popup
				$smarty->assign('POPUP', true);
			}
		}

		$sql = 'SELECT * FROM packages';
		$result = $db->query($sql);
		$data = array();

		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		//var_dump($data); die();
		$smarty->assign('package_data', $data);
		$template = 'payment-packages-settings.tpl';
	}



} else {
	$MODE_FLOW = true;
}

if ($MODE_FLOW ) {
	
	// get current payment mode
	$sql = 'SELECT id, name, active FROM payment_mode';
	$result = $db->query($sql);

	$modes = array();
	$active_mode_id = 0;

	while ($row = $result->fetch_assoc()) {
		$modes[$row['id']] = $row['name'];
		
		if (intval($row['active']) == 1) {
			$active_mode_id = $row['id'];
		}
	}

	$smarty->assign('modes', $modes);
	$smarty->assign('active_mode_id', $active_mode_id);

	$template = 'payment-settings.tpl';
}


?>