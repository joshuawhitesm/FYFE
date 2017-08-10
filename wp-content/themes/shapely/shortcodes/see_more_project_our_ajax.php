<?php

function see_more_project_our_ajax(){
	$paged = $_POST["paged"];
	$name_sectors = $_POST["name_sectors"];
	$name_services = $_POST["name_services"];
	$page_size = '20';
	// var_dump($paged);
	// var_dump($name_sectors);
	// var_dump($name_services);
	if($name_sectors =="all" && $name_services !="all"){
		$args = array(
		'posts_per_page'   => $page_size,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'paged'    => $paged,
		'tax_query' => array(
				array(
					'taxonomy' => 'project_services',
					'field' => 'id',
					'terms' => $name_services,
				),
			),
		);
	}
	else if($name_services =="all" && $name_sectors !="all"){
		$args = array(
		'posts_per_page'   => $page_size,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'paged'    => $paged,
		'tax_query' => array(
				array(
					'taxonomy' => 'project_sectors',
					'field' => 'id',
					'terms' => $name_sectors,
				),
			),
		);
	}
	else if($name_services =="all" && $name_sectors =="all"){
		$args = array(
		'posts_per_page'   => $page_size,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'paged'    => $paged,
		);
	}
	else{
		$args = array(
		'posts_per_page'   => $page_size,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'projects',
		'post_status'      => 'publish',
		'paged'    => $paged,
		'tax_query' => array(
				array(
					'taxonomy' => 'project_services',
					'field' => 'id',
					'terms' => $name_services,
				),
				array(
					'taxonomy' => 'project_sectors',
					'field' => 'id',
					'terms' => $name_sectors,
				),
			),
		);
	}
	$loop = new WP_Query( $args );
	$count = $loop->post_count;

	while ( $loop->have_posts() ) : $loop->the_post(); global $product;
    get_template_part("partials/project");
	endwhile;?>
	<div id="ajax_posts_f_project" class="row">
		<input type="hidden" class="ajax_posts_f_page_project" value="<?php echo (int)$paged+1;?>">
	</div>
	<?php
exit;
}

?>