<?php

$args = array(
    'post_type'      => 'services',
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => '_service_related_locations',
            'value'   => $post_id ,
            'compare' => '=',
        ),
    ),
);

$query = new WP_Query( $args );
while($query->have_posts()){
	$query->the_post();
	?>
	<div class="accordion" id="services_accordian">
		<div class="accordion-item">
			<h2 class="accordion-header">
			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				<?php the_title(); ?>
			</button>
			</h2>
			<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#services_accordian">
			<div class="accordion-body">
				<?php the_content(); ?>
			</div>
			</div>
		</div>
	</div>
	<?php
}
?>
