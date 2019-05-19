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

$(document).ready(function() {
    $(document).foundation();
    $( "#accordion" ).accordion({
        heightStyle: "content",
        collapsible: true,
        active: false,
        //Constrains the page scroll to the top of the dropped panel
        //https://stackoverflow.com/questions/3621161/jquery-accordion-will-it-scroll-to-the-top-of-the-open-item
        activate: function( event, ui ) {
            if(!$.isEmptyObject(ui.newHeader.offset())) {
                $('html:not(:animated), body:not(:animated)').animate({ scrollTop: ui.newHeader.offset().top }, 'slow');
            }
        }                
    });
});

//Auto-adjusts the height of the bottom blue field to the depth of the viewport.
function dynamicFooter() {
	var footZone = $( "footer" ).position();
	var viewport = $( window ).height();
	var footZoneHeight = viewport - footZone.top;
	$( "footer" ).height( footZoneHeight + 20 );
}
//dynamicFooter();
$( window ).resize(function() {
	dynamicFooter();
});

// Patch for a Bug in v6.3.1
$(window).on('changed.zf.mediaquery', function() {
  $('.is-dropdown-submenu.invisible').removeClass('invisible');
});
 
 