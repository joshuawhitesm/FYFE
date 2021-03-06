<div class="<?php echo get_the_ID();?> modal fade team-modal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
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

            <div class="project_img1_2">
            </div>
          </div>
          <div class="col-md-6  p_l_r_0 color-white p_relative">
          <div class="modal-logo">
            <img src="<?php echo bloginfo('template_directory'); ?>/assets/images/logo.png" class="logo" alt="FYFE">
          </div>
            <div class="p_l_t_30">
              <?php
                $location = get_field('location') ;
                $email = get_field('email') ;
                $phone = get_field('phone') ;
                $status = get_field('status') ;
              ?>
              <div class="project-info1_ok project_info1_ok_100">
                <h6><a href="<?php the_field('linkedin');?>" target="_blank" class="linkedin-user"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a><?php the_title();?></h6>
              </div>
              <div class="project-info1">
                <div class="project-info1_ok">
                  <p><?php echo $status;?></p>
                </div>
                <div class="post-excerpt-fix-popup hiden-xs">
                    <?php the_content();?>
                    <?php if (!empty($email)) { ?>
                        <p>
                          <span>Email:</span>
                          <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                        </p>
                    <?php } ?>
                    <?php if (!empty($phone)) { ?>
                      <p>
                        <span>Phone:</span>
                        <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                      </p>
                    <?php } ?>
                </div>
              </div>


<div class="past-project 22" id="past-project-<?php the_ID(); ?>">

            <?php // Start Loop
            global $post;

                if( have_rows('past_projects',$post->ID) ):
          ?>

          <h5>PAST PROJECTS</h5>

          <ul class="clearfix">

          <?php
                while ( have_rows('past_projects',$post->ID) ) : the_row();

              $post_object = get_sub_field('project');
              if( $post_object ):
            ?>

            <!--<li data-toggle="modal" data-target=".">-->
            <li>
              <div  data-toggle="modal" data-target=".<?php echo $post_object->ID; ?>">
              <!--<a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_post_thumbnail($post_object->ID, 'shapely-grid');?></a>-->
              <?php echo get_the_post_thumbnail($post_object->ID, 'shapely-grid');?>
              <div class="project-info">
                <!--<h5><a href="<?php echo get_permalink($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a></h5>-->
                <h5><a href="#"><?php echo mb_strimwidth(get_the_title($post_object->ID), 0, 30, '...'); ?></a></h5>
              </div>
              </div>
            </li>

                <?php // wp_reset_postdata();
              ?>
              <?php endif; ?>

                <?php endwhile;  ?>

                </ul>

                <?php
                else :
                  // no rows found
                  endif;
                ?>

              </div>

              <div class="project_info_bottom">
                <div class="col-md-6 p_l_r_0">
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