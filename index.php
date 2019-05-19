<?php
/*
*****************************
* www.emmasemporium.org 3.0.0
*****************************
*
* Original author: Satyadarshin
* Document created: February 2017
*
* Abstract: Bootstrap page. Resolves the URL parameters a filters the building of an output page document.
*/

require_once('data/config.php'); //Common variables, constants and arrays.

function __autoload($class) {
	require_once('classes/' . $class . '.cls.php');
}

$parameters = array_keys($_GET);

if (!$parameters || $parameters =='') {
	$build = new page( 'home' );
}
else {
    $parameter = $parameters[0];
	if ( $parameter == 'cx' ) {
		$build = new page( 'search' );
	}
	/*
    This is for Paypal returns
    elseif ($parameter == 'merchant_return_link') {
		$build = new page( 'paypal_return' );
	}*/
	elseif ($parameter == 'page') {
		$build = new page( $_GET[$parameter] ); 
	}
    elseif ($parameter == 'catalogue') {
		$build = new cataloguePage( $_GET[$parameter] ); 
	}
	else {
		header( $GLOBALS['header'] . '?page=error&type=001' );
	}
	unset( $build );
}
?>

