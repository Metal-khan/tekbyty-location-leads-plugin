<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://talhaahmadkhan.blog
 * @since      1.0.0
 *
 * @package    Tekbyt_Location_Leads
 * @subpackage Tekbyt_Location_Leads/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tekbyt_Location_Leads
 * @subpackage Tekbyt_Location_Leads/admin
 * @author     Talha Khan <talhaahmadkhan08@gmail.com>
 */
class Tekbyt_Location_Leads_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tekbyt_Location_Leads_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tekbyt_Location_Leads_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tekbyt-location-leads-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tekbyt_Location_Leads_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tekbyt_Location_Leads_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tekbyt-location-leads-admin.js', array( 'jquery' ), $this->version, false );

	}

	//function for registering the custom post type for the plugin
	public function register_location_leads_post_type(){
		//registre location cpt
		register_post_type( 'locations', array(
			'label' => 'Locations',
			'public' => true,
			'has_archive' => true,
			'rewrite' => [
				'slug' => 'locations'
			],
			'supports' => [
				'title',
				'thumbnail',
				'exerpt'
			]
		) );

		//registre service cpt
		register_post_type( 'services', array(
			'label' => 'Services',
			'public' => true,
			'has_archive' => true,
			'rewrite' => [
				'slug' => 'services'
			],
			'supports' => [
				'title',
				'editor',
				'thumbnail',
				'exerpt'
			]
		) );

		//registre leads cpt
		 if (current_user_can('manage_options')) {
				$show_in_menu = true;
			 }else{
				$show_in_menu = false;
			 }
		register_post_type( 'leads', array(
			'label' => 'Leads',
			'public' => true,
	        'publicly_queryable' => false,

			'has_archive' => true,
			'rewrite' => [
				'slug' => 'leads'
			],
			'show_in_menu' => $show_in_menu,
	        'map_meta_cap'        => true,
			'capabilities'	=>	[
				'edit_posts'          => 'manage_options',
				'edit_others_posts'   => 'manage_options',
				'publish_posts'       => 'manage_options',
				'read_private_posts'  => 'manage_options',
				'delete_posts'        => 'manage_options',
			],
			'supports' => [
				'title',
			]
		) );
	}

	// add boxes in admin post side
	public function add_location_leads_meta_boxes(){
		add_meta_box(
			'location_leads_details',
			'Location Details',
			array( $this, 'render_location_leads_meta_box' ),
			'locations',
			'normal',
			'high'
		);

		add_meta_box(
			'services_leads_details',
			'Services Details',
			array( $this, 'render_services_leads_meta_box' ),
			'services',
			'normal',
			'high'
		);

		add_meta_box(
			'leads_details',
			'Lead Details',
			array( $this, 'render_leads_meta_box' ),
			'leads',
			'normal',
			'high'
		);
	}

	//render the metaboxes in the admin post side for location
	public function render_location_leads_meta_box( $post ){
		
		
		$city = get_post_meta( $post->ID, '_location_city', true );
		$state = get_post_meta( $post->ID, '_location_state', true );
		$hero_heading = get_post_meta( $post->ID, '_location_hero_heading', true );
		$hero_description = get_post_meta( $post->ID, '_location_hero_description', true );
		$service_intro = get_post_meta( $post->ID, '_location_service_intro', true );
		$phone = get_post_meta( $post->ID, '_location_phone', true );
		$email = get_post_meta( $post->ID, '_location_email', true );
		$seo_title = get_post_meta( $post->ID, '_location_seo_title', true );
		$seo_description = get_post_meta( $post->ID, '_location_seo_description', true );

		echo '<label for="location_city">City:</label>';
		echo '<input type="text" id="location_city" name="location_city" value="' . esc_attr( $city ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="location_state">State:</label>';
		echo '<input type="text" id="location_state" name="location_state" value="' . esc_attr( $state ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="location_hero_heading">Hero Heading:</label>';
		echo '<input type="text" id="location_hero_heading" name="location_hero_heading" value="' . esc_attr( $hero_heading ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="location_service_intro">Service Intro:</label>';
		echo '<input type="text" id="location_service_intro" name="location_service_intro" value="' . esc_attr( $service_intro ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="location_phone">Phone Number:</label>';
		echo '<input type="text" id="location_phone" name="location_phone" value="' . esc_attr( $phone ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="location_email">Email:</label>';
		echo '<input type="email" id="location_email" name="location_email" value="' . esc_attr( $email ) . '" size="25" />';
		echo '<label for="location_seo_title">Seo Title:</label>';
		echo '<input type="text" id="location_seo_title" name="location_seo_title" value="' . esc_attr( $seo_title ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="location_hero_description">Hero Description:</label>';
		echo wp_editor( esc_html($hero_description), 'location_hero_description' );
		echo '<br><br>';
		echo '<label for="location_seo_description">Seo Description:</label>';
		echo wp_editor( esc_html($seo_description), 'location_seo_description' );
		wp_nonce_field( 'location_leads_nonce_action', 'location_leads_nonce' );
	}

	//render the metaboxes in the admin post side for leads
	public function render_leads_meta_box( $post ){
		
		$phone = get_post_meta( $post->ID, '_lead_phone', true );
		$email = get_post_meta( $post->ID, '_lead_email', true );
		$selected_services = get_post_meta( $post->ID, '_lead_selected_services', true );
		$selected_location = get_post_meta( $post->ID, '_lead_selected_location', true );
		$message = get_post_meta( $post->ID, '_lead_message', true );
		$page_url = get_post_meta( $post->ID, '_lead_page_url', true );
		$utm_source = get_post_meta( $post->ID, '_lead_utm_source', true );
		$utm_campaign = get_post_meta( $post->ID, '_lead_utm_campaign', true );
		$submission_date = get_post_meta( $post->ID, '_lead_submission_date', true );
		$crm_sync_status = get_post_meta( $post->ID, '_lead_crm_sync_status', true );
		
		echo '<label for="lead_phone">Phone Number:</label>';
		echo '<input type="text" id="lead_phone" name="lead_phone" value="' . esc_attr( $phone ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_email">Email:</label>';
		echo '<input type="email" id="lead_email" name="lead_email" value="' . esc_attr( $email ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_selected_services">Selected Services:</label>';
		echo '<input type="text" id="lead_selected_services" name="lead_selected_services" value="' . esc_attr( $selected_services ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_selected_location">Selected Location:</label>';
		echo '<input type="text" id="lead_selected_location" name="lead_selected_location" value="' . esc_attr( $selected_location ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_message">Message:</label>';
		echo '<textarea id="lead_message" name="lead_message" rows="5" cols="50">' . esc_attr( $message ) . '</textarea>';
		echo '<br><br>';
		echo '<label for="lead_page_url">Page URL:</label>';
		echo '<input type="text" id="lead_page_url" name="lead_page_url" value="' . esc_url_raw( $page_url ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_utm_source">UTM Source:</label>';
		echo '<input type="text" id="lead_utm_source" name="lead_utm_source" value="' . esc_attr( $utm_source ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_utm_campaign">UTM Campaign:</label>';
		echo '<input type="text" id="lead_utm_campaign" name="lead_utm_campaign" value="' . esc_attr( $utm_campaign ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_submission_date">Submission Date:</label>';
		echo '<input type="text" id="lead_submission_date" name="lead_submission_date" value="' . esc_attr( $submission_date ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="lead_crm_sync_status">CRM Sync Status:</label>';
		echo '<input type="text" id="lead_crm_sync_status" name="lead_crm_sync_status" value="' . esc_attr( $crm_sync_status ) . '" size="25" />';
		wp_nonce_field( 'lead_leads_nonce_action', 'lead_leads_nonce' );
	}
	

	//render the metaboxes in the admin post side for services
	public function render_services_leads_meta_box( $post ){
		
		
		$price_range = get_post_meta( $post->ID, '_service_price_range', true );
		$related_locations = get_post_meta( $post->ID, '_service_related_locations', true );
		

		echo '<label for="service_price_range">Price Range:</label>';
		echo '<input type="text" id="service_price_range" name="service_price_range" value="' . esc_attr( $price_range ) . '" size="25" />';
		echo '<br><br>';
		echo '<label for="service_related_locations">State:</label>';
		echo '<input type="text" id="service_related_locations" name="service_related_locations" value="' . esc_attr( $related_locations ) . '" size="25" />';
		wp_nonce_field( 'services_leads_nonce_action', 'services_leads_nonce' );
	}

	// save the meta booxes
	public function save_location_leads_meta_boxes($post_id){
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!isset($_POST['location_leads_nonce']) || !wp_verify_nonce( $_POST['location_leads_nonce'], 'location_leads_nonce_action' )){
			return;
		}

		if(!current_user_can( 'edit_post', $post_id )){
			return;
		}
		
		if(get_post_type( $post_id ) === 'locations'){
			update_post_meta( $post_id, '_location_city', $_POST['location_city']  );
			update_post_meta( $post_id, '_location_state', $_POST['location_state']  );
			update_post_meta( $post_id, '_location_hero_heading', $_POST['location_hero_heading']  );
			update_post_meta( $post_id, '_location_hero_description', $_POST['location_hero_description']  );
			update_post_meta( $post_id, '_location_service_intro', $_POST['location_service_intro']  );
			update_post_meta( $post_id, '_location_phone', $_POST['location_phone']  );
			update_post_meta( $post_id, '_location_email', $_POST['location_email']  );
			update_post_meta( $post_id, '_location_seo_title', $_POST['location_seo_title']  );
			update_post_meta( $post_id, '_location_seo_description', $_POST['location_seo_description']  );
		}
	}
	//save service meta boxes
	public function save_service_leads_meta_boxes($post_id){
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!isset($_POST['services_leads_nonce']) || !wp_verify_nonce( $_POST['services_leads_nonce'], 'services_leads_nonce_action' )){
			return;
		}

		if(!current_user_can( 'edit_post', $post_id )){
			return;
		}

		if(get_post_type( $post_id ) === 'services'){
			update_post_meta( $post_id, '_service_price_range', $_POST['service_price_range']  );
			update_post_meta( $post_id, '_service_related_locations', $_POST['service_related_locations']  );
		}
	}

	// save the lead meta boxes
	public function save_lead_leads_meta_boxes($post_id){
	    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

		if (!isset($_POST['lead_leads_nonce']) || !wp_verify_nonce( $_POST['lead_leads_nonce'], 'lead_leads_nonce_action' )){
			return;
		}

		if(!current_user_can( 'edit_post', $post_id )){
			return;
		}
		
		if(get_post_type( $post_id ) === 'leads'){
			update_post_meta( $post_id, '_lead_phone', $_POST['lead_phone']  );
			update_post_meta( $post_id, '_lead_email', $_POST['lead_email']  );
			update_post_meta( $post_id, '_lead_selected_service', $_POST['lead_selected_service']  );
			update_post_meta( $post_id, '_lead_selected_location', $_POST['lead_selected_location']  );
			update_post_meta( $post_id, '_lead_message', $_POST['lead_message']  );
			update_post_meta( $post_id, '_lead_page_url', $_POST['lead_page_url']  );
			update_post_meta( $post_id, '_lead_utm_source', $_POST['lead_utm_source']  );
			update_post_meta( $post_id, '_lead_utm_campaign', $_POST['lead_utm_campaign']  );
			update_post_meta( $post_id, '_lead_submission_date', $_POST['lead_submission_date']  );
			update_post_meta( $post_id, '_lead_crm_sync_status', $_POST['lead_crm_sync_status']  );
		}
	}

}
