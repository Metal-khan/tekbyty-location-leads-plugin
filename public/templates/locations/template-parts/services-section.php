<?php

$counter = 0;
$query = new WP_Query( $args );
?>
<div class="p-3 text-center">
	<h2 class="mb-3">Services Offered</h2>
</div>
<?php
if ($query->have_posts()) {
        echo '<div class="row g-4">';
        while ($query->have_posts()) {
            $query->the_post();
			$description = get_post_meta(get_the_ID(), '_location_hero_description', true);
            echo '<div class="col-md-4">';
			echo '<div class="card h-100 shadow-sm">';
			if (has_post_thumbnail()) {
				echo '<a href="' . esc_url(get_permalink()) . '">';
				echo get_the_post_thumbnail(get_the_ID(), 'medium', [
					'class' => 'card-img-top img-fluid'
				]);
				echo '</a>';
			}
			echo '<div class="card-body">';
			echo '<a href="' . esc_url(get_permalink()) . '" class="stretched-link text-decoration-none">';
			echo '<h3 class="h5">' . esc_html(get_the_title()) . '</h3>';
			echo '</a>';
			echo '<p class="text-muted">' . esc_html(wp_trim_words(the_content(), 5, '...')) . '</p>';

			echo '</div>'; 
			echo '</div>'; 
			echo '</div>'; 
        }

        echo '</div>';
    } ?>
<?php
wp_reset_postdata();

?>
