<?php
get_header();

$post_id = get_the_ID();
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

//add hero sectoioon
include_once plugin_dir_path( __FILE__ ).'template-parts/hero-section.php';
//add services sectoioon
include_once plugin_dir_path( __FILE__ ).'template-parts/services-section.php';
//add lead form sectoioon
include_once plugin_dir_path( __FILE__ ).'template-parts/lead-form-section.php';
//add testimonial section
include_once plugin_dir_path( __FILE__ ).'template-parts/testimonials-section.php';
//add faq sectioon
include_once plugin_dir_path( __FILE__ ).'template-parts/faq-section.php';
//add nearbye location section
include_once plugin_dir_path( __FILE__ ).'template-parts/nearby-location-section.php';
//add cta sectin
include_once plugin_dir_path( __FILE__ ).'template-parts/cta-section.php';
get_footer();
?>
