<?php
get_header();

$post_id = get_the_ID();
//add hero sectoioon
include_once plugin_dir_path( __FILE__ ).'template-parts/hero-section.php';
//add services sectoioon
include_once plugin_dir_path( __FILE__ ).'template-parts/services-section.php';
//add lead form sectoioon
include_once plugin_dir_path( __FILE__ ).'template-parts/lead-form-section.php';

get_footer();
?>
