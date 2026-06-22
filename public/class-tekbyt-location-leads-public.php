<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://talhaahmadkhan.blog
 * @since      1.0.0
 *
 * @package    Tekbyt_Location_Leads
 * @subpackage Tekbyt_Location_Leads/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tekbyt_Location_Leads
 * @subpackage Tekbyt_Location_Leads/public
 * @author     Talha Khan <talhaahmadkhan08@gmail.com>
 */
class Tekbyt_Location_Leads_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		if(get_post_type( ) == 'locations' ){
			wp_enqueue_style($this->plugin_name.'-bootstrap',plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css',[],'5.3.3');
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tekbyt-location-leads-public.css', array(), $this->version, 'all' );
		}
		

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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
		if(get_post_type( ) == 'locations' ){
			wp_enqueue_script($this->plugin_name.'-bootstrap',plugin_dir_url( __FILE__ ) . 'js/bootsrap.min.js',[],'5.3.3',true);
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tekbyt-location-leads-public.js', array( 'jquery' ), $this->version, false );
			wp_localize_script($this->plugin_name, 'tekbytLocationLeads', array('ajax_url' => admin_url('admin-ajax.php'), 'lead_form_nonce' => wp_create_nonce('lead_form_nonce')));
		}
	}
		
	//add seo title and description
	public function add_seo_meta_tags(){
		if(is_singular('locations')){
			$seo_title = get_post_meta(get_the_ID(), '_location_seo_title', true);
			$seo_description = get_post_meta(get_the_ID(), '_location_seo_description', true);
			if($seo_title){
				echo '<title>' . esc_html($seo_title) . '</title>';
			}
			if($seo_description){
				echo '<meta name="description" content="' . esc_attr($seo_description) . '">';
			}
		}
	}
	//register the shortcode
	public function register_lead_form_shortcode(){
		add_shortcode('tekbyt_location_grid', array($this, 'render_location_grid_shortcode'));
	}
	public function render_location_grid_shortcode($atts){
		$atts = shortcode_atts(array(
			'limit' => -1,
			'state' => '',
			'columns' => '3'
		), $atts, 'tekbyt_location_grid');
		$args = array(
			'post_type' => 'locations',
			'posts_per_page' => $atts['limit'],
		);
		if (!empty($atts['state'])) {
			$args['meta_query'] = array(
				array(
					'key'     => '_location_state',
					'value'   => $atts['state'],
					'compare' => '='
				)
			);
		}
		$col_class = 'col-md-' . (12 / max(1, min(12, $atts['columns'])));
		ob_start();
		include plugin_dir_path(__FILE__) . 'templates/locations/location-grid-sc.php';
		return ob_get_clean();
	}

	//include custom template fof location archive and single page
	public function location_leads_template_pages($template){
		if(is_singular( 'locations' )){
			include_once plugin_dir_path(__FILE__) . 'templates/locations/single-location.php';
			return;
		}
		// if(is_post_type_archive( 'locations' )){
		// 	include_once plugin_dir_path(__FILE__) . 'templates/locations/archive-location.php';
		// 	return;
		// }

		return $template;
	}

	//lead for ajax cb
	public function handle_lead_form_submission(){
		if(!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'lead_form_nonce')) {
			wp_send_json_error( 'Invalid nonce.' );
			return;
		}
		if (isset($_POST['form_data']['name'], $_POST['form_data']['email'], $_POST['form_data']['phone'], $_POST['form_data']['services'])) {
			$name = sanitize_text_field( $_POST['form_data']['name'] );
			$email = sanitize_email( $_POST['form_data']['email'] );
			$phone = sanitize_text_field( $_POST['form_data']['phone'] );
			$services = sanitize_text_field( $_POST['form_data']['services'] );
			$message = isset($_POST['form_data']['message']) ? sanitize_textarea_field($_POST['form_data']['message']) : '';
			$location_id = isset($_POST['form_data']['location']) ? intval($_POST['form_data']['location']) : 0;
			$page_url = isset($_POST['form_data']['page_url']) ? esc_url_raw($_POST['form_data']['page_url']) : '';
			$utm_source = isset($_POST['form_data']['utm_source']) ? sanitize_text_field($_POST['form_data']['utm_source']) : '';
			$utm_campaign = isset($_POST['form_data']['utm_campaign']) ? sanitize_text_field($_POST['form_data']['utm_campaign']) : '';
			if (!is_email( $email)) {
				wp_send_json_error('Invalid email address.');
				return;
			}
			$lead_data = array(
				'post_title' => $name,
				'post_type' => 'leads',
				'post_status' => 'publish',
				'meta_input' => array(
					'_lead_email' => $email,
					'_lead_phone' => $phone,
					'_lead_selected_services' => $services,
					'_lead_selected_location' => $location_id,
					'_lead_page_url' => $page_url,
					'_lead_utm_source' => $utm_source,
					'_lead_utm_campaign' => $utm_campaign,
					'_lead_message' => $message,
					'_lead_submission_date' => current_time('mysql'),
				)
			);
			$lead_id = wp_insert_post($lead_data);
			if (is_wp_error($lead_id)) {
				wp_send_json_error('Failed to save lead.');
				return;
			}else{
				$response = wp_remote_post('https://httpbin.org/post', [
					'method'  => 'POST',
					'body'    => [
						'name' => $name,
						'email' => $email,
						'phone' => $phone,
						'selected_services' => $services,
						'selected_location' => $location_id,
						'page_url' => $page_url,
						'utm_source' => $utm_source,
						'utm_campaign' => $utm_campaign,
						'message' => $message,
						'submission_date' => current_time('mysql'),
					]
				]);
				error_log(print_r($response,true));
				if(is_wp_error($response)){
					update_post_meta($lead_id, '_lead_crm_sync_status', 'Failed');
					error_log('CRM sync failed: ' . $response->get_error_message());
					$total_failed_syncs = get_option( 'total_failed_syncs', 0 );
					update_option( 'total_failed_syncs', $total_failed_syncs + 1 );
				}else{
					if($response['response']['code'] == 200){
						update_post_meta($lead_id, '_lead_crm_sync_status', 'Synced');
					}else{
						update_post_meta($lead_id, '_lead_crm_sync_status', 'Failed');
						error_log('CRM sync failed with response code: ' . $response['response']['code']);
						$total_failed_syncs = get_option( 'total_failed_syncs', 0 );
						update_option( 'total_failed_syncs', $total_failed_syncs + 1 );
					}
				}
			}
			wp_send_json_success('Lead submitted successfully.');
		} else {
			wp_send_json_error('Required fields are missing.');
		}
	}

}
