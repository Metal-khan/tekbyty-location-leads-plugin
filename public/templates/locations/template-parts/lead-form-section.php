<?php
$query = new WP_Query( $args );
?>
<form id="lead-capture-form" class="row g-3">
	<div class="col-md-6">
    	<label for="inputName" class="form-label">Name</label>
    <input type="text" name="inputName" class="form-control" id="inputName">
  </div>
  <div class="col-md-6">
    <label for="inputEmail" class="form-label">Email</label>
    <input type="email" name="inputEmail" class="form-control" id="inputEmail">
  </div>
  <div class="col-12">
    <label for="inputPhone" class="form-label">Phone</label>
    <input type="text" name="inputPhone" class="form-control" id="inputPhone" placeholder="">
  </div>
  <div class="col-12">
    <label for="inputServices" class="form-label">Services</label>
    <select type="text" name="inputServices" class="form-control" id="inputServices" placeholder="">
		<option value="">Select Service</option>
		<?php
		while($query->have_posts()){
			$query->the_post();
			?>
			<option value="<?php echo esc_attr(get_the_ID()); ?>"><?php echo esc_html(get_the_title()); ?></option>
			<?php
		}
		wp_reset_postdata();
		?>	
	</select>
  </div>
  <div class="col-md-6">
    <label for="inputMessage" class="form-label">Message</label>
    <textarea class="form-control" name="inputMessage" id="inputMessage" rows="3"></textarea>
  </div>
    <input type="hidden" class="form-control" name="input_location" id="input_location" value="<?php echo esc_attr($post_id); ?>">
    <input type="hidden" class="form-control" name="input_page_url" id="input_page_url" value="<?php echo esc_attr(get_permalink($post_id)); ?>">
    <input type="hidden" class="form-control" name="input_utm_source" id="input_utm_source" value="<?php echo esc_attr(isset($_GET['utm_source']) ? $_GET['utm_source'] : ''); ?>">
    <input type="hidden" class="form-control" name="input_utm_campaign" id="input_utm_campaign" value="<?php echo esc_attr(isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : ''); ?>">
  <div class="col-12">
    <input type="submit" class="btn btn-primary" value="Submit">
  </div>
</form>