<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Shapely
 */

get_header(); ?>
<?php $layout_class = shapely_get_layout_class(); ?>
	<div class="row">
		<?php
		if ( $layout_class == 'sidebar-left' ):
			get_sidebar();
		endif;
		?>
		<div id="primary" class="style_single_page col-md-12 mb-xs-24 <?php echo esc_attr( $layout_class ); ?>"><?php
			while ( have_posts() ) : the_post();

				?>
<div class="<?php echo get_the_ID();?> modal fade in project-modal" role="dialog" style="display:block">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <a href="<?php echo get_home_url(); ?>"><button type="button" class="close">&times;</button></a>
      </div>

      <div class="modal-body">
        <div class="modal_body_fix col-md-12 p_l_r_0">
          <div class="col-md-6 p_l_r_0 p_relative">

          <?php $image_popup = get_field('image_popup') ;
            if($image_popup !=''){ ?>

              <div class="project-img1" style="background-image: url(<?php echo $image_popup['url'];?>);"></div>
            <?php
            }
            else{ ?>
              <div class="project-img1" style="background-image: url(<?php the_post_thumbnail_url();?>);"></div>
            <?php
            }
            ?>

            <div class="project_img1_2"></div>
          </div>

          <div class="col-md-6  p_l_r_0 color-white p_relative">
            <div class="modal-logo">
              <img src="<?php echo bloginfo('template_directory'); ?>/assets/images/logo.png" class="logo" alt="FYFE">
            </div>

            <div class="p_l_t_30">
              <div class="project-info1">
                <div class="project-info1_ok">
                  <p><?php the_title();?></p>
                </div>
                <div class="btn-see list-cat-fix list-cat-fix2 333">
                  <?php
                    $terms = get_the_terms( get_the_ID(), 'project_services' );

                    if ( $terms && ! is_wp_error( $terms ) ) :

                      $draught_links = array();

                      foreach ( $terms as $term ) {?>
                        <a href="<?php the_field('link','project_services_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
                  			<!--<a href="<?php echo  get_term_link( $term ); ?>"><?php echo $term->name;?></a>-->

                      <?php } ?>
                  <?php endif; ?>
                </div>

                <div class="post-excerpt-fix-popup hiden-xs"><?php the_content();?></div>
              </div>

              <div class="project-info1">
                <div class="project_info1_ok11">
                  <p>RELATED PROJECTS</p>
                </div>
                <?php
                   $id = get_the_ID();
                  $custom_taxterms = wp_get_object_terms( $id, 'project_services', array('fields' => 'ids') );
                  $args1 = array(
                  'post_type' => 'projects',
                  'post_status' => 'publish',
                  'posts_per_page' => 3, // you may edit this number
                  'orderby' => 'rand',
                  'tax_query' => array(
                    array(
                      'taxonomy' => 'project_services',
                      'field' => 'id',
                      'terms' => $custom_taxterms
                    )
                  ),
                  'post__not_in' => array ($id),
                  );

                  $loop1 = new WP_Query( $args1 );
                ?>

                <div class="project_info1_ok1">
                  <?php while ( $loop1->have_posts() ) : $loop1->the_post(); global $product1;?>
                  <a href="<?php echo get_permalink($post_object->ID); ?>" class="project-info-btn" >
                    <span class="no-padding color-white project-item project-item--small">
                      <?php if ( has_post_thumbnail( $post->ID ) ) {
                            the_post_thumbnail();
                        }
                            else {
                                echo '<img src="http://fyfe.com.au/wp-content/uploads/2017/08/recommended-product-dummy.jpg" alt=""/>';
                                }

                      ?>

                      <div class="project-info">
                        <div class="btn-see list-cat-fix"></div>
                        <div class="title-post-fix">
                          <h5>

                          
                             <?php echo mb_strimwidth(get_the_title(), 0, 30, '...'); ?>
                          </h5>
                        </div>
                      </div>

                    </span>
                    </a>
                  <?php endwhile;?>
                </div>
              </div>

              <div class="project_info_bottom">
                <div class="col-md-6 p_l_r_0 project_info_bottom1_6">
                  <div class="project_info1_a_share">
                    <p>SHARE</p>
                    <?php echo do_shortcode( "[simple-social-share]" ); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php

			endwhile; // End of the loop. ?>
		</div><!-- #primary -->
		<?php
		if ( $layout_class == 'sidebar-right' ):
			// get_sidebar();
		endif;
		?>
	</div>
<?php
get_footer();
