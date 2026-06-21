<?php
$query = new WP_Query( $args );
?>
<form class="row g-3">
	<div class="col-md-6">
    	<label for="inputName" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4">
  </div>
  <div class="col-12">
    <label for="inputPhone" class="form-label">Phone</label>
    <input type="text" class="form-control" id="inputPhone" placeholder="1234 Main St">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Services</label>
    <select type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
		<option value="">Select Service</option>
		<?php
		while($query->have_posts()){
			$query->the_post();
			?>
			<option value="<?php echo esc_attr(get_the_ID()); ?>"><?php echo esc_html(get_the_title()); ?></option>
			<?php
		} ?>	
	</select>
  </div>
  <div class="col-md-6">
    <label for="inputMessage" class="form-label">Message</label>
    <textarea class="form-control" id="inputMessage" rows="3"></textarea>
  </div>
    <input type="hidden" class="form-control" name="input_location" id="input_location" value="<?php echo esc_attr($post_id); ?>">
    <input type="hidden" class="form-control" name="input_page_url" id="input_page_url" value="<?php echo esc_attr(get_permalink($post_id)); ?>">
    <input type="hidden" class="form-control" name="input_utm_source" id="input_utm_source" value="<?php echo esc_attr(isset($_GET['utm_source']) ? $_GET['utm_source'] : ''); ?>">
    <input type="hidden" class="form-control" name="input_utm_campaign" id="input_utm_campaign" value="<?php echo esc_attr(isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : ''); ?>">
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>