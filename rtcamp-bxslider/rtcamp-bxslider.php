<?php
/*
Plugin Name: rtcamp-bxSlider
Plugin URI: http://milindmore22.blogspot.com/
Description: please put [rtcamp-bxslider] shotcode, It uses <a href="http://bxslider.com/">BXSlider</a>
Author: Milind More
Version: 1.0
Author URI : http://milindmore22.blogspot.com/
Licence: GLP V2
*/
if(is_admin()){
	require_once plugin_dir_path(__FILE__).'/admin/admin_settings.php';
}

/**
 * Add Shotcode for triggering slideshow
 * 
 */
add_shortcode("rtcamp-bxslider", "display_rtcamp_boxslider");
function display_rtcamp_boxslider($atts){
	$rtcamp_slides=get_option("rtcamp_slides");
	if($rtcamp_slides){
	?>
		<ul class="bxslider">
		<?php
			foreach ($rtcamp_slides as $slides){
				?><li><?php echo wp_get_attachment_image($slides,"full"); ?></li><?php 
			}
		?>
		</ul>

	<?php
	}else{
		echo "<h4>Please upload some images !</h4>";
	}
}

add_action("wp_head","rtcamp_bxslider_load_headers");

function rtcamp_bxslider_load_headers(){
	//register scripts	
	wp_register_script("bxslider-js", plugin_dir_url(__FILE__)."lib/jquery.bxslider/jquery.bxslider.min.js",array("jquery"));
	wp_register_script("rtcamp-bxslider-js", plugin_dir_url(__FILE__)."js/rtcamp-boxslider-custom.js",array("jquery","bxslider-js"));
	//register styles
	wp_register_style("bxslider-css", plugin_dir_url(__FILE__)."lib/jquery.bxslider/jquery.bxslider.css");
	wp_register_style("rtcamp-bxslider-css", plugin_dir_url(__FILE__)."css/rtcamp-bxslider.css");
	
	//enque scripts
	wp_enqueue_script("jquery");
	wp_enqueue_script("bxslider-js",array("jquery"));
	wp_enqueue_script("rtcamp-bxslider-js",array("jquery","bxslider-js"));
	
	//enque styles
	wp_enqueue_style("bxslider-css");
	wp_enqueue_style("rtcamp-bxslider-css");
	
	
	
}