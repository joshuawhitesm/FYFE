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
		<div class="contact-bottom-fix"><a href="http://fyfe.com.au/#contact_home_bottom">CONTACT FYFE</a></div>
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
<?php wp_footer(); ?>

	<script>
		var $ = jQuery
		$(function(){
			$("[data-track-telephone]").click(function(){
		    ga('send', 'event', 'Lead', 'Call', 'Phone Call', $(this).data('track-telephone'));
				console.log("tracking", $(this).data('track-telephone'))
			})

			document.addEventListener( 'wpcf7mailsent', function( event ) {
		    ga('send', 'event', 'Lead', 'Form Fill', 'Contact Us');
		    console.log("Contact Us event tracking")
			}, false );
		})
	</script>

</body>
</html>