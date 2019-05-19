<?php

/*
*****************************
* www.emmasemporium.org 3.0.0
******************************
*
* Original author: Satyadarshin
* Document created: February 2017
*
* Abstract: Builds the outline of an HTML document.
*/

class page {
	public $module = array();
	public $itemprop_name = SITENAME; //Microformat: organisation
	public $itemprop_description = ''; //Microformat: description of organisation

	function __construct( $request ) {
		$this->section( $request );
		$this->documentFramework();
	}

	function section( $request ) {
        //This method is a halfway step towards having the page data in a database.
        //Page data is pulled in from a flat datafile.
        include_once( 'data/page.data.php' );
        foreach( $page_data  as $payload ){ 
            if ( $payload ['id'] == $request ) {
                $gallery = ( $payload ['gallery'] == true ) ? $payload ['gallery'] . '.gallery.mod.php' : false;
				$this->module = array(
                    'html_title'                => $payload ['html_title'],
                    'meta_keywords'             => $payload ['meta_keywords'],
                    'meta_description'          => $payload ['meta_description'],
                    'meta_robots'               => $payload ['meta_robots'],
                    'meta_author'               => $payload ['meta_author'],
                    'deploy'                    => $payload ['deploy'],
                    'page_title'                => $payload ['page_title'],
                    'breadcrumb'                => $payload ['breadcrumb'],
                    'gallery'                   => $gallery,
                    'meta_itemprop_name'        => $payload ['meta_itemprop_name'],
                    'meta_itemprop_description' => $payload ['meta_itemprop_description']
                );
                break;
            }
        }
        /*default:
            header($GLOBALS['header'] . '?page=error&type=002');
        break;*/
	}

	function documentFramework() {
		header( "Cache-Control: no-cache" );
		header( "Pragma: no-cache" );
        require_once( 'includes/functions.php' ); //This is where all shared custom functions are located
        $this->ebay = ( $GLOBALS['eBay_store'] ) ? '<a href="' . $GLOBALS['eBay_store'] . '" target="_blank"><img src="images/layout/ebay_icon.png" /></a>' : '';
        $this->facebook = ( $GLOBALS['facebook_page'] ) ? '<a href="' . $GLOBALS['facebook_page'] . '" target="_blank" ><img src="images/layout/facebook-icon.png" /></a>' : '';
        $this->instagram = ( $GLOBALS['instagram'] ) ? '<a href="' . $GLOBALS['instagram'] . '" target="_blank" ><img src="images/layout/instagram-icon.png" /></a>' : '';
        $this->twitter = ( $GLOBALS['instagram'] ) ? '<a href="' . $GLOBALS['twitter'] . '" target="_blank" ><img src="images/layout/twitter-icon.png" /></a>' : '';
		echo '<!doctype html><html amp class="no-js" lang="en" itemscope itemtype="'. SCHEMA .'">';
		$this->documentHead();
		echo "<body>";
		echo "<header>";
		$this->banner();
		echo "</header>";
		$this->navigation();
		echo '<article>' ;
		$this->pagePayload();
		echo "</article>";
		$this->pageFoot();
		echo "</body></html>";
	}

	function documentHead() {
		echo '<head><meta charset="utf-8">';
		echo '<title>' . $this->module['html_title'] . '</title>';
        echo '<meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1" ><link rel="canonical" href="http://www.emmasemporium.org/" />';
        echo '<meta name="keywords" content="' . $this->module['meta_keywords'] . '" />';
        echo '<meta name="description" content="' . $this->module['meta_description'] . '" />';
        echo '<meta itemprop="name" content="' . $this->module['meta_itemprop_name'] . '" />';
        echo '<meta itemprop="description" content="' . $this->module['meta_itemprop_description'] . '" />';
		if ($GLOBALS['environment'] == 'live') {
			echo '<meta name="robots" content="' . $this->module['meta_robots'] . '" />'; // Allows page-by-page control over Googlebot (and some others)
			echo '<meta name="google-site-verification" content="' . GOOGLE_ID . '" />'; // Verifies site ownership for Google Analytics
		}
		else {
			echo '<meta name="robots" content="noindex,nofollow" />'; // Globally rejects Googlebot in non-live environments
		}
		include_once('includes/googleAnalytics.inc.php');
        echo '<link rel="stylesheet" href="css/app.css">';
        //FOR AMP validation https://www.ampproject.org/docs/get_started/create/basic_markup
         echo '<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>';
        echo "</head>";
	}

    /*function banner() {
        //TODO Pass this through rowBuilder()
        echo '<div id="title_block" class="row"><div class="small-12 medium-6 large-8 columns">';
        echo '<a href="/"><h1>'. SITENAME .'</h1></a></div>';
        echo '<div class="small-12 medium-6 large-4 columns">';
        echo $this->ebay;
        echo $this->facebook;
        echo '</div></div>';
	}*/
    
        function banner() {        
        $this->rowBuilder( 
            NULL, 
            array(
                //Grid block 1
                array(
                    'class' => 'title_block', 
                    'do' => array( 
                        'method' => 'echo', 
                        'output' => '<a href="/"><h1>'. SITENAME .'</h1></a>'
                    ), 
                   'columns' => array( 
                        'large' => 8, 
                        'medium' => 6, 
                        'small' => 12 
                    )   
                ),
                //Grid block 2
                array(
                    'class' => 'social_btns', 
                    'do' => array( 
                        'method' => 'echo', 
                        'output' => $this->ebay . ' ' . $this->facebook . ' ' . $this->instagram . ' ' . $this->twitter
                    ), 
                   'columns' => array( 
                        'large' => 4, 
                        'medium' => 6, 
                        'small' => 12 
                    )   
                )
            )
        );
	}

