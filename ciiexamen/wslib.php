<?php


// $Id: server.class.php 931 2009-07-23 09:33:54Z ppollet $

/**
 * utilities functions
 *
 * @package Web Services
 * @version $Id: server.class.php 931 2009-07-23 09:33:54Z ppollet $
 * @author Patrick Pollet <patrick.pollet@insa-lyon.fr> v 1.6
 */

/**
 * functions needed for this WS  to run under Moodle 1.9 and Moodle 2.0
 */

$CFG->wspp_using_moodle20 = file_exists($CFG->libdir . '/dml/moodle_database.php');


/**
 *  log all DB errors specific to new Moodle 2.0 API  
 */
 
 function ws_error_log ($ex) {
	global $CFG;
	if (is_object($ex)){
		$info=$ex->getMessage() . '\n' . $ex->getTraceAsString();
	}else $info=$ex;
	error_log ($info,3,$CFG->dataroot.'/wspp_db_errors.log' );
}


function ws_get_record($table, $field1, $value1, $field2 = '', $value2 = '', $field3 = '', $value3 = '', $fields = '*') {

	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			if ($field1)
				$params[$field1] = $value1;
			if ($field2)
				$params[$field2] = $value2;
			if ($field3)
				$params[$field3] = $value3;
			return $DB->get_record($table, $params, $fields);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return get_record($table, $field1, $value1, $field2, $value2, $field3, $value3, $fields);
}

function ws_get_records($table, $field = '', $value = '', $sort = '', $fields = '*', $limitfrom = '', $limitnum = '') {

	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			if ($field)
				$params[$field] = $value;
			return $DB->get_records($table, $params, $sort, $fields, $limitfrom, $limitnum);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return get_records($table, $field, $value, $sort, $fields, $limitfrom, $limitnum);
}

function ws_get_record_select($table, $select, $fields = '*') {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			return $DB->get_record_select($table, $select, array (), $fields);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return get_record_select($table, $select, $fields);
}

function ws_get_records_select($table, $select, array $params = null, $sort = '', $fields = '*', $limitfrom = 0, $limitnum = 0) {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) { 
		try { 
		return $DB->get_records_select($table, $select, null, $sort, $fields, $limitfrom, $limitnum);
		 } catch (Exception $e) {
		 	ws_error_log($e);
			 return false; 
		 }	
	}else
		return get_records_select($table, $select, $sort, $fields, $limitfrom, $limitnum);
}

function ws_get_records_sql ($sql) {
	global $CFG,$DB;
	if ($CFG->wspp_using_moodle20) 
		return $DB->get_records_sql($sql);
	else 
		return get_records_sql($sql);		
}

function ws_get_field($table, $return, $field1, $value1, $field2 = '', $value2 = '', $field3 = '', $value3 = '') {
	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try { 
		$params = array ();
		$params[$field1] = $value1;
		if ($field2)
			$params[$field2] = $value2;
		if ($field3)
			$params[$field3] = $value3;
		return $DB->get_field($table, $params);
		 } catch (Exception $e) {
		 	ws_error_log($e);
			 return false; 
		 }	
	} else
		return get_field($table, $field1, $value1, $field2, $value2, $field3, $value3);
}

function ws_set_field($table, $newfield, $newvalue, $field1, $value1, $field2 = '', $value2 = '', $field3 = '', $value3 = '') {
	global $CFG, $DB;

	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			$params[$field1] = $value1;
			if ($field2)
				$params[$field2] = $value2;
			if ($field3)
				$params[$field3] = $value3;
			return $DB->set_field($table, $newfield, $newvalue, $params);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return set_field($table, $newfield, $newvalue, $field1, $value1, $field2, $value2, $field3, $value3);

}

function ws_record_exists($table, $field1 = '', $value1 = '', $field2 = '', $value2 = '', $field3 = '', $value3 = '') {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			$params = array ();
			$params[$field1] = $value1;
			if ($field2)
				$params[$field2] = $value2;
			if ($field3)
				$params[$field3] = $value3;
			return $DB->record_exists($table, $params);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}

	} else
		return record_exists($table, $field1, $value1, $field2, $value2, $field3, $value3);

}

function ws_insert_record($table, $record) {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			return $DB->insert_record($table, $record);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}

	} else
		return insert_record($table, $record);

}

function ws_update_record($table, $record) {
	global $CFG, $DB;
	if ($CFG->wspp_using_moodle20) {
		try {
			return $DB->update_record($table, $record);
		} catch (Exception $e) {
			ws_error_log($e);
			return false;
		}
	} else
		return update_record($table, $record);

}

?>
