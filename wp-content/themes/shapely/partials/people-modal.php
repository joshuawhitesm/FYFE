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
            <div class="project-img1">
            <?php $image_popup = get_field('image_popup') ;
            if($image_popup !=''){ ?>
              <img src="<?php echo $image_popup['url'];?>" />
            <?php
            }
            else{ ?>
              <a class = "style_image_thumbnail" href=""><?php the_post_thumbnail();?></a>
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
              <?php
                $location = get_field('location') ;
                $email = get_field('email') ;
                $phone = get_field('phone') ;
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

              <?php
                $past_projects = new WP_Query(array(
                  'post_type' => 'projects',
                  'posts_per_page' =>3,
                  'post__not_in'=> array(get_the_ID())
                ));
              ?>

              <div class="past-project" id="past-project-<?php the_ID(); ?>">
                <h5>PAST PROJECTS</h5>

                <?php while($past_projects->have_posts()) : $past_projects->the_post(); global $product1; ?>
                  <span class="no-padding color-white project-item project-item--small" data-toggle="modal" data-target=".1628">
                    <?php the_post_thumbnail();?>

                    <div class="project-info">
                      <div class="btn-see list-cat-fix"></div>
                      <div class="title-post-fix">
                        <h5>
                          <button type="button" class="btn btn-info btn-lg">
                            <?php echo the_title(); ?>
                          </button>
                        </h5>
                      </div>
                    </div>
                  </span>
                <?php endwhile; ?>
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