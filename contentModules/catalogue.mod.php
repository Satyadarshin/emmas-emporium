<?php

/*
*****************************
* www.emmasemporium.org 3.0.0
******************************
*
* Original author: Satyadarshin
* Document created: February 2017
*
* Abstract: Builds a catalogue page in various permutations from the more general to the specific.
*/

$warehouse_json = file_get_contents( 'data/warehouse.data.json' );
$warehouse = json_decode( $warehouse_json, true );
$the_catalogue_json = file_get_contents( 'data/season.data.json' );
$the_catalogue = json_decode( $the_catalogue_json, true );
/*
 * Full season category list
 */

if ( isset($_GET['category']) && $_GET['category'] != '' ) {
    $category_query = urldecode( $_GET['category'] );
    echo '<div class="complete_category">';
    foreach( $the_catalogue["season"][ $GLOBALS['this_season'] ] as $category => $category_list ) {
        $the_output = array();
        $i = 0;
        if ( array_key_exists( 'subcategory_image', $category_list )) {
            if ( array_key_exists( $category_query, $category_list )) {
                echo '<h4>' . $category_query .  '</h4>';
                $the_output = $category_list[ $category_query ]['stock_list'];
            }
        }
        elseif ( $category == $category_query )  {
            echo '<h4>' . $category .  '</h4>';
            $the_output = $category_list['stock_list'];
        }
        $build_rows = count( $the_output );
        foreach( $the_output as $code => $extract_item ) {
        $item = array_search( $extract_item, array_column( $warehouse["stock"], 'code' ) );
            $the_end = ( $build_rows == 1) ? 'end' : NULL;
            $args[ $i ] = array(
                'class' => $the_end,
                'do' => array(
                    'method'    => 'echo',
                    'output'    => '<p><a href="?page=catalogue&parent=' . urlencode( $_GET['category'] ) . '&item=' . $warehouse["stock"][ $item ][ 'code' ] . '"><img src="images/catalogue/' . $warehouse["stock"][ $item ][ 'image' ][ 'thumbnail' ] . '.jpg" alt="Photograph of ' . urldecode( $warehouse["stock"][ $item ][ 'name' ] ) . '" /></a><span>' . urldecode( $warehouse["stock"][ $item ][ 'name' ] ) . '</span></p>'
                ),
                'columns' => array(
                    'large'     => 6,
                    'medium'    => 12,
                    'small'     => 12
                )
            );
            $i = count( $args );
            if ($i == 2) {
                $this->rowBuilder( NULL, $args );
                 unset( $args );
            }
            elseif( $build_rows == $i ) {
                $this->rowBuilder( NULL, $args );
                unset( $args );
        }
            $build_rows--;
        }
        unset( $the_output );
    }
        echo '</div>';
    echo '<p class="more">See also</p><p>';
    foreach( $the_catalogue["season"][ $GLOBALS['this_season'] ] as $catalogue => $category ) {
        if ( array_key_exists( 'subcategory_image', $category )) {
            foreach( $category as $k => $v ) {
                if ($k == 'subcategory_image') {
                    continue;
                }
                else {
                $alphabetical_sort[] = $k;
                }
            }
        }
        else {
          $alphabetical_sort[] = $k;
        }
    }
    sort( $alphabetical_sort );
    foreach(  $alphabetical_sort as $see => $also){
        if ( $see === 0) echo '';
        else echo '&bull;';
        echo ' <a href="?page=catalogue&category=' . urlencode( $also ) . '">' . $also . '</a> ';
    }
    echo '</p>';
 ?>
    <a class="button expanded" href="?page=catalogue"><?php echo $GLOBALS['this_season']; ?> catalogue</a>
<?php
    //TODO back to catalogue home
}

/*
 * Single item parameter
 */

