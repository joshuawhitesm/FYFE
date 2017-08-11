<div class="project infinite-item col-xs-6 no-padding color-white">
  <div class="project-item" data-toggle="modal" data-target=".<?php echo get_the_ID();?>">
    <div class="project-img project-img--square">
      <a href="javascript:void(0);"><?php the_post_thumbnail('people-thumb');?></a>
    </div>

    <div class="project-info">
      <!-- <?php $terms  = get_the_terms( get_the_ID(), 'project_cat', '', '' ); ?> -->
      <!-- <?php foreach($terms as $value ){?> -->
        <!--<div class="btn-see btn_see_fix"><a><?php echo $value->name;?></a></div>-->
      <!-- <?php } ?> -->
      <div class="title-post-fix">
        <h5><button type="button" class="btn btn-info btn-lg"><?php the_title();?></button></h5>
      </div>
    </div>
  </div>

  <?php get_template_part("partials/project", "modal") ?>
</div>