<?php
function our_sliderhome_func($atts,$args) {
  ob_start();
  $title = isset($args['title']) ? $args['title'] : '';
  $atts = shortcode_atts( array(
    'number_posts' => 10,
    'post_type' => 'sliderhome',
    ), $atts, 'sliderhome' );

    $args = ( array(
        'post_type' => $atts['post_type'],
    'posts_per_page' => $atts['number_posts'],
    'orderby' => 'title',
    'order' => 'ASC'
    ) );

  $query = new WP_Query($args);?>
  <div class="slhome">
  <div id="myCarousel1" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
  <?php
  if ($query->have_posts()) {
    $arr_project = array();
    while ($query->have_posts()) {
    $query->the_post();?>
    <?php
    $id = get_field('id_project');
    $arr_project[]= array('id' => $id);
    ?>
    <div id="myCarousel<?php echo get_the_ID(); ?>" class="item item-fix1">
      <div class="img_slhome fl_r col-lg-20ths col-xs-12 no-padding glr-right color-white">
      <img style="min-height: 83.2298vh;" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'shapely-full'); ?>" />
      <div class="slhome_des col-xs-5"><a data-toggle="modal" data-target="#mymodal_<?php the_field('id_project');?>" ><?php the_field('description');?></a></div>
    </div>
    <div class="wpb_column vc_column_container col-lg-5ths item-center-fix2">
      <div class="vc_column-inner no-padding center-fix-item text-left">
        <!-- <h4><a href="#"><?php the_title();?></a></h4> -->
      </div>
    </div>
      </div>

    <?php
    }
  }?>
  <div class="btn-slider hsu-slider-styling slhomebt">
    <a class="leftbt" href="#myCarousel1" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="rightbt" href="#myCarousel1" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>

  </div>

  </div>
  <div class="slhome_list slhome_list_sliderhome left_0 col-lg-5ths" style="max-height: 522px">
    <h4><a href="/?page_id=1101">KEY SERVICES</a></h4>
    <script>
      setTimeout(function(){
        jQuery(".carousel-indicators li a").on("click",function(){
          var url = jQuery(this).attr('href');
          jQuery(location).attr('href',url);
        });
      }, 0);

    </script>
    <div class="dot-slider">
      <ol class="carousel1-indicators">

        <?php

        $args2 = ( array(
          'post_type' => 'sliderhome',
          'posts_per_page' => 10,
          'orderby' => 'title',
          'order' => 'ASC'
        ) );
        $i=0;
        $query2 = new WP_Query($args2);
        if ($query2->have_posts()) {
        while ($query2->have_posts()) {
        $query2->the_post();?>
          <li  data-slide-to="<?php echo $i;?>"
            class="slhome_title_sliderhome slhome_title slhp_<?php the_field('data_slide');?>">
            <?php
            $post_slug = get_post_field( 'post_name', get_post() );
            // var_dump($post_slug);

            $link = '/?page_id=1101/#'.$post_slug ;
            ?>
            <a href="<?php echo $link; ?>"><?php the_title();?></a>
          </li>
        <?php $i++;
        }
        wp_reset_postdata();
        }?>
      </ol>
      <div class="sliderhome_75370" >
        <img src="<?php echo bloginfo('template_directory'); ?>/inc/img/maps.png" alt="sliderhome">
      </div>
    </div>
  </div>

  </div>
   <?php
  foreach($arr_project as $item){
    $project_id = $item['id'];
    $image_popup = get_field('image_popup', $project_id);
    $popup_image = $image_popup['url'];
  ?>

  <div class="modal fade project-modal" id="mymodal_<?php echo $project_id;?>" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="modal_body_fix col-md-12 p_l_r_0">
              <div class="col-md-6 p_l_r_0 p_relative">
                <div class="project-img1 3">


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

                </div>
                <div class="project_img1_2">
                </div>
              </div>
              <div class="col-md-6  p_l_r_0 color-white p_relative">
              <div class="modal-logo">
                <img src="<?php echo bloginfo('template_directory'); ?>/assets/images/logo.png" class="logo" alt="FYFE">
              </div>
                <div class="p_l_t_30">

                  <div class="project-info1">
                    <div class="project-info1_ok">
                      <p><?php echo get_the_title($project_id);?></p>
                    </div>

                    <div class="btn-see list-cat-fix list-cat-fix2">
                    <?php
                    $terms = get_the_terms( $project_id, 'project_services' );

                    if ( $terms && ! is_wp_error( $terms ) ) :

                      $draught_links = array();

                      foreach ( $terms as $term ) {?>
                        <a href="<?php the_field('link','project_services_'. $term->term_taxonomy_id);?>"><?php echo $term->name;?></a>
                      <?php }
                      ?>


                    <?php endif; ?></div>
                    <div class="post-excerpt-fix-popup hiden-xs"><?php echo get_post_field('post_content', $project_id); ?></div>

                  </div>

                  <div class="project-info1">
                    <div class="project_info1_ok11">
                      <p>RELATED PROJECTS</p>
                    </div>
                    <?php
                    $terms = get_the_terms( $project_id, 'project_services' );
                    // print_r( $terms );
                    foreach($terms as $term) {
                      $id2 = $term->term_id;
                      $args1 = array(
                      'post_type' => 'projects',
                      'posts_per_page' => 3,
                      'tax_query' => array(
                        array(
                          'taxonomy' => 'project_services',
                          'field' => 'id',
                          'terms' => $id2
                          )
                        )
                      );
                      $loop1 = new WP_Query( $args1 );
                    ?>

                    <div class="project_info1_ok1">
                      <?php while ( $loop1->have_posts() ) : $loop1->the_post(); global $product1;?>
                        <span class="no-padding color-white project-item project-item--small">
                          <?php the_post_thumbnail();?>

                          <div class="project-info">
                            <div class="btn-see list-cat-fix"></div>
                            <div class="title-post-fix">
                              <h5>
                                <button type="button" href="javascript:void(0);"class="btn btn-info btn-lg">
                                  <?php echo the_title(); ?>
                                </button>
                            </h5>
                            </div>
                          </div>
                        </span>
                      <?php  endwhile;?>
                    </div>
                    <?php } ?>
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
  <?php } ?>
  <style type="text/css">
    .text_yellow{
      color: #f1ac08;
    }
  </style>
  <script>
    jQuery(document).ready(function(){

      jQuery(".item-fix1:first").addClass("active");
    jQuery('.slhome_title').click(function(){
      jQuery(".slhome_title").toggleClass('text_yellow');
  });

});
  </script>



  </div>
  <?php
$myvariable = ob_get_clean();
  return $myvariable;
}