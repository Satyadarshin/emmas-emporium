<?php
/*
*****************************
* www.emmasemporium.org 3.0.0
*****************************
*
* Original author: Satyadarshin
* Document created: October 2017
*
* Abstract: Generates a double row of tile-links pulled in from stock labelled as "New".
*/
?>
<section>
    <div class="row">
        <div class="large-12 columns">
            <h2>New this season!</h2>
        </div>
    </div>
<?php
    $new_warehouse_stock_json = file_get_contents( 'data/warehouse.data.json' );
    $new_warehouse_stock = json_decode( $new_warehouse_stock_json, true );

    $list_new = array();
    foreach ( $new_warehouse_stock as $the_stock ) {
        foreach ( $the_stock  as $the_item ) {
            if ( $the_item["status"] == "New" ) {
                $list_new[] = $the_item;
            }
            //Add a maximum number of 12 items (2 rows) to the "New this season" gallery
            if ( $list_new ) {
                if ( count( $list_new ) == 12 ) {
                    break;
                }
            }
        }
    }
    $the_end = '';
    $quantity_new = count( $list_new );
    $short_row = $quantity_new % 6;
    echo '<div class="row">'; //Opens the first row of new items
    foreach( $list_new as $new ) {
        if ( $quantity_new == 6 ) {
            echo '</div><div class="row">'; //closes first, opens second row if it exists.
        }
        if ( $quantity_new == 1 ) { 
            $the_end = 'end'; 
        }
        echo '<div class="large-2 small-6 columns ' . $the_end . '"><a href="?page=catalogue&item=' . $new["code"] . '" title="' . $new["description"] . '"><img src="images/catalogue/' . $new["code"] . '.thumb.jpg" /></a></div>';
        $quantity_new--;
    }
    echo '</div>'; // close second row;
?>
</section>