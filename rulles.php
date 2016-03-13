<?php
date_default_timezone_set('Europe/Kiev');
session_start();
$login=$_SESSION['login_site'];

$inputstring=($_SERVER["REQUEST_URI"]);
$inputstring=str_replace(array("(",")","'","+"),'',$inputstring);
$splitArray = explode('/',$inputstring); 

$arg1=$splitArray[1];
$arg2=$splitArray[2];
$arg3=$splitArray[3];
$arg4=$splitArray[4];
$arg5=$splitArray[5];
$arg6=$splitArray[6];

if ($arg1!=''){ $pref="$arg1"; }
if ($arg2!=''){ $pref="$arg2"; }
if ($arg3!=''){ $pref="$arg3"; }
if ($arg4!=''){ $pref="$arg4"; }
if ($arg5!=''){ $pref="$arg5"; }
if ($arg6!=''){ $pref="$arg6"; }

$date_day=date("d");
$date_month=date("m");
$date_year=date("Y");
$date_hour=date("H");
$date_min=date("i");
spl_autoload_register(function ($class) {
	require 'class/' . $class . '.php';
});
include('modules/header.php');
include('modules/top.php');
if ($arg1==''){
	include('modules/preload.php');
} else {
	if (file_exists('modules/'.$arg1.'.php')){
		require 'modules/'.$arg1.'.php';
	} else {
		require 'modules/404.php';
	}
}
include('modules/footer.php');
?>