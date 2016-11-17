jQuery(document).ready(function($){

	jQuery('#anya_disable_responsive').closest('.option').css('display','none');

	jQuery('#anya_social_icons_style_four').parent().next().find('p').appendTo(jQuery('#anya_social_icons_style_four').parent());
	jQuery('#anya_social_icons_style_four').parent().next().remove();
	jQuery('#anya_social_icons_style_four').siblings('p').css({'clear':'both','float':'left'});

	/*limit portfolio custom permalink*/
	jQuery('#anya_portfolio_permalink').attr('maxlength',20);
	jQuery('#anya_portfolio_permalink').parent().next().css({
		'margin-top': '-15px',
		'z-index': 81,
		'background': 'white',
		'border-bottom': '1px solid #EDEDED',
		'color':'#999'
	});

	/* header style type */
	jQuery('#anya_header_style_type').parent().css('display','none');
	jQuery('#anya_header_style_type option').each(function(e){
		if (jQuery(this).is(':selected')){
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container selected"><img class="style-'+e+'" src="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" alt="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" /></div>');
		} else {
			jQuery(this).parents('.sub-navigation-container').append('<div class="screenshot_container"><img class="style-'+e+'" src="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" alt="'+jQuery('#templatepath').html()+'/images/header-style'+parseInt(e+1,10)+'.png" /></div>');	
		}
	});
	jQuery('#anya_header_style_type').parents('.sub-navigation-container').on("click", "img", function(){
		var idx = jQuery(this).attr('class').split('le-');
		jQuery('#anya_header_style_type').val( jQuery('#anya_header_style_type option').eq(idx[1]).val() );
		jQuery(this).parent().addClass('selected').siblings().removeClass('selected');
	});
	/* endof header style type */

	var def_sidebars = jQuery('#sidebar_name_list').html();

	jQuery('#tab_navigation-9-customcss textarea').keydown(function(e) {
	    if(e.keyCode === 9) { // tab was pressed
	        // get caret position/selection
	        var start = this.selectionStart;
	        var end = this.selectionEnd;
	
	        var $this = $(this);
	        var value = $this.val();
	
	        $this.val(value.substring(0, start)
	                    + "\t"
	                    + value.substring(end));
	
	        this.selectionStart = this.selectionEnd = start + 1;
	        e.preventDefault();
	    }
	});

	jQuery('#anya_export_options_button').css('top',0).parent().find('br').remove();

	jQuery('#anya_import_options_button').parent().append('<a class="des-button custom-option-button" style="position: relative; float: left; clear: both; margin-top: 20px;" id="anya_apply_imported_settings_button" ><span>Apply Settings</span></a>');
	jQuery('#anya_import_options_button').siblings('.des-button').click(function(){
		var confirm = window.confirm("This will replace all your panel options.\n\rAre you sure?");
		if (confirm==true){
		 	var xmlPath = jQuery('#anya_import_options').val();
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            data: {
	                xmlPath: xmlPath
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
		}
	});
	jQuery('#anya_reset_options_button').unbind().css({
		'position':'relative',
		'float':'left',
		'display':'inline-block',
		'clear':'both'
	});
	jQuery('#anya_reset_options_button').siblings('ul').css('display','none');
	jQuery('#anya_reset_options_button').click(function(e){
		e.stopPropagation();
		e.preventDefault();
		var confirm = window.confirm("Are you sure?");
		if (confirm == true){
		 	var xmlPath = jQuery('#templatepath').html()+"/anya_original_panel_options.xml";
			var url = jQuery('#templatepath').html()+"/lib/script/loadSettings.php";
			jQuery.ajax({
	            url: url,
	            dataType: "json",
	            data: {
	                xmlPath: xmlPath
	            },
	            error: function () {
	                //b.removeClass( "des-validating")
	            },
	            success: function (c) {
	            	window.location = window.location;
	            }
	        });
	        jQuery(this).siblings('ul').remove();
		} else {
			return false;
		}
	});
	
	/*
var _default_header_style_type = jQuery('#anya_header_style_type').val();
	if (_default_header_style_type === "style4"){
		jQuery('#anya_menu_background_color').parent().fadeIn(500).removeClass('optoff');
	} else {
		//jQuery('#anya_menu_uppercase').parent().fadeOut(500).addClass('optoff');
		jQuery('#anya_menu_background_color').parent().fadeOut(500).addClass('optoff');
	}
	jQuery('#anya_header_style_type').change(function(){
		var _default_header_style_type = jQuery('#anya_header_style_type').val();
		if (_default_header_style_type === "style4"){
			//jQuery('#anya_menu_uppercase').parent().fadeIn(500).removeClass('optoff');
			jQuery('#anya_menu_background_color').parent().fadeIn(500).removeClass('optoff');
		} else {
			//jQuery('#anya_menu_uppercase').parent().fadeOut(500).addClass('optoff');
			jQuery('#anya_menu_background_color').parent().fadeOut(500).addClass('optoff');
		}
	});
*/
	
	var _default_animate_thumbnails = jQuery('#anya_animate_thumbnails').val();
	if (_default_animate_thumbnails === "on"){
		jQuery('#anya_thumbnails_effect').parent().fadeIn(500);
	} else {
		jQuery('#anya_thumbnails_effect').parent().fadeOut(500);
	}
	jQuery('#anya_animate_thumbnails').change(function(){
		if (_default_animate_thumbnails === "on"){
			jQuery('#anya_thumbnails_effect').parent().fadeIn(500);
		} else {
			jQuery('#anya_thumbnails_effect').parent().fadeOut(500);
		}
	});
	
	var _default_body_shadow = jQuery('#anya_body_shadow').val();
	if (_default_body_shadow === "on"){
		jQuery('#anya_body_shadow').parent().next().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#anya_body_shadow').parent().next().fadeOut(500).addClass('optoff');
	}
	jQuery('#anya_body_shadow').change(function(){
		if (_default_body_shadow === "on"){
			jQuery('#anya_body_shadow').parent().next().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#anya_body_shadow').parent().next().fadeOut(500).addClass('optoff');
		}
	});
	
	//body background type
	var _default_body_background = jQuery('#anya_body_type').val();
	switch(_default_body_background){
		case "image":
			jQuery('#anya_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#anya_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#anya_body_type').parent().next().next().fadeOut(500).addClass('optoff');
			jQuery('#anya_body_type').parent().next().fadeIn(500).removeClass('optoff');
			jQuery('#anya_body_image').siblings('.previewimg').remove();
			if (jQuery('#anya_body_image').val() != ''){
				jQuery('#anya_body_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_body_image").val()+'">');
			}
			break;
		case "color":
			jQuery('#anya_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#anya_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
			jQuery('#anya_body_type').parent().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#anya_body_type').parent().next().fadeOut(500).addClass('optoff');
			break;
		case "pattern": case "custom_pattern":
			jQuery('#anya_body_type').parent().next().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#anya_body_type').parent().next().next().next().fadeIn(500).removeClass('optoff');
			jQuery('#anya_body_type').parent().next().next().fadeOut(500).addClass('optoff');
			jQuery('#anya_body_type').parent().next().fadeOut(500).addClass('optoff');
			break;
	}
	jQuery('#anya_body_type').change(function(){
		var _default_body_background = jQuery('#anya_body_type').val();
		switch(_default_body_background){
			case "image":
				jQuery('#anya_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#anya_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#anya_body_type').parent().next().next().fadeOut(500).addClass('optoff');
				jQuery('#anya_body_type').parent().next().fadeIn(500).removeClass('optoff');
				jQuery('#anya_body_image').siblings('.previewimg').remove();
				if (jQuery('#anya_body_image').val() != ''){
					jQuery('#anya_body_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_body_image").val()+'">');
				}
				break;
			case "color":
				jQuery('#anya_body_type').parent().next().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#anya_body_type').parent().next().next().next().fadeOut(500).addClass('optoff');
				jQuery('#anya_body_type').parent().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#anya_body_type').parent().next().fadeOut(500).addClass('optoff');
				break;
			case "pattern": case "custom_pattern":
				jQuery('#anya_body_type').parent().next().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#anya_body_type').parent().next().next().next().fadeIn(500).removeClass('optoff');
				jQuery('#anya_body_type').parent().next().next().fadeOut(500).addClass('optoff');
				jQuery('#anya_body_type').parent().next().fadeOut(500).addClass('optoff');
				break;
		}
	});
	
	//show twitter newsletter footer options
	var _default_show_twitter_newsletter_footer = jQuery('#anya_show_twitter_newsletter_footer').val();
	if (_default_show_twitter_newsletter_footer === "on"){
		for (var i= jQuery('#anya_show_twitter_newsletter_footer').parent().index(); i<jQuery('#anya_twitter_newsletter_borderscolor').parent().index(); i++){
			if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#anya_show_twitter_newsletter_footer').parent().index(); i<jQuery('#anya_twitter_newsletter_borderscolor').parent().index(); i++){
			jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#anya_show_twitter_newsletter_footer').change(function(){
		if (_default_show_twitter_newsletter_footer === "on"){
			for (var i= jQuery('#anya_show_twitter_newsletter_footer').parent().index(); i<jQuery('#anya_twitter_newsletter_borderscolor').parent().index(); i++){
				if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#anya_show_twitter_newsletter_footer').parent().index(); i<jQuery('#anya_twitter_newsletter_borderscolor').parent().index(); i++){
				jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	//show primary footer options
	var _default_show_primary_footer = jQuery('#anya_show_primary_footer').val();
	if (_default_show_primary_footer === "on"){
		for (var i= jQuery('#anya_show_primary_footer').parent().index(); i<jQuery('#anya_footerbg_headingscolor').parent().index(); i++){
			if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#anya_show_primary_footer').parent().index(); i<jQuery('#anya_footerbg_headingscolor').parent().index(); i++){
			jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#anya_show_primary_footer').change(function(){
		if (_default_show_primary_footer === "on"){
			for (var i= jQuery('#anya_show_primary_footer').parent().index(); i<jQuery('#anya_footerbg_headingscolor').parent().index(); i++){
				if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#anya_show_primary_footer').parent().index(); i<jQuery('#anya_footerbg_headingscolor').parent().index(); i++){
				jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	//show secondary footer options
	var _default_show_secondary_footer = jQuery('#anya_show_sec_footer').val();
	if (_default_show_secondary_footer === "on"){
		for (var i= jQuery('#anya_show_sec_footer').parent().index(); i<jQuery('#anya_sec_footerbg_paragraphscolor').parent().index(); i++){
			if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
		}
	} else {
		for (var i= jQuery('#anya_show_sec_footer').parent().index(); i<jQuery('#anya_sec_footerbg_paragraphscolor').parent().index(); i++){
			jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
		}
	}
	jQuery('#anya_show_sec_footer').change(function(){
		if (_default_show_secondary_footer === "on"){
			for (var i= jQuery('#anya_show_sec_footer').parent().index(); i<jQuery('#anya_sec_footerbg_paragraphscolor').parent().index(); i++){
				if (!jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).hasClass('optoff')) jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeIn(500);
			}
		} else {
			for (var i= jQuery('#anya_show_sec_footer').parent().index(); i<jQuery('#anya_sec_footerbg_paragraphscolor').parent().index(); i++){
				jQuery(this).closest('.sub-navigation-container').find('.option').eq(i).fadeOut(500);
			}
		}
	});
	
	var _default_contentbg_type = jQuery('#anya_contentbg_type').val();
	switch (_default_contentbg_type){
		case "color":
			jQuery('#anya_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#anya_contentbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_image').siblings('.previewimg').remove();
			if (jQuery('#anya_contentbg_image').val() != ''){
				jQuery('#anya_contentbg_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_contentbg_image").val()+'">');
			}
		break;
		case "pattern":
			jQuery('#anya_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_contentbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_contentbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#anya_contentbg_type').change(function(){
		switch (_default_contentbg_type){
			case "color":
				jQuery('#anya_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#anya_contentbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_image').siblings('.previewimg').remove();
				if (jQuery('#anya_contentbg_image').val() != ''){
					jQuery('#anya_contentbg_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_contentbg_image").val()+'">');
				}
			break;
			case "pattern":
				jQuery('#anya_contentbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_contentbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_contentbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}	
	});
	
	
	var _default_headerbg_type = jQuery('#anya_headerbg_type').val();
	switch (_default_headerbg_type){
		case "color":
			jQuery('#anya_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_headerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#anya_headerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#anya_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_headerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_headerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#anya_headerbg_type').change(function(){
		switch (_default_headerbg_type){
			case "color":
				jQuery('#anya_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_headerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#anya_headerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_headerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_headerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#anya_headerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_headerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_headerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_headerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_toppanelbg_type = jQuery('#anya_toppanelbg_type').val();
	switch (_default_toppanelbg_type){
		case "color":
			jQuery('#anya_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#anya_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#anya_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#anya_toppanelbg_type').change(function(){
		switch (_default_toppanelbg_type){
			case "color":
				jQuery('#anya_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_toppanelbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#anya_toppanelbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_toppanelbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_toppanelbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#anya_toppanelbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_toppanelbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_toppanelbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_toppanelbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_sec_footerbg_type = jQuery('#anya_sec_footerbg_type').val();
	switch (_default_sec_footerbg_type){
		case "color":
			jQuery('#anya_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#anya_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#anya_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#anya_sec_footerbg_type').change(function(){
		switch (_default_sec_footerbg_type){
			case "color":
				jQuery('#anya_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_sec_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#anya_sec_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_sec_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_sec_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#anya_sec_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_sec_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_sec_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_sec_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	
	var _default_footerbg_type = jQuery('#anya_footerbg_type').val();
	switch (_default_footerbg_type){
		case "color":
			jQuery('#anya_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#anya_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#anya_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#anya_footerbg_type').change(function(){
		switch (_default_footerbg_type){
			case "color":
				jQuery('#anya_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_footerbg_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#anya_footerbg_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_footerbg_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_footerbg_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#anya_footerbg_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_footerbg_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_footerbg_pattern').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_footerbg_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	var _default_twitter_newsletter_type = jQuery('#anya_twitter_newsletter_type').val();
	switch (_default_twitter_newsletter_type){
		case "color":
			jQuery('#anya_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_twitter_newsletter_color').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "image":
			jQuery('#anya_twitter_newsletter_image').closest('.option').removeClass('optoff').fadeIn(500);
			jQuery('#anya_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);	
			jQuery('#anya_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
		break;
		case "pattern":
			jQuery('#anya_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
			jQuery('#anya_twitter_newsletter_pattern').closest('.option').removeClass('optoff').fadeIn(500);		
			jQuery('#anya_twitter_newsletter_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
		break;
	}
	jQuery('#anya_twitter_newsletter_type').change(function(){
		switch (_default_twitter_newsletter_type){
			case "color":
				jQuery('#anya_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_twitter_newsletter_color').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "image":
				jQuery('#anya_twitter_newsletter_image').closest('.option').removeClass('optoff').fadeIn(500);
				jQuery('#anya_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_twitter_newsletter_pattern').closest('.option').addClass('optoff').fadeOut(500);	
				jQuery('#anya_twitter_newsletter_custom_pattern').closest('.option').addClass('optoff').fadeOut(500);
			break;
			case "pattern":
				jQuery('#anya_twitter_newsletter_image').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_twitter_newsletter_color').closest('.option').addClass('optoff').fadeOut(500);
				jQuery('#anya_twitter_newsletter_pattern').closest('.option').removeClass('optoff').fadeIn(500);		
				jQuery('#anya_twitter_newsletter_custom_pattern').closest('.option').removeClass('optoff').fadeIn(500);
			break;
		}
	});
	
	//style > body - body layout type
	var _default_body_layout_type = jQuery('#anya_body_layout_type').val();
	if (_default_body_layout_type === "full"){
		jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().next().fadeOut(500);
		jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().fadeOut(500);
		jQuery('#anya_body_layout_type').parent().next().next().next().next().next().fadeOut(500);
		jQuery('#anya_body_layout_type').parent().next().next().next().next().fadeOut(500);
		jQuery('#anya_body_layout_type').parent().next().next().next().fadeOut(500);
		jQuery('#anya_body_layout_type').parent().next().next().fadeOut(500);
		jQuery('#anya_body_layout_type').parent().next().fadeOut(500);
	} else {
		if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().next().next().next().next().fadeIn(500);
		if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().next().next().next().fadeIn(500);
		if (!jQuery('#anya_body_layout_type').parent().next().next().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().next().next().fadeIn(500);
		if (!jQuery('#anya_body_layout_type').parent().next().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().next().fadeIn(500);
		if (!jQuery('#anya_body_layout_type').parent().next().hasClass('optoff'))
			jQuery('#anya_body_layout_type').parent().next().fadeIn(500);
	}
	jQuery('#anya_body_layout_type').change(function(){
		if (_default_body_layout_type === "full"){
			jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_body_layout_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_body_layout_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#anya_body_layout_type').parent().next().next().next().fadeOut(500);
			jQuery('#anya_body_layout_type').parent().next().next().fadeOut(500);
			jQuery('#anya_body_layout_type').parent().next().fadeOut(500);
		} else {
			if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().next().next().next().next().fadeIn(500);
			if (!jQuery('#anya_body_layout_type').parent().next().next().next().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().next().next().next().fadeIn(500);
			if (!jQuery('#anya_body_layout_type').parent().next().next().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().next().next().fadeIn(500);
			if (!jQuery('#anya_body_layout_type').parent().next().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().next().fadeIn(500);
			if (!jQuery('#anya_body_layout_type').parent().next().hasClass('optoff'))
				jQuery('#anya_body_layout_type').parent().next().fadeIn(500);
		}
	});
	
	//style > header - background type
	var _default_header_bkg = jQuery('#anya_header_type').val();
	switch (_default_header_bkg){
		case "without": 
			jQuery('#anya_header_type').parent().next().next().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().fadeOut(500);
			break;
		case "none": case "border":
			jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().fadeOut(500);
			break;
		case "image":
			jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().fadeIn(500);
			jQuery('#anya_header_image').parent().find('.previewimg').remove();
			if (jQuery('#anya_header_image').val() != ""){
				jQuery('#anya_header_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_header_image").val()+'">');
			}
			break;
		case "color":
			jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().fadeIn(500);
			jQuery('#anya_header_type').parent().next().fadeOut(500);
			break;
		case "pattern":
			jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().next().fadeIn(500);
			jQuery('#anya_header_type').parent().next().next().next().fadeIn(500);
			jQuery('#anya_header_type').parent().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().fadeOut(500);
			break;
		case "banner":
			jQuery('#anya_header_type').parent().next().next().next().next().next().fadeIn(500);
			jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().next().fadeOut(500);
			jQuery('#anya_header_type').parent().next().fadeOut(500);
			break;
	}
	if (_default_header_bkg == "border" || _default_header_bkg == "image" || _default_header_bkg == "pattern" || _default_header_bkg == "banner" || _default_header_bkg == "color"){
		jQuery('#anya_header_type').parent().next().next().next().next().next().next().next().fadeIn(500);
		jQuery('#anya_header_type').parent().next().next().next().next().next().next().fadeIn(500);
	}
	jQuery('#anya_header_type').change(function(){
		var _default_header_bkg = jQuery('#anya_header_type').val();
		switch (_default_header_bkg){
			case "without": 
				jQuery('#anya_header_type').parent().next().next().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().fadeOut(500);
				break;
			case "none": case "border":
				jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().fadeOut(500);
				break;
			case "image":
				jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().fadeIn(500);
				jQuery('#anya_header_image').parent().find('.previewimg').remove();
				if (jQuery('#anya_header_image').val() != ""){
					jQuery('#anya_header_image').parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_header_image").val()+'">');
				}
				break;
			case "color":
				jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().fadeIn(500);
				jQuery('#anya_header_type').parent().next().fadeOut(500);
				break;
			case "pattern":
				jQuery('#anya_header_type').parent().next().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().next().fadeIn(500);
				jQuery('#anya_header_type').parent().next().next().next().fadeIn(500);
				jQuery('#anya_header_type').parent().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().fadeOut(500);
				break;
			case "banner":
				jQuery('#anya_header_type').parent().next().next().next().next().next().fadeIn(500);
				jQuery('#anya_header_type').parent().next().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().next().fadeOut(500);
				jQuery('#anya_header_type').parent().next().fadeOut(500);
				break;
		}
		if (_default_header_bkg == "border" || _default_header_bkg == "image" || _default_header_bkg == "pattern" || _default_header_bkg == "banner" || _default_header_bkg == "color"){
			jQuery('#anya_header_type').parent().next().next().next().next().next().next().next().fadeIn(500);
			jQuery('#anya_header_type').parent().next().next().next().next().next().next().fadeIn(500);
		}
	});	
	
	//google fonts
	var _default_google_fonts = jQuery('#anya_enable_google_fonts').val();
	if (_default_google_fonts === "on"){
		jQuery('#anya_enable_google_fonts').parent().next().fadeIn(500);
	} else {
		jQuery('#anya_enable_google_fonts').parent().next().fadeOut(500);
	}
	jQuery('#anya_enable_google_fonts').change(function(){
		if (_default_google_fonts === "on"){
			jQuery('#anya_enable_google_fonts').parent().next().fadeIn(500);
		} else {
			jQuery('#anya_enable_google_fonts').parent().next().fadeOut(500);
		}		
	});
	
	//General > Projects > Enlarge pics
	var _default_proj_layout = jQuery('#anya_single_layout').val(); 
	if (_default_proj_layout === "fullwidth_slider"){
		jQuery('#anya_projects_enlarge_images').parent('.option').fadeOut(500);
	} else {
		jQuery('#anya_projects_enlarge_images').parent('.option').fadeIn(500);
	}
	jQuery('#anya_single_layout').change(function(e){
		if (_default_proj_layout === "fullwidth_slider"){
			jQuery('#anya_projects_enlarge_images').parent('.option').fadeOut(500);
		} else {
			jQuery('#anya_projects_enlarge_images').parent('.option').fadeIn(500);
		}
	});
	
	//General > Projects > Open|Close Cats
	var _default_enable_open_close_categories = jQuery('#anya_enable_open_close_categories').val();
	if (_default_enable_open_close_categories === "on"){
		jQuery('#anya_categories_initial_state').parent().fadeIn(500).removeClass('optoff');
	} else {
		jQuery('#anya_categories_initial_state').parent().fadeOut(500).addClass('optoff');
	}
	jQuery('#anya_enable_open_close_categories').change(function(e){
		var _default_enable_open_close_categories = jQuery('#anya_enable_open_close_categories').val();
		if (_default_enable_open_close_categories === "on"){
			jQuery('#anya_categories_initial_state').parent().fadeIn(500).removeClass('optoff');
		} else {
			jQuery('#anya_categories_initial_state').parent().fadeOut(500).addClass('optoff');
		}	
	});
	
	//FOOTER RIGHT CONTENT OPTIONS
	var _default_footer_right = jQuery('#anya_footer_right_content').val();
	if (_default_footer_right === "text"){
		jQuery('#anya_footer_right_text').parent('.option').fadeIn(500);
		jQuery('#anya_footer_social_icons_style').parent('.option').fadeOut(500);
	} else {
		if (_default_footer_right === "social"){
			jQuery('#anya_footer_social_icons_style').parent('.option').fadeIn(500);
			jQuery('#anya_footer_right_text').parent('.option').fadeOut(500);
		} else {
			jQuery('#anya_footer_right_text').parent('.option').fadeOut(500);	
			jQuery('#anya_footer_social_icons_style').parent('.option').fadeOut(500);
		}
	}
	jQuery('#anya_footer_right_content').change(function(e){
		if (_default_footer_right === "text"){
			jQuery('#anya_footer_right_text').parent('.option').fadeIn(500);
			jQuery('#anya_footer_social_icons_style').parent('.option').fadeOut(500);
		} else {
			if (_default_footer_right === "social"){
				jQuery('#anya_footer_social_icons_style').parent('.option').fadeIn(500);
				jQuery('#anya_footer_right_text').parent('.option').fadeOut(500);
			} else {
				jQuery('#anya_footer_right_text').parent('.option').fadeOut(500);	
				jQuery('#anya_footer_social_icons_style').parent('.option').fadeOut(500);
			}
		}	
	});
	
	var tp_cols_default = jQuery('#anya_toppanel_number_cols').val();	  
 	if(tp_cols_default == "three"){
 		jQuery("#anya_toppanel_columns_order").parent().fadeIn(500);
 		jQuery("#anya_toppanel_columns_order_four").parent().fadeOut(500);
 	} else if (tp_cols_default == "four"){
 		jQuery("#anya_toppanel_columns_order_four").parent().fadeIn(500);
 		jQuery("#anya_toppanel_columns_order").parent().fadeOut(500);
 	} else {
 		jQuery("#anya_toppanel_columns_order").parent().fadeOut(500);
 		jQuery("#anya_toppanel_columns_order_four").parent().fadeOut(500);
 	}
 	
	jQuery('#anya_toppanel_number_cols').change(function(e){
		if(tp_cols_default == "three"){
	 		jQuery("#anya_toppanel_columns_order").parent().fadeIn(500);
	 		jQuery("#anya_toppanel_columns_order_four").parent().fadeOut(500);
	 	} else if (tp_cols_default == "four"){
	 		jQuery("#anya_toppanel_columns_order_four").parent().fadeIn(500);
	 		jQuery("#anya_toppanel_columns_order").parent().fadeOut(500);
	 	} else {
	 		jQuery("#anya_toppanel_columns_order").parent().fadeOut(500);
	 		jQuery("#anya_toppanel_columns_order_four").parent().fadeOut(500);
	 	}
 	});
 	
 	//WIDGETS AREA
	var _default_widgets_area = jQuery('#anya_enable_widgets_area').val();
	var indexWidget = parseInt(jQuery('#anya_enable_widgets_area').parents('.option').index(),10);
	if (_default_widgets_area === "on"){
		for (var i=1; i<4; i++){
			jQuery('#anya_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
		}
		jQuery('#anya_toppanel_number_cols').change();
	} else {
		for (var i=1; i<4; i++){
			jQuery('#anya_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
		}
	}
	jQuery('#anya_enable_widgets_area').change(function(e){
		if (_default_widgets_area === "on"){
			for (var i=1; i<4; i++){
				jQuery('#anya_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeIn(500);	
			}
			jQuery('#anya_toppanel_number_cols').change();
		} else {
			for (var i=1; i<4; i++){
				jQuery('#anya_enable_widgets_area').parents('.sub-navigation-container').find('.option:eq('+(indexWidget+i)+')').fadeOut(500);	
			}
		}
	});
	
	//INFO ABOVE MENU (now known as Enable Info/Social bar)
	var _default_info_above_menu = jQuery('#anya_info_above_menu').val();
	if (_default_info_above_menu === "on"){
		for (var i=jQuery('#anya_info_above_menu').parent().index()+1; i< jQuery('#anya_social_icons_style').parent().index()+1; i++){
			jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
		}
  	} else {
		for (var i=jQuery('#anya_info_above_menu').parent().index()+1; i< jQuery('#anya_social_icons_style').parent().index()+1; i++){
			jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
		}
  	}
  	jQuery('#anya_info_above_menu').change(function(e){
	  	if (_default_info_above_menu === "on"){
			for (var i=jQuery('#anya_info_above_menu').parent().index()+1; i< jQuery('#anya_social_icons_style').parent().index()+1; i++){
				jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
			}
	  	} else {
			for (var i=jQuery('#anya_info_above_menu').parent().index()+1; i< jQuery('#anya_social_icons_style').parent().index()+1; i++){
				jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
			}
	  	}
  	});
  	
  	//SOCIAL ICONS 
  	var _default_enable_socials = jQuery('#anya_enable_socials').val();
  	if (_default_enable_socials === "on"){
		jQuery('#anya_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeIn(500);
		});
  	} else {
	  	jQuery('#anya_enable_socials').parents('.option').find('~ .option').each(function(){
			jQuery(this).fadeOut(500);
		});
  	}
	jQuery('#anya_enable_socials').change(function(e){
		var _default_enable_socials = jQuery('#anya_enable_socials').val();
	  	if (_default_enable_socials === "on"){
			jQuery('#anya_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeIn(500);
			});
	  	} else {
		  	jQuery('#anya_enable_socials').parents('.option').find('~ .option').each(function(){
				jQuery(this).fadeOut(500);
			});
	  	}
	});

	// TOP PANEL & SOCIAL BAR MAMBO JAMBO
	var _default_top_panel = jQuery('#anya_enable_top_panel').val();
	if (_default_top_panel === "on"){
		for (var i=jQuery('#anya_enable_top_panel').parent().index()+1; i< jQuery('#anya_toppanel_headingscolor').parent().index()+1; i++){
			if (!jQuery('#tab_navigation-2-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
		}
	} else {
		for (var i=jQuery('#anya_enable_top_panel').parent().index()+1; i< jQuery('#anya_toppanel_headingscolor').parent().index()+1; i++){
			jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
		}
  	}
	jQuery('#anya_enable_top_panel').change(function(e){
	  	if (_default_top_panel === "on"){
			for (var i=jQuery('#anya_enable_top_panel').parent().index()+1; i< jQuery('#anya_toppanel_headingscolor').parent().index()+1; i++){
				if (!jQuery('#tab_navigation-2-header').children().eq(i).hasClass('optoff')) jQuery('#tab_navigation-2-header').children().eq(i).fadeIn(500);
			}
		} else {
			for (var i=jQuery('#anya_enable_top_panel').parent().index()+1; i< jQuery('#anya_toppanel_headingscolor').parent().index()+1; i++){
				jQuery('#tab_navigation-2-header').children().eq(i).fadeOut(500);
			}
	  	}
	});
	
	
	//suggested colors
	jQuery('#tab_navigation-2-general a.style-box').each(function(){
		jQuery(this).click(function(){
			jQuery('#anya_style_color')
				.attr('value',jQuery(this).attr('title'))
				.siblings('.color-preview').css('background-color', '#'+jQuery(this).attr('title'));
		});
	});
	
	if (jQuery("#anya_favicon").val() != ""){
		jQuery("#anya_logo_retina_image_url").parent().find('.previewimg').remove();
		jQuery("#anya_favicon").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_favicon").val()+'">');
 	}

	//LOGOTYPE
	var _default  = jQuery('#anya_logo_type').val();
  
 	if(_default == "text"){
 		jQuery("#anya_logo_image_url, #anya_logo_retina_image_url, #anya_logo_width").parent().fadeOut(500);		
 		jQuery("#anya_logo_text, #anya_logo_bganya_style, #anya_logo_font, #anya_logo_size, #anya_logo_color, #anya_logo_font_style").parent().fadeIn(500);
 	} else {
 		jQuery("#anya_logo_text, #anya_logo_bganya_style, #anya_logo_font, #anya_logo_size, #anya_logo_color, #anya_logo_font_style").parent().fadeOut(500);
 		jQuery("#anya_logo_image_url, #anya_logo_retina_image_url, #anya_logo_width").parent().fadeIn(500);
 		if (jQuery("#anya_logo_image_url").val() != ""){
 			jQuery("#anya_logo_image_url").siblings('.previewimg').remove();
	 		jQuery("#anya_logo_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_logo_image_url").val()+'">');
 		}
 		if (jQuery("#anya_logo_retina_image_url").val() != ""){
 			jQuery("#anya_logo_retina_image_url").siblings('.previewimg').remove();
	 		jQuery("#anya_logo_retina_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_logo_retina_image_url").val()+'">');
 		}
 	}
  
 	// observe changes
  	jQuery('#anya_logo_type').change(function(e){
    	if(_default == "text"){
	 		jQuery("#anya_logo_image_url, #anya_logo_retina_image_url, #anya_logo_width").parent().fadeOut(500);		
	 		jQuery("#anya_logo_text, #anya_logo_bganya_style, #anya_logo_font, #anya_logo_size, #anya_logo_color, #anya_logo_font_style").parent().fadeIn(500);
	 	} else {
	 		jQuery("#anya_logo_text, #anya_logo_bganya_style, #anya_logo_font, #anya_logo_size, #anya_logo_color, #anya_logo_font_style").parent().fadeOut(500);
	 		jQuery("#anya_logo_image_url, #anya_logo_retina_image_url, #anya_logo_width").parent().fadeIn(500);
	 		if (jQuery("#anya_logo_image_url").val() != ""){
	 			jQuery("#anya_logo_image_url").siblings('.previewimg').remove();
		 		jQuery("#anya_logo_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_logo_image_url").val()+'">');
	 		}
	 		if (jQuery("#anya_logo_retina_image_url").val() != ""){
	 			jQuery("#anya_logo_retina_image_url").siblings('.previewimg').remove();
		 		jQuery("#anya_logo_retina_image_url").parent().append('<img class="previewimg" style="position: relative; float: left; display: inline-block; clear: left; left: 220px; margin-top: 10px; max-width:300px;" src="'+jQuery("#anya_logo_retina_image_url").val()+'">');
	 		}
	 	}
	});
  
  	// SLOGAN
	var def_slogan = jQuery('#anya_slogan').val();
	if (def_slogan == "off")	
		jQuery('#anya_slogan_font, #anya_slogan_font_style, #anya_slogan_size, #anya_slogan_color').parent().fadeOut(500);
	else
		jQuery('#anya_slogan_font, #anya_slogan_font_style, #anya_slogan_size, #anya_slogan_color').parent().fadeIn(500);

	jQuery('#anya_slogan').change(function(e){
		if (def_slogan == "off")	
			jQuery('#anya_slogan_font, #anya_slogan_font_style, #anya_slogan_size, #anya_slogan_color').parent().fadeOut(500);
		else
			jQuery('#anya_slogan_font, #anya_slogan_font_style, #anya_slogan_size, #anya_slogan_color').parent().fadeIn(500);
 	});
  
	// 404
	var def_notfound = jQuery('#anya_404_error_image').val();
	if (def_notfound == "off")	
		jQuery('#anya_404_error_image_url').parent().fadeOut(500);
	else
		jQuery('#anya_404_error_image_url').parent().fadeIn(500);

	jQuery('#anya_404_error_image').change(function(e){
		if (def_notfound == "off")	
			jQuery('#anya_404_error_image_url').parent().fadeOut(500);
		else
			jQuery('#anya_404_error_image_url').parent().fadeIn(500);
 	});
 	
 	//HOMEPAGE LAYOUT
 	jQuery("#anya_homepage_static_image_url").parent().fadeOut(500);
 	
 	jQuery('#anya_homepage_slider').change(function(e){
 		if(jQuery(this).val() == 'static')
 			jQuery("#anya_homepage_static_image_url").parent().fadeIn(500);
 		else
 			jQuery("#anya_homepage_static_image_url").parent().fadeOut(500);
 			
 	});
 	 	
 	//CONTACT FORM TEXTAREA
 	jQuery("textarea[name=walker_contacts_email_default_content]").css("width", "440px").css("height", "270px");
 	
 	
 	//FOOTER
 	var cols_default  = jQuery('#anya_footer_number_cols').val();
	  
	 	if(cols_default == "three"){
	 		jQuery("#anya_footer_columns_order").parent().fadeIn(500);
	 		jQuery("#anya_footer_columns_order_four").parent().fadeOut(500);
	 	} else if (cols_default == "four"){
	 		jQuery("#anya_footer_columns_order_four").fadeIn(500);
	 		jQuery("#anya_footer_columns_order").parent().fadeOut(500);
	 	} else {
	 		jQuery("#anya_footer_columns_order").parent().fadeOut(500);
	 		jQuery("#anya_footer_columns_order_four").parent().fadeIn(500);
	 	}
	 	
	jQuery('#anya_footer_number_cols').change(function(e){
		if(cols_default == "three"){
	 		jQuery("#anya_footer_columns_order").parent().fadeIn(500);
	 		jQuery("#anya_footer_columns_order_four").parent().fadeOut(500);
	 	} else if (cols_default == "four"){
	 		jQuery("#anya_footer_columns_order_four").parent().fadeIn(500);
	 		jQuery("#anya_footer_columns_order").parent().fadOut(500);
	 	} else {
	 		jQuery("#anya_footer_columns_order").parent().fadeOut(500);
	 		jQuery("#anya_footer_columns_order_four").parent().fadeOut(500);
	 	}
 	});
  
  
  // continuous check for changed value
  setInterval(function () {
  
  	/*
if (jQuery('#anya_header_style_type').val() != _default_header_style_type){
	  	_default_header_style_type = jQuery('#anya_header_style_type').val();
	  	jQuery('#anya_header_style_type').change();
  	}
*/

	//fixed menu
	/*
if (jQuery('#anya_fixed_menu').val() != _default_fixed_menu){
	  	_default_fixed_menu = jQuery('#anya_fixed_menu').val();
	  	jQuery('#anya_fixed_menu').change();
  	}
*/

	//show secondary footer options
  	if (jQuery('#anya_show_sec_footer').val() != _default_show_secondary_footer){
	  	_default_show_secondary_footer = jQuery('#anya_show_sec_footer').val();
	  	jQuery('#anya_show_sec_footer').change();
  	}
	
	//show primary footer options
  	if (jQuery('#anya_show_primary_footer').val() != _default_show_primary_footer){
	  	_default_show_primary_footer = jQuery('#anya_show_primary_footer').val();
	  	jQuery('#anya_show_primary_footer').change();
  	}

  	//body type options
  	if (jQuery('#anya_contentbg_type').val() != _default_contentbg_type){
	  	_default_contentbg_type = jQuery('#anya_contentbg_type').val();
	  	jQuery('#anya_contentbg_type').change();
  	}
  
  	//show twitter newsletter footer options
  	if (jQuery('#anya_show_twitter_newsletter_footer').val() != _default_show_twitter_newsletter_footer){
	  	_default_show_twitter_newsletter_footer = jQuery('#anya_show_twitter_newsletter_footer').val();
	  	jQuery('#anya_show_twitter_newsletter_footer').change();
  	}
  	
  	// header type
  	if (jQuery('#anya_headerbg_type').val() != _default_headerbg_type){
	  	_default_headerbg_type = jQuery('#anya_headerbg_type').val();
	  	jQuery('#anya_headerbg_type').change();
  	}
  	
  	// show header & top contents type
  	if (jQuery('#anya_toppanelbg_type').val() != _default_toppanelbg_type){
	  	_default_toppanelbg_type = jQuery('#anya_toppanelbg_type').val();
	  	jQuery('#anya_toppanelbg_type').change();
  	}
  	
  	// secondary footer type opts
  	if (jQuery('#anya_sec_footerbg_type').val() != _default_sec_footerbg_type){
	  	_default_sec_footerbg_type = jQuery('#anya_sec_footerbg_type').val();
	  	jQuery('#anya_sec_footerbg_type').change();
  	}
  	
  	// primary footer type opts
  	if (jQuery('#anya_footerbg_type').val() != _default_footerbg_type){
	  	_default_footerbg_type = jQuery('#anya_footerbg_type').val();
	  	jQuery('#anya_footerbg_type').change();
  	}
  	
  	// twitter newsletter type opts 
  	if (jQuery('#anya_twitter_newsletter_type').val() != _default_twitter_newsletter_type){
	  	_default_twitter_newsletter_type = jQuery('#anya_twitter_newsletter_type').val();
	  	jQuery('#anya_twitter_newsletter_type').change();
  	}
  	
  	// thumbails animate
  	if (jQuery('#anya_animate_thumbnails').val() != _default_animate_thumbnails){
	  	_default_animate_thumbnails = jQuery('#anya_animate_thumbnails').val();
	  	jQuery('#anya_animate_thumbnails').change();
  	}
  	
  	//body shadow
  	if (jQuery('#anya_body_shadow').val() != _default_body_shadow){
	  	_default_body_shadow = jQuery('#anya_body_shadow').val();
	  	jQuery('#anya_body_shadow').change();
  	}
  
  	//body background type
  	if (jQuery('#anya_body_type').val() != _default_body_background){
	  	_default_body_background = jQuery('#anya_body_type').val();
	  	jQuery('#anya_body_type').change();
  	}
  
  	//body layout page
  	if (jQuery('#anya_body_layout_type').val() != _default_body_layout_type){
	  	_default_body_layout_type = jQuery('#anya_body_layout_type').val();
	  	jQuery('#anya_body_layout_type').change();
  	}
  
  	//header background type
  	if (jQuery('#anya_header_type').val() != _default_header_bkg){
	  	_default_header_bkg = jQuery('#anya_header_type').val();
	  	jQuery('#anya_header_type').change();
  	}
  
  	//google fonts
  	if (jQuery('#anya_enable_google_fonts').val() != _default_google_fonts){
	  	_default_google_fonts = jQuery('#anya_enable_google_fonts').val();
	  	jQuery('#anya_enable_google_fonts').change();
  	}
  
  	//projects enlarge pics
  	if (jQuery('#anya_single_layout').val() != _default_proj_layout){
	 	_default_proj_layout = jQuery('#anya_single_layout').val();
	 	jQuery('#anya_single_layout').change();
  	}
  	
  	//projects open|close
  	if (jQuery('#anya_enable_open_close_categories').val() != _default_enable_open_close_categories){
	 	_default_enable_open_close_categories = jQuery('#anya_enable_open_close_categories').val();
	 	jQuery('#anya_enable_open_close_categories').change();
  	}
  
  	//FOOTER RIGHT CONTENT
    if (jQuery('#anya_footer_right_content').val() != _default_footer_right){
	    _default_footer_right = jQuery('#anya_footer_right_content').val();
	    jQuery('#anya_footer_right_content').change();
    }
    
    //TOPPANEL
    if ( jQuery('#anya_enable_top_panel').val() != _default_top_panel ) {
    	_default_top_panel = jQuery('#anya_enable_top_panel').val();
		jQuery('#anya_enable_top_panel').change();    
    }
    
    //WIDGETS AREA
    if (jQuery('#anya_enable_widgets_area').val() != _default_widgets_area){
	    _default_widgets_area = jQuery('#anya_enable_widgets_area').val();
	    jQuery('#anya_enable_widgets_area').change();
    }
    
    //INFO ABOVE MENU
    if (jQuery('#anya_info_above_menu').val() != _default_info_above_menu){
	    _default_info_above_menu = jQuery('#anya_info_above_menu').val();
	    jQuery('#anya_info_above_menu').change();
    }
    
    //SOCIAL ICONS
    if (jQuery('#anya_enable_socials').val() != _default_enable_socials){
	    _default_enable_socials = jQuery('#anya_enable_socials').val();
	    jQuery('#anya_enable_socials').change();
    }
    
    //LOGOTYPE
    if ( jQuery('#anya_logo_type').val() != _default ) {
    	_default  = jQuery('#anya_logo_type').val();
		jQuery('#anya_logo_type').change();    
    }  
    
    //SLOGAN
    if ( jQuery('#anya_slogan').val() != def_slogan ) {
    	def_slogan  = jQuery('#anya_slogan').val();
		jQuery('#anya_slogan').change();    
    }
    
    //404
    if (jQuery('#anya_404_error_image').val() != def_notfound){
		def_notfound = jQuery('#anya_404_error_image').val();
		jQuery('#anya_404_error_image').change();
    }
    
    //SIDEBAR
    if (jQuery('#sidebar_name_list').html() != def_sidebars){
	    var sidebars = "";
	    jQuery('#sidebar_name_list li').each(function(){
		    sidebars += jQuery(this).children('span').html()+"|*|";
	    });
	    jQuery('input#des_sidebar_name_names').val(sidebars);
	    def_sidebars = jQuery('#sidebar_name_list').html();
    }
    
    //FOOTER
    if ( jQuery('#anya_footer_number_cols').val() != cols_default ) {
    	cols_default  = jQuery('#anya_footer_number_cols').val();
		jQuery('#anya_footer_number_cols').change();    
    }
    
    //TOP PANEL
    if ( jQuery('#anya_toppanel_number_cols').val() != tp_cols_default ) {
    	tp_cols_default  = jQuery('#anya_toppanel_number_cols').val();
		jQuery('#anya_toppanel_number_cols').change();  
    }
    
    
  }, 1000);

});
