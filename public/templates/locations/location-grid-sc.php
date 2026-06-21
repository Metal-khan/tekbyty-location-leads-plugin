<?php
$query = new WP_Query($args);

 if ($query->have_posts()) {
        echo '<div class="row g-3">';
        while ($query->have_posts()) {
            $query->the_post();
			$description = get_post_meta(get_the_ID(), '_location_hero_description', true);
            echo '<div class="' . esc_attr($col_class) . '">';
			echo '<div class="card h-100">';
			if (has_post_thumbnail()) {
				echo '<a href="' . esc_url(get_permalink()) . '">';
				echo get_the_post_thumbnail(get_the_ID(), 'medium', [
					'class' => 'card-img-top img-fluid'
				]);
				echo '</a>';
			}
			echo '<div class="card-body">';
			echo '<a href="' . esc_url(get_permalink()) . '" class="stretched-link text-decoration-none">';
			echo '<h5 class="card-title">' . esc_html(get_the_title()) . '</h5>';
			echo '</a>';
			echo '<p class="card-text">' . esc_html(wp_trim_words($description, 50, '...')) . '</p>';

			echo '</div>'; 
			echo '</div>'; 
			echo '</div>'; 
        }

        echo '</div>';
    }
	wp_reset_postdata();