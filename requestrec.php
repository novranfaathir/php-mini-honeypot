<?php
/*
	PHP Request Recorder - Simple Honeypot
	Version 1.0
	Request Recorder
	by Novran Faathir (Schopath)
	www.zerobyte.id
*/

error_reporting(0);
error_log(0);

/*** CONFIGURATION ***/
$LOGFILE = "requestrecord.log";
/******* ***** *******/

$GET = $_GET;
$POST = $_POST;
$Now = date("Y-m-d H:i:s");
function getIpAddr() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}

	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;
}

foreach ($GET as $GET_Name => $GET_RealValue) {
	$GET_Value = str_replace(array('\'','"'), array('%27', "%22"), $GET_RealValue);
	$LOG = fopen($LOGFILE, "a") or die("ERROR: Unable to open file!");
	fwrite($LOG, "[GET] $Now|".getIpAddr()."|[PARAM] ".addslashes(htmlspecialchars($GET_Name))." [VALUE] ".addslashes(htmlspecialchars($GET_Value)).PHP_EOL);
	fclose($LOG);
}

foreach ($POST as $POST_Name => $POST_RealValue) {
	$POST_Value = str_replace(array('\'','"'), array('%27', "%22"), $POST_RealValue);
	$LOG = fopen($LOGFILE, "a") or die("ERROR: Unable to open file!");
	fwrite($LOG, "[POST] $Now|".getIpAddr()."|[PARAM] ".addslashes(htmlspecialchars($POST_Name))." [VALUE] ".addslashes(htmlspecialchars($POST_Value)).PHP_EOL);
	fclose($LOG);
}
?>
