<?php

$counter = 0;
$query = new WP_Query( $args );
while($query->have_posts()){
	$query->the_post();
	$counter++;
    $collapse_id = 'collapse-' . get_the_ID();
	?>
	<div class="accordion" id="services_accordian">
		<div class="accordion-item">
			<h2 class="accordion-header">
			<button
                    class="accordion-button <?php echo $counter > 1 ? 'collapsed' : ''; ?>"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>"
                    aria-expanded="<?php echo $counter === 1 ? 'true' : 'false'; ?>"
                    aria-controls="<?php echo esc_attr( $collapse_id ); ?>"
                >
				<?php the_title(); ?>
			</button>
			</h2>
			<div
                id="<?php echo esc_attr( $collapse_id ); ?>"
                class="accordion-collapse collapse <?php echo $counter === 1 ? 'show' : ''; ?>"
                data-bs-parent="#services_accordion"
            >
			<div class="accordion-body">
				<?php the_content(); ?>
			</div>
			</div>
		</div>
	</div>
	<?php
}
wp_reset_postdata();

?>
