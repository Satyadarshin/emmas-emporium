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

function sleepShop( $lastday ) {
/********************
 * Item: Date trigger
 * ------------------
 * Common date trigger function. Takes a date parameter in the format DD.MM.YYY
 * This function is based around a joke referencing "Logan's Run" (William F. Nolan & George Clayton Johnson, 1967).
 * (You get your kicks where you can in this game.)
 *******************************************************************************************************************/
	$palm_flower = strtotime( $lastday );
	if ( $palm_flower >= strtotime(date('d.m.Y'))) return false;
}

function extractItem( $id ) {
/******************************
 * Item: Individual stock items
 * ----------------------------
 * Used to extract specifc retreat data from the warehouse.data.php
 **************************************************************/
	for ($i = 0; $i < (count($GLOBALS['warehouse'])); $i++) {
		if ($GLOBALS['warehouse'][$i]['id'] == $id) {
			$select = $i;
		}
	}
	$stock = array_slice($GLOBALS['warehouse'], $select, 1);
	return $stock;
}

function dateValues($start, $end) {
/**************************
 * Item: produces ISO formated dates for microformats
 * ------------------------
 * .
 * *******************************************************************/
	$GLOBALS['start'] = date('j F', strtotime($start));
	$GLOBALS['end'] = date('j F Y', strtotime($end));
	$GLOBALS['iso_start'] = date('c', strtotime($start));
	$GLOBALS['iso_end'] = date('c', strtotime($end));
	$GLOBALS['duration'] = (  (strtotime($end)) - (strtotime($start)) ) / 86400;
}


if (! function_exists('array_column')) {
/******************************************************************************************
 * Item: produces custom alternative to array_column() function that only exists in >PHP5.5
 * ----------------------------------------------------------------------------------------
 * http://stackoverflow.com/questions/27422640/alternate-to-array-column
 * ****************************************************************************************/
    function array_column(array $input, $columnKey, $indexKey = null) {
        $array = array();
        foreach ($input as $value) {
            if ( !array_key_exists($columnKey, $value)) {
                trigger_error("Key \"$columnKey\" does not exist in array");
                return false;
            }
            if (is_null($indexKey)) {
                $array[] = $value[$columnKey];
            }
            else {
                if ( !array_key_exists($indexKey, $value)) {
                    trigger_error("Key \"$indexKey\" does not exist in array");
                    return false;
                }
                if ( ! is_scalar($value[$indexKey])) {
                    trigger_error("Key \"$indexKey\" does not contain scalar value");
                    return false;
                }
                $array[$value[$indexKey]] = $value[$columnKey];
            }
        }
        return $array;
    }
}
?>
