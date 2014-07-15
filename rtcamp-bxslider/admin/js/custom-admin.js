jQuery(document).ready(function(){
	// add images with wordpress upload frame
	jQuery('#addSlides').click(function(e) {

		e.preventDefault();
		frame = wp.media({
			title : 'Choose Images for Slide',
			frame: 'post',
			multiple : true, // set to false if you want only one image
			library : { type : 'image'},
			button : { text : 'Add Image' },
		});

		frame.on('close',function(data) {
			var imageArray = [];
			images = frame.state().get('selection');
			images.each(function(image) {
				imageArray.push(image.attributes.url); // want other attributes? Check the available ones with 
				console.log(image.attributes);
				the_list = '<li style="list-style-type:none;" class="rtcamp_thumnails" title="Drag and drop to sort the item"><div><span class="rtcamp-movable"></span><a href="javascript:void(0);" class="rtcamp_remove_item" title="Click to delete this item"><span>delete</span></a><img src="'+ image.attributes.sizes.thumbnail.url +'"><input type="hidden" name="rtcamp_slides[]" value="'+ image.id +'" /></div></li>';
				jQuery("#Slides").append(the_list);
			});


		});

		frame.open()

	});
	
	// make it jqueryui sortable
	jQuery("#Slides").sortable();
	
	// remove images
	
	jQuery(".rtcamp_remove_item").click(function(){
		jQuery(this).parent().parent().remove();
	});
	
});