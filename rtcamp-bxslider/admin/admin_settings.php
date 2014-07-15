<?php

/**
 *  Admin Setting Page
 */
add_action( 'admin_menu', 'register_bxslider_menu_page' );
function register_bxslider_menu_page(){
	add_menu_page("rtcamp BxSlider Settings", "rtCamp BxSlider", "manage_options", "rtcamp-bxslider","rtcamp_bxslider_settings");
}

/**
 *  functions callback bxslider settings
 */
function rtcamp_bxslider_settings(){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		if(isset($_POST['rtcamp_slides']) && $_POST['rtcamp_slides']!=""){
			update_option("rtcamp_slides", $_POST['rtcamp_slides']);
		}else{
			delete_option("rtcamp_slides");
		}
	}
	$rtcamp_slides=get_option("rtcamp_slides");
	?>
		<div class="wrap">
			<h2>rtCamp BxSlider</h2>
			<fieldset>
			<legend>Slides</legend>
			<button type="button" class="button" id="addSlides">Add Slides</button>
			<form action="" method="post" class="clear">
				<ul id="Slides">
					<?php
					if($rtcamp_slides){
						foreach ($rtcamp_slides as $slides){
							?><li style="list-style-type:none;" class="rtcamp_thumnails" title="Drag and drop to sort the item"><div><span class="rtcamp-movable"></span><a href="javascript:void(0);" class="rtcamp_remove_item" title="Click to delete this item"><span>delete</span></a><?php echo wp_get_attachment_image($slides); ?><input type="hidden" name="rtcamp_slides[]" value="<?php echo $slides;?>" /></div></li><?php 
						}
					}
					 
					?>
				</ul>
				<br class="clear" />
				<button type="submit" class="button button-primary button-large clear">Save</button>
			</form>
			</fieldset>
		</div>
	<?php 
}

/**
 * register scripts and css required
 */
 add_action("admin_head", "rtcamp_register_header_files");
 
 function rtcamp_register_header_files(){
 	//register scripts
 	wp_register_script("rtcamp-bxslider-admin", plugin_dir_url(__FILE__)."js/custom-admin.js",array("jquery"));
 	
 	//register stryles
	wp_register_style("jqueryui", plugin_dir_url(__FILE__)."css/jquery-ui.css");
	wp_register_style("rtcamp-admin", plugin_dir_url(__FILE__)."css/rtcamp-admin.css");
	
	// enque scripts
	wp_enqueue_script("jquery");
 	wp_enqueue_script("jquery-ui-core");
 	wp_enqueue_script("jquery-ui-widget");
 	wp_enqueue_script("jquery-ui-sortable");
 	wp_enqueue_script("rtcamp-bxslider-admin");
 	
 	// enque media for uplod frame
 	wp_enqueue_media();
 	
 	// enque styles
 	wp_enqueue_style("jqueryui");
 	wp_enqueue_style("rtcamp-admin");
 }