<?php
/*
*****************************
* www.emmasemporium.org 3.0.0
*****************************
*
* Original author: Satyadarshin
* Document created: February 2017
*
* Abstract: 
*/

date_default_timezone_set('Europe/London');

session_name('EmmasEmporium');
if (session_id() == '') {
  session_start();
};

/******************************
 * Switches: Server Environment
 * ----------------------------
 * Environment Options are:
 * 'live' (for publicly avaialble edition).
 * 'test' (for the dition available at the live test site).
 * 'preflight' for checking the live version prior to upload
 *
 * Environmental constants:
 * SERVER_ROOT is the path to document root. This keeps various header() functions working smoothly.
 *
******************************/

if ($_SERVER['HTTP_HOST'] == 'www.emmasemporium.org' ) {
	$GLOBALS['environment'] = 'live';
	define('MODE', 'live');
	define('SERVER_ROOT', $_SERVER['HTTP_HOST']);
}
if ($_SERVER['HTTP_HOST'] == 'tintin.satyadarshin.com' && preg_match('/EmmasEmporium/', $_SERVER['PHP_SELF']) == true) {
	$GLOBALS['environment'] = 'test';
	define('MODE', 'test');
	define('SERVER_ROOT', $_SERVER['HTTP_HOST'].'/EmmasEmporium');
}
if ($_SERVER['HTTP_HOST'] == 'localhost:8888' && preg_match('/ee_preflight/', $_SERVER['PHP_SELF']) == true) {
	$GLOBALS['environment'] = 'preflight';
	define('MODE', 'local');
	define('SERVER_ROOT','localhost:8888/EmmasEmporium/ee_preflight');
}

$GLOBALS['header'] = 'location: http://' . SERVER_ROOT . '/';

require_once( file_exists('includes/functions.php') ? 'includes/functions.php' : '../includes/functions.php' ) ; //This is where all shared custom functions are located

define('COPYRIGHT', 'Emma&rsquo;s Emporium');
define('SITENAME', 'Emma&rsquo;s Emporium');  
define('DESIGNER', 'Design and programming: <a href="http://www.satyadarshin.com/">Satyadarshin</a>');
define('PHOTOGRAPHER', 'Photography: <a href="http://www.albionvideo.co.uk/">Ian Robinson</a>');
define('KEYWORDS', 'alternative fashion,fair trade,ethical trade, South West England, Devon');
define('GOOGLE_ID', 'VnZIJ88QkLelW35hGyctBQqSJSumuO9QXmVCQ-_mgbY');
define('SCHEMA','http://schema.org/LocalBusiness');

$GLOBALS['eBay_store'] = ' https://stores.ebay.co.uk/emmasemporiumtextiles/';
$GLOBALS['facebook_page'] = 'https://www.facebook.com/pages/Emmas-emporium/254362121267512';
$GLOBALS['twitter']= 'https://twitter.com/emma_emporium';
$GLOBALS['instagram']  = 'https://www.instagram.com/emma_emporium12/';

/********************
 * Toggles & switches
 * ------------------
 * The following switches will turn various complete pages, sections or lines on or off.
 * READ THE COMMENTS!
 ********************/
$GLOBALS['this_season'] = 'Spring-Summer';
//$GLOBALS['this_season'] = 'Autumn-Winter';