	function navigation() {
        //This method is a placeholder for building the navigation from a payload base table.
        include_once('includes/navigation.inc.php');
	}

	function pagePayload() {
        //Banner-slider row
        $this->rowBuilder(
            NULL, 
            array(
                //Grid block
                array(
                    'class' => 'slide', 
                    'do' => array( 
                        'method' => 'echo', 
                        'output' => '<img class="orbit-image" src="http://placehold.it/1000x300?text=' . str_replace( " ", "", $this->module['breadcrumb'] ) . '+slide" />'
                    ), 
                   'columns' => array( 
                        'large' => 12, 
                        'medium' => 12, 
                        'small' => 12 
                    )   
                )
            )
        );
        $this->rowBuilder(
            NULL, 
            array(
                //grid block
                array(
                    'class' => 'crumbs', 
                    'do' => array( 
                        'method' => 'echo', 
                        'output' => $this->presentBreadcrumbs() 
                    ), 
                   'columns' => array( 
                        'large' => 12, 
                        'medium' => 12, 
                        'small' => 12 
                    )   
                )
            )
        );
        //Page title row
        echo '<section>';
        $this->rowBuilder(
            NULL, 
            array(
                //grid unit 1
                array(
                    'class' => null, 
                    'do' => array( 
                        'method' => 'echo', 
                        'output' => "<h2>" . $this->module['page_title'] . "</h2>"
                    ), 
                   'columns' => array( 
                        'large' => 12, 
                        'medium' => 12, 
                        'small' => 12 
                    )   
                )
            )
        );
        //Main Page content
        $this->rowBuilder(
            NULL, 
            array(
                //Grid unit 1
                 array(
                    'class' => null,
                    'do' => array( 
                        'method'=> 'include', 
                        'output' =>'contentModules/' . $this->module['deploy']['main']['module']
                    ), 
                    'columns' => array( 
                        'large' => 8, 
                        'medium' => 6, 
                        'small' => 12 
                    )
                ),
                //Grid unit 2
                array(
                    'class' => 'sidebar',
                    'do' => array( 
                        'method'=> 'include', 
                        'output' =>'contentModules/' . $this->module['deploy']['sidebar']['module']
                    ), 
                    'columns' => array( 
                        'large' => 4, 
                        'medium' => 6, 
                        'small' => 12 
                    )
                )
            )
        );
        echo '</section>';
        if ( $this->module['gallery'] != false ) {
            echo '<section class="gallery">';
            include( 'contentModules/' . $this->module['gallery'] );
            echo '</section>';
        }
	}

	function rowBuilder( $the_class, $grid ) {
        //Open a new row.
        echo '<div class="row ' . $the_class . '">';
        //build a grid block.
        foreach ( $grid as $block ) {
            //Open a new grid unit.
            echo '<div class="large-' . $block['columns']['large'] . ' medium-' . $block['columns']['medium'] .' small-'. $block['columns']['small'] . ' ' . $block['class'] . ' columns">';
            //place the unit content
            if ( $block['do']['method'] == 'include' ) {
                include $block['do']['output'];
            }
            elseif ( $block['do']['method'] == 'echo' ) {
                echo $block['do']['output'];
            }
            elseif ( $block['do']['method'] == 'row' ) {
                $this->rowBuilder(  $block['do']['output'][0], $block['do']['output'][1] ); 
            }
            else {
                echo "<p>There&rsquo;s been an output error</p>";
            }
           //Close the grid unit.
            echo '</div>';  
        }
        //Close the row.
        echo '</div>';
	}

	function pageFoot() {
         include_once('includes/foot.inc.php');
	}
    
    function presentBreadcrumbs() {
		$this->createBreadcrumbs();
		$this->breadcrumbs = '<div id="crumb_trail"><p id="breadcrumbs">&bull; ';
		$this->total_crumbs = count($_SESSION['breadcrumbs']);
		foreach($_SESSION['breadcrumbs'] as $this->key => $this->value) {
			$this->i = ($this->key +1);
			if ($this->i == $this->total_crumbs) {
			$this->breadcrumbs .= ' <strong>' . $this->value . '</strong>';
		}
			else {
				$this->breadcrumbs .= $this->value . " &lt; "; //in other words, if there isn't a 'next' don't display a <
			}
		}
		return $this->breadcrumbs .= '</p></div>';
	}

	function createBreadcrumbs () {
		$this->breadcrumbs_limit = 5;
		if (!array_key_exists('breadcrumbs',$_SESSION)) $_SESSION['breadcrumbs'][] = '<a href="/">Home</a>';
		//Count the number of recorded breadcrumbs; if it's more than 5, knock the first one of off the begining of the array
		if (count($_SESSION['breadcrumbs']) == $this->breadcrumbs_limit) array_shift($_SESSION['breadcrumbs']);
		//Compare the incoming page request with the last recorded breadcrumb: if the two match exit the process
		//Check if this is a homepage landing. If there's no $_GET, it must be the homepage.
		$this->incoming = '/' . $this->module['breadcrumb'] .'/';
		$this->last_crumb = end($_SESSION['breadcrumbs']);
		//Check the pair against each other; exit if there's a match.
		if (preg_match($this->incoming, $this->last_crumb)) {
			return;
		}
		//Build a crumb.
		else {
			$_SESSION['breadcrumbs'][] = "<a href=\"{$_SERVER['REQUEST_URI']}\" title=\"{$this->module['page_title']}\">{$this->module['breadcrumb']}</a> ";
		}
	}
}
?>