elseif ( isset($_GET['item']) && $_GET['item'] != '' ) {
    $item = array_search( $_GET['item'], array_column( $warehouse["stock"], 'code' ) );
    //Data for the row of stock photos
    $args = array(
        //Grid block 1
        array(
            'class' => '',
            'do' => array(
                'method'    => 'echo',
                'output'    => '<img src="images/catalogue/'. $warehouse["stock"][ $item ][ 'image' ][ 'primary' ] .'.jpg" />'
            ),
           'columns' => array(
                'large'     => 6,
                'medium'    => 12,
                'small'     => 12
            )
        ),
        //Grid block 2
        array(
            'class' => '',
            'do' => array(
                'method' => 'echo',
                'output' => '<img src="images/catalogue/'. $warehouse["stock"][ $item ][ 'image' ][ 'secondary' ] .'.jpg" />'
            ),
           'columns' => array(
                'large'     => 6,
                'medium'    => 12,
                'small'     => 12
            )
        )
    );

    //Builds the item data table
    $this->rowBuilder(
        'item_data',
        array(
            //Grid block 1
            array(
                'class' => 'item_image ',
                'do' => array(
                    'method' => 'row',
                    'output' => array( NULL, $args)
                ),
               'columns' => array(
                    'large'     => 12,
                    'medium'    => 12,
                    'small'     => 12
                )
            ),
            //Grid block 2
            array(
                'class' => '',
                'do' => array(
                    'method' => 'echo',
                    'output' => '
                       <table summary="Stock data for '. $warehouse["stock"][ $item ][ 'name' ] . ', from the ' . $_GET[ 'parent' ] .' category of our ' . $GLOBALS['this_season'] . ' catalogue.">
                            <tr><td>' . $warehouse["stock"][ $item ][ 'code' ] . '</td><td><strong>'. $warehouse["stock"][ $item ][ 'name' ] . '</strong></td><td>' . $warehouse["stock"][ $item ][ 'status' ] . '</td></tr>
                            <tr><td>Description</td><td colspan="2">' . $warehouse["stock"][ $item ][ 'description' ].'</td></tr>
                            <tr><td>Pattern</td><td colspan="2">' . $warehouse["stock"][ $item ][ 'pattern' ] . '</td></tr>
                            <tr><td>Colour</td><td colspan="2">' . $warehouse["stock"][ $item ][ 'colour' ] . '</td></tr>
                            <tr><td>Fabric</td><td colspan="2">' . $warehouse["stock"][ $item ][ 'fabric' ] . '</td></tr>
                            <tr><td>Sizes</td><td colspan="2">' .  $warehouse["stock"][ $item ][ 'sizes' ] . '</td></tr>
                        </table>'
                ),
               'columns' => array(
                    'large'     => 12,
                    'medium'    => 12,
                    'small'     => 12
                )
            )
        )
    );
?>
<?php
    //pull out the sibling items in this category and allow the user to forward-back at items in the same set
foreach( $the_catalogue["season"][ $GLOBALS['this_season'] ] as $category => $sub_category ) {
   if ($sub_category[ $_GET[ 'parent' ]] == true) {
       $the_items =  $sub_category[ $_GET[ 'parent' ]][ 'stock_list' ];
       break;
   }
}

?>
    <div class="expanded button-group radius">
        <a class="button previous<?php echo ( $item == 0 ) ? ' disabled' : ''; ?>" href="?page=catalogue&item=<?php echo $warehouse["stock"][ $item-1 ]['code'] ?>">Previous item</a>
        <a href="?page=catalogue" class="button"><?php echo $GLOBALS['this_season'];?></a>
        <?php if ($_GET[ 'parent' ]): ?> 
            <a href="?page=catalogue&category=<?php echo urlencode( $_GET[ 'parent' ] ); ?>" class="button"><?php echo $_GET[ 'parent' ];?></a>
        <?php endif; ?>
        <a class="button next<?php echo ( $item == (count($warehouse["stock"])-1) ) ? ' disabled' : ''; ?>" href="?page=catalogue&item=<?php echo $warehouse["stock"][ ($item+1) ][ 'code' ] ?>">Next item</a>
    </div>
<?php
}
else {
?>
<p class="stand_out">
  <!-- <span class="drop_cap">E</span>mma&rsquo;s Emporium Autumn Winter collection is now available to buy wholesale. As well as our main catalogue, we have added a range of soft fleecy trousers, ponchos and more. To <a href="?page=contact">request a copy of our Autumn Winter 2018 wholesale catalogue</a> please contact us. -->
  <span class="drop_cap">W</span>elcome to our current online, wholesale catalogue. We have an additional Autumn Winter range: for our printed, wholesale winter catalogue <a href="?page=contact">please drop us an email</a>.</p>
  <!-- <span class="drop_cap">W</span>elcome to our current online, wholesale catalogue. Please <a href="?page=contact">contact us</a> for wholesale enquiries. For retail please visit <a href="?page=stockists">one of our stockists</a> , or visit our <a href="<?php echo $GLOBALS['eBay_store']; ?>">eBay shop, Emma&rsquo;s Emporium Textiles</a>, to buy a select range on line, and don&rsquo;t forget to follow our social media links to keep up to date with our latest news.</p> -->
<?php
echo '<div id="accordion">';
$odd = false;
    foreach( $the_catalogue["season"][ $GLOBALS['this_season'] ] as $catalogue => $category ) {
        echo "<h3>" . $catalogue ."</h3>";
        echo '<div>';
        $build_subcategory_rows = ( count( $category ) -1 );
        if ( $build_subcategory_rows % 2 != 0) $odd = "true";
        foreach( $category as $stock => $data ){
            if ( $stock != 'subcategory_image' )  {
                $the_end = ( $build_subcategory_rows == 1) ? 'end' : NULL;
                $args[] = array(
                    'class' => $the_end,
                    'do' => array(
                        'method'    => 'echo',
                        'output'    => '<div class="category"><a href="?page=catalogue&category='. urlencode( $stock ) .'"><img src="images/catalogue/' . $data['category_image']. '.jpg" /></a><h4><a href="?page=catalogue&category='. urlencode( $stock ) .'">' . $stock . "</a></h4><span>&nbsp;</span></div>"
                    ),
                    'columns' => array(
                        'large'     => 6,
                        'medium'    => 12,
                        'small'     => 12
                    )
                );
                $the_args = count( $args );
                if ( $the_args == 2 ) {
                    $this->rowBuilder( NULL, $args );
                    unset( $args );
                }
                elseif( $odd == "true" && $build_subcategory_rows == 1 ) {
                    $this->rowBuilder( NULL, $args );
                    unset( $args );
                }
                $build_subcategory_rows--;
            }
        }
        echo '</div>';
    }
    echo '</div>';
}
?>
  <p class="stand_out lower">Visit our <a href="<?php echo $GLOBALS['eBay_store']; ?>">eBay shop, Emma&rsquo;s Emporium Textiles</a>, to buy a select range on line, and don&rsquo;t forget to follow our social media links to keep up to date with our latest news.</p>

