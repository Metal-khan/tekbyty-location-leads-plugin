<?php
$hero_heading = get_post_meta($post_id, '_location_hero_heading', true); 
$hero_description = get_post_meta($post_id, '_location_hero_description', true); 
?>
<header>
  <!-- Hero -->
  <div class="p-3 text-center bg-body-tertiary">
    <h1 class="mb-3"><?php echo esc_html(get_the_title()); ?></h1>
    <h4 class="mb-3"><?php echo esc_html($hero_heading);?></h4>
	<p>
		<?php echo esc_html($hero_description);?>
  	</p>
  </div>
  <!-- Hero -->
</header>