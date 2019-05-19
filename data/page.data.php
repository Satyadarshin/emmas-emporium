<?php
global $page_data;
$page_data = array(
    array( 
        'hierarchy' => 3,
        'id'                        =>'catalogue',
        'html_title'                => " Alternative, Unique Fashion, Accessories, and Home Interiors | ". SITENAME ,
        'meta_keywords'             => KEYWORDS . "",
        'meta_description'          => '',
        'meta_robots'               => "index,follow",
        'meta_author'               => COPYRIGHT,
        'deploy'                    => array(
            'main' => array( 
                'module'    => 'catalogue.mod.php', 
                'large'     => 8, 
                'medium'    => 6, 
                'small'     => 12 
            ),
            'sidebar' => array( 
                'module'    => 'catalogue.sidebar.mod.php', 
                'large'     => 4, 
                'medium'    => 6, 
                'small'     => 12 
            ), 
        ),
        'gallery'                   => 'newStock',
        'slide'                     => '',
        'page_title'                => $GLOBALS['this_season'] . ' Catalogue',
        'breadcrumb'                => 'Catalogue',
        'meta_itemprop_name'        => '',
        'meta_itemprop_description' => ''
    ),
    array( 
        'hierarchy' => 6,
        'id'=>'contact',
        'html_title'                => " Alternative, Unique Fashion, Accessories, and Home Interiors | " . SITENAME ,
        'meta_keywords'             => KEYWORDS . "",
        'meta_description'          => 'Based in Devon, we can visit shops in the South West with a range of samples. Contact us for a price list, terms and conditions.',
        'meta_robots'               => "index,follow",
        'meta_author'               => COPYRIGHT,
        'deploy' => array(
            'main' => array( 'module' => 'contact.mod.php', 'large' => 8, 'medium' => 6, 'small' => 12 ),
            'sidebar' => array( 'module' => 'contact.sidebar.mod.php', 'large' => 4, 'medium' => 6, 'small' => 12 ),
        ),
        'gallery'                   => 'newStock',
        'slide'                     => '',
        'page_title'                => 'Contact ' . SITENAME,
        'breadcrumb'                => 'Contacts',
        'meta_itemprop_name'        => '',
        'meta_itemprop_description' => ''
    ),
    array( 
        'hierarchy' => 2,
        'id'=>'suppliers',
        'html_title'                => "Ethical, Fair Trade, and Environmental Policies | " . SITENAME,
        'meta_keywords'             => KEYWORDS . "",
        'meta_description'          => '',
        'meta_robots'               => "index,follow",
        'meta_author'               =>  COPYRIGHT,
        'deploy' => array(
            'main' => array( 'module' => 'suppliers.mod.php', 'large' => 8, 'medium' => 6, 'small' => 12 ),
            'sidebar' => array( 'module' => 'suppliers.sidebar.mod.php', 'large' => 4, 'medium' => 6, 'small' => 12 ),
        ),
        'gallery'                   => 'suppliers',
        'slide'                     => '',
        'page_title'                => 'Our Suppliers',
        'breadcrumb'                => 'Our Suppliers',
        'meta_itemprop_name'        => '',
        'meta_itemprop_description' => ''
    ),
    array( 
        'hierarchy' => 1,
        'id'=>'home',
        'html_title'                => " Alternative, Unique Fashion, Accessories, and Home Interiors | " . SITENAME ,
        'meta_keywords' => KEYWORDS . "",
        'meta_description' => '',
        'meta_robots' => "index,follow",
        'meta_author' => COPYRIGHT,
        'deploy' => array(
            'main' => array( 'module' => 'front_page.mod.php', 'large' => 8, 'medium' => 6, 'small' => 12 ),
            'sidebar' => array( 'module' => 'front_page.sidebar.mod.php', 'large' => 4, 'medium' => 6, 'small' => 12 ), 
        ),
        'gallery' => 'front_page',
        'slide'                     => '',
        'page_title' => 'Fair Trade is the Only Way to Trade',
        'breadcrumb' => 'Home',
        'meta_itemprop_name'  => '',
        'meta_itemprop_description' => ''
    ),
    array(
        'hierarchy' => 5,
        'id'=>'stockists',
        'html_title'                => " Alternative, Unique Fashion, Accessories, and Home Interiors | " . SITENAME ,
        'meta_keywords' => KEYWORDS . "",
        'meta_description' => 'Based in Devon, we can visit shops in the South West with a range of samples. Contact us for a price list, terms and conditions.',
        'meta_robots' => "index,follow",
        'meta_author' => COPYRIGHT,
        'deploy' => array(
            'main' => array( 'module' => 'stockists.mod.php', 'large' => 8, 'medium' => 6, 'small' => 12 ),
            'sidebar' => array( 'module' => 'stockists.sidebar.mod.php', 'large' => 4, 'medium' => 6, 'small' => 12 ),
        ),
        'gallery' => 'newStock',
        'slide'                     => '',
        'page_title' => 'Stockists',
        'breadcrumb' => 'Stockists',
        'meta_itemprop_name'  => '',
        'meta_itemprop_description' => ''
    ),
    array( 
        'hierarchy' => 4,
        'id'=>'wholesale',
        'html_title'                => " Alternative, Unique Fashion, Accessories, and Home Interiors | " . SITENAME ,
        'meta_keywords' => KEYWORDS . "",
        'meta_description' => 'Based in Devon, we can visit shops in the South West with a range of samples. Contact us for a price list, terms and conditions.',
        'meta_robots' => "index,follow",
        'meta_author' => COPYRIGHT,
        'deploy' => array(
            'main' => array( 'module' => 'wholesale.mod.php', 'large' => 8, 'medium' => 6, 'small' => 12 ),
            'sidebar' => array( 'module' => 'wholesale.sidebar.mod.php', 'large' => 4, 'medium' => 6, 'small' => 12 ),
        ),
        'gallery' => 'newStock',
        'slide'                     => '',
        'page_title' => 'Wholesale',
        'breadcrumb' => 'Wholesale',
        'meta_itemprop_name'  => '',
        'meta_itemprop_description' => ''
    )
);
?>