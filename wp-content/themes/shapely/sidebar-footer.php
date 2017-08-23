<?php
/**
 * The Sidebar widget area for footer.
 *
 * @package shapely
 */
?>

<?php
// If footer sidebars do not have widget let's bail.

if ( ! is_active_sidebar( 'footer-widget-1' ) && ! is_active_sidebar( 'footer-widget-2' ) && ! is_active_sidebar( 'footer-widget-3' ) && ! is_active_sidebar( 'footer-widget-4' ) ) {
	return;
}
// If we made it this far we must have widgets.
?>

<div class="footer-widget-area">
	<?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
		<div class="col-md-2 col-sm-6 footer-widget" role="complementary">
			<?php dynamic_sidebar( 'footer-widget-1' ); ?>
		</div><!-- .widget-area .first -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
		<div class="col-md-2 col-sm-6 footer-widget" role="complementary">
			<?php dynamic_sidebar( 'footer-widget-2' ); ?>
		</div><!-- .widget-area .second -->
	<?php endif; ?>

	<div class="col-md-3 col-sm-6 footer-widget" role="complementary">
		<?php dynamic_sidebar( 'footer-widget-3' ); ?>
	</div><!-- .widget-area .third -->

	<div class="col-md-5 col-sm-6 footer-widget" role="complementary">
		<ul class="icon-fix">
			<li class="col-md-2 col-xs-6 no-padding"><a href="/?page_id=787" class="icon-fix--button"><span>CAREERS</span></a></li>

		<p class="text-right text-footer-fix">Website design by: Sun Bear Digital</p>
	</div><!-- .widget-area .third -->
</div>
