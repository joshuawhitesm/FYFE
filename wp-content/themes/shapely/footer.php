<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Shapely
 */

?>

</div><!-- #main -->
<div class="ft-contact col-xs-12" id="contact_home_bottom">
	<?php if(is_home() || is_front_page()){?>
    <?php echo do_shortcode('[contact]'); 
	} else {?>
		<div class="contact-bottom-fix"><a href="http://fyfe-project.sunbeardigital.com/#contact_home_bottom">CONTACT FYFE</a></div>
	<?php }
	?>
</div>
</section><!-- section -->



<div class="footer-callout">
	<?php shapely_footer_callout(); ?>
</div>

<footer id="colophon" class="site-footer footer bg-dark" role="contentinfo">
	<div class="container footer-inner">
		<div class="row">
			<?php get_sidebar( 'footer' ); ?>
		</div>
	</div>

	<a class="btn btn-sm fade-half back-to-top inner-link" href="#top"><i class="fa fa-angle-up"></i></a>
</footer><!-- #colophon -->
</div>
</div><!-- #page -->


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
jQuery(document).ready( function($) {
	$('.sliderhome_75370').on("click", function() {
		$('html,body').animate({scrollTop: $("#contact_home_bottom").offset().top - 80 },'slow');

	});
	$('.click_top_scroll').on("click", function() {
		$('html,body').animate({scrollTop: $("#sesion_2_home_fyfe_project ").offset().top - 80 },'slow');
		// alert('go');
	});
});
function cat_ajax_get(catID) {
    jQuery("a.ajax").removeClass("current");
    jQuery("a.ajax").addClass("current"); //adds class current to the category menu item being displayed so you can style it with css
    jQuery("#loading-animation").show();
    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {"action": "load-filter", cat: catID, 'refresh_cart': 'yes' },
        success: function(response) {
            jQuery("#category-post-content").html(response);
            jQuery("#loading-animation").hide();
            return false;
        }
    });
}
</script>
<script>
function location_ajax_get(postID) {
    jQuery("a.ajax").removeClass("current");
    jQuery("a.ajax").addClass("current"); //adds class current to the category menu item being displayed so you can style it with css
    jQuery("#loading-animation").show();
    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {"action": "load_location", location_cat: catID },
        success: function(response) {
            jQuery("#location-content").html(response);
            jQuery("#loading-animation").hide();
            return false;
        }
    });
}
</script>
<script>
jQuery("#category-menu").on("click", ".init", function() {
    jQuery(this).closest("#category-menu").children('li:not(.init)').toggle();
});

var allOptions = jQuery("#category-menu").children('li:not(.init)');
jQuery("#category-menu").on("click", "li:not(.init)", function() {
    allOptions.removeClass('selected');
    jQuery(this).addClass('selected');
    jQuery("#category-menu").children('.init').html(jQuery(this).html());
    allOptions.toggle();
});
</script>
<script>
jQuery("#category-menu2").on("click", ".init2", function() {
    jQuery(this).closest("#category-menu2").children('li:not(.init2)').toggle();
});

var allOptions2 = jQuery("#category-menu2").children('li:not(.init2)');
jQuery("#category-menu2").on("click", "li:not(.init2)", function() {
    allOptions2.removeClass('selected');
    jQuery(this).addClass('selected');
    jQuery("#category-menu2").children('.init2').html(jQuery(this).html());
    allOptions2.toggle();
});
jQuery(".name_sectors-title").click(function(){
    jQuery(".name_sectors-item").toggle(500);
});
jQuery(".name-services-title").click(function(){
    jQuery(".name_services-fix").toggle(500);
});
jQuery('.carousel').carousel();
jQuery(".glr-right img").hover(function(){
    jQuery('.slhome_des').css("display", "block");
    }, function(){
    jQuery('.slhome_des').css("display", "none");
});
jQuery(".slhome_des").hover(function(){
    jQuery(this).css("display", "block");
    }, function(){
    jQuery(this).css("display", "none");
});
</script>
<?php wp_footer(); ?>
</body>
</html>