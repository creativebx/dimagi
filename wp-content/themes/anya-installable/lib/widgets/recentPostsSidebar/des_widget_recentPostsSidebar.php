<?php

class RecentPostsSidebar_Widget extends WP_Widget {

	function RecentPostsSidebar_Widget() {
		$widget_ops = array('classname' => 'recentPostsSidebar_widget', 'description' => __('Show your recent blog posts on your site.', 'anya'));
		parent::WP_Widget(false, 'DESIGNARE _ Recent Posts', $widget_ops);
	}

	function form($instance) {

		if (isset($instance['title'])){
			$title = esc_attr($instance['title']); 	
		} else $title = "";
		
		if (isset($instance['style'])){
			$style = esc_attr($instance['style']); 	
		} else $style = "";
		
		if (isset($instance['nposts'])){
			$nposts = esc_attr($instance['nposts']);	
		} else $nposts = "";
		
		if (isset($instance['scroller'])){
			$scroller = esc_attr($instance['scroller']); 	
		} else $scroller = "";
		
		if (isset($instance['posts_per_row'])){
			$posts_per_row = esc_attr($instance['posts_per_row']); 	
		} else $posts_per_row = "";
		
		if (isset($instance['categories'])){
			$categories = esc_attr($instance['categories']);  
		} else $categories = "";
		
		if (isset($instance['orderby'])){
			$orderby = esc_attr($instance['orderby']);	
		} else $orderby = "";
		
		if (isset($instance['order'])){
			$order = esc_attr($instance['order']);  	
		} else $order = "";
        
        ?>
        
        <p><label for="<?php echo $this->get_field_id('title'); ?>">&#8212; <?php _e('Title','anya'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" ></label></p> 
        
        <!-- NEW -->
       <p>
	        <label>&#8212; <?php _e('Posts Style','anya'); ?> &#8212;</label><br>
	        <select id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" style="margin-left:15px;">
        		<?php 
        			for ($i=1; $i < 3; $i++){
        				$s = "";
	        			if ($i == $style) $s = "selected";
	        			echo "<option value='" . $i . "' ".$s.">Style " . $i . "</option>";	
        			}
        		?>
	        </select>
	    </p>
       <!-- NEW -->
        
        <p><label for="<?php echo $this->get_field_id('nposts'); ?>">&#8212; <?php _e('Number Posts to show','anya'); ?> &#8212;<input class="widefat" id="<?php echo $this->get_field_id('nposts'); ?>" name="<?php echo $this->get_field_name('nposts'); ?>" type="text" value="<?php echo $nposts; ?>" ><br><span class="flickr-stuff">If 0 will show all posts.</span></label></p>
        
		<p class="posts_scroller_select"><label for="<?php echo $this->get_field_id('scroller'); ?>">&#8212; <?php _e('Scroller','anya'); ?> &nbsp;<input id="<?php echo $this->get_field_id('scroller'); ?>" name="<?php echo $this->get_field_name('scroller'); ?>" type="checkbox" value="scroller" <?php if($scroller == "scroller") echo 'checked'; ?> onchange="if (!jQuery(this).is(':checked')) jQuery(this).closest('p').next().show(); else jQuery(this).closest('p').next().hide();" /></label></p>
		<p><label>&#8212; <?php _e('Posts per Row','anya'); ?> &#8212;</label><br>
			<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('posts_per_row'); ?>" value="1" <?php if($posts_per_row == '1') echo 'checked'; ?>>&nbsp;&nbsp;1<br>
			<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('posts_per_row'); ?>" value="2" <?php if($posts_per_row == '2') echo 'checked'; ?>>&nbsp;&nbsp;2<br>
			<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('posts_per_row'); ?>" value="3" <?php if($posts_per_row == '3') echo 'checked'; ?>>&nbsp;&nbsp;3<br>
			<input style="margin-left:15px;" type="radio" name="<?php echo $this->get_field_name('posts_per_row'); ?>" value="4" <?php if($posts_per_row == '4') echo 'checked'; ?>>&nbsp;&nbsp;4<br>
		</p>

        <p><label for="<?php echo $this->get_field_id('categories'); ?>">&#8212; <?php _e('Categories','anya'); ?> &#8212;<input style="display:none;" class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="text" value="<?php echo $categories; ?>" ></label></p>
       <div class="widget-recent-posts-categories">
       <?php
	    $args = array(
			'type' => 'post',
			'orderby' => 'id',
			'order' => 'ASC',
			'taxonomy' => 'category',
			'hide_empty' => 0,
			'pad_counts' => false
		);
		
		$categories = get_categories( $args );
		if (count($categories) > 0){
			foreach($categories as $cats){
				?>
				<label></label><input type="checkbox" name="<?php echo $cats->slug; ?>" value="<?php echo $cats->slug; ?>"><?php echo $cats->cat_name; ?>
				<?php
			}
		}
		else { ?> <i style="position:relative;top:-8px;margin-left:15px;"> <?php _e("No Categories defined.", "anya"); ?></i> <?php }
	       
       ?>
       </div>
        
	    <p><label>&#8212; <?php _e('Order by','anya'); ?> &#8212;</label><br>
	    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="title" <?php if($orderby == 'title') echo 'checked'; ?>> <?php _e('Title','anya'); ?><br>
	    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="date" <?php if($orderby == 'date') echo 'checked'; ?>> <?php _e('Date','anya'); ?><br>
	    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="author" <?php if($orderby == 'author') echo 'checked'; ?>> <?php _e('Author','anya'); ?><br>
	    		<input type="radio" name="<?php echo $this->get_field_name('orderby'); ?>" value="comment_count" <?php if($orderby == 'comment_count') echo 'checked'; ?>> <?php _e('Number Comments','anya'); ?><br>
	    </p>
	    <p><label>&#8212; <?php _e('Order','anya'); ?> &#8212;</label><br>
	    		<input type="radio" name="<?php echo $this->get_field_name('order'); ?>" value="asc" <?php if($order == 'asc') echo 'checked'; ?>> <?php _e('Ascending','anya'); ?><br>
	    		<input type="radio" name="<?php echo $this->get_field_name('order'); ?>" value="desc" <?php if($order == 'desc') echo 'checked'; ?>> <?php _e('Descending','anya'); ?><br>
	    </p>
		    
		<script type="text/javascript">
	        jQuery(document).ready(function($){
	        
	        	$('#<?php echo $this->get_field_id('style'); ?>').change(function(){
		        	$(this).find('option[selected]').removeAttr('selected');
	        	});
	        
	        	$('.posts_scroller_select').each(function(e){
	        		if (!$(this).find('input').is(':checked')) $(this).parents('.posts_scroller_select').next('p').hide();
	        		else $(this).parents('.scroller_select').next('p').show();
	        	});
	        	
	        	$('.posts_scroller_select').find('input').trigger('change');
	        	
	        	$('.widget-recent-posts-categories').each(function(){
		        	var $el = $(this);
		        	var savedVal = $el.prev().find('input').val().split("|*|");
		        	for (var i=0; i<savedVal.length; i++){
			        	if (savedVal[i] != ""){
				        	$el.find('input[value='+savedVal[i]+']').attr('checked','true');
			        	}
		        	}
		        
			        $el.find('input').change(function(){
				       var newVal = "";
				       var first = true;
				       $el.find('input').each(function(){
					       if ($(this).is(':checked')){
						       if (first){
							   		newVal += $(this).val();
							   		first = false;
						       } else newVal += "|*|" + $(this).val();
					       }
				       });
				       $el.prev().find('input').val(newVal);
			        });	
		        	
	        	});
	        	
	        });
        </script>	    
	
        <?php
	}
	function update($new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
	    $instance['title'] = $new_instance['title'];
	    $instance['style'] = $new_instance['style'];
	    $instance['nposts'] = $new_instance['nposts'];
	    $instance['scroller'] = $new_instance['scroller'];
	    $instance['posts_per_row'] = $new_instance['posts_per_row'];
	    $instance['categories'] = $new_instance['categories'];
	    $instance['orderby'] = $new_instance['orderby'];
	    $instance['order'] = $new_instance['order'];
		return $instance;
	}
	
	function widget($args, $instance) {
		
		extract($instance);
	    $title = apply_filters('widget_title', $instance['title'], $instance);
	    $postsStyle = $instance['style'];
	    $nposts = $instance['nposts'];
	    $categories = $instance['categories'];
	    $orderby = $instance['orderby'];
	    $order = $instance['order'];
	    $scroller = (isset($instance['scroller'])) ? "yes" : "no";
	    $posts_per_row = $instance['posts_per_row'];
	   	$thecats = array();
	    if (strlen($categories) > 0){
	    	$cats = explode("|*|",$categories);
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
	    
	   	global $post, $wp_query;
	    
	    $args = array(
			'showposts' => $nposts,
			'orderby' => $orderby,
			'order' => $order,
			'post_status' => 'publish'
		);
		$columnslayout = "";
		switch($posts_per_row){
			case "2": 
				$columnslayout = "eight columns";
				break;
			case "3": 
				$columnslayout = "one-third column";
				break;
			case "4": 
				$columnslayout = "four columns";
				break;
		}
		$losposts = get_posts($args);
		$filteredposts = array();
		foreach ($losposts as $p){
			$postscats = get_the_terms($p->ID, 'category');
			$found = false;
			if (is_array($postscats)){
				foreach ($postscats as $pcats){
					foreach ($thecats as $tc){ 
						if ($pcats->slug == $tc) $found = true;	
					}
				}
				if ($found) {
					array_push($filteredposts, $p);
					$losposts = $filteredposts;
				}	
			}
		}
		
		$randID = rand();
		
		$postes = "";
		
		if (!$posts_per_row) $posts_per_row = 1;
		
		if ($style == 1){
			$rows = ceil(count($losposts)/$posts_per_row);
		 	$el = 0;
			//query_posts($args);
			foreach ($losposts as $post){
			
				query_posts('p='.$post->ID);
				the_post();
			
				$audio = "";
					 	
			 	if ($scroller == "no" && $el == 0){
				 	$postes .= '<div class="posts_row">';
			 	}
			 	
			 	if ($scroller == "no")
				 	$postes .= '<div class="'.$columnslayout.'">';
			 	else
			 		$postes .= '<li>';
			 		 
			 	$postes .= '<div id="post-' . get_the_ID() . '" class="slides-item post no-flicker"><div class="the_content">';
			 	
			 	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
			 	
			 	$postid = get_the_ID();
			 	
			 	$postes .= '<div class="data_type">'; 
			 	
			 	$postes .= '<div class="cutcorner_top"></div>';
			 	
			 	$postes .= '<div class="data"><div class="day">'.get_the_date("d").'</div><div class="">'.__(substr(get_the_date("F"), 0, 3), "anya").'</div></div>';
		
			 	if ($posttype != "none" && $posttype != "") $postes .= '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>';
			 	
			 	$postes .= '<div class="cutcorner_bottom"></div>';
			 	
			 	$postes .= '</div><div class="title_content">';
			 						
				$postes .= '<div class="the_title"><a href="'. get_permalink() . '">'. get_the_title() .'</a></div>';
		
				if ( comments_open() ) {
					$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
					if ( $num_comments == 0 ) {
						$comments = __('0','anya');
					} elseif ( $num_comments > 1 ) {
						$comments = $num_comments . __('','anya');
					} else {
						$comments = __('1','anya');
					}
					$postes .= '<div class="comments_number"><i class="icon-comments-alt"></i>'.$comments.'</div>';
				} 
				
				$textcontent = "";
				$char = 0;
				$idx = 0;
				$max_chars = 100;
				if ($max_chars > 0){
					$textcontent = get_the_content();
					$textcontent = strip_shortcodes($textcontent);
					$textcontent = strip_tags($textcontent);
					$the_str = substr($textcontent, 0, $max_chars);
		
					if (strlen($textcontent) > $max_chars){
						$textcontent = $the_str."...";
					} else {
						$textcontent = get_the_content();
					}
				} else {
					$textcontent = get_the_excerpt();
				}
				
				if ($audio != ""){
					$postes .= '<div class="the_content">'.$audio.'</div>';
				} else {
					$postes .= '<div class="the_content"><p>'.$textcontent.' <span class="rp_readmore"><a href="'.get_permalink().'">'.__('Read More','anya').'</a></span>'.'</p>'.'</div>';
				}
				
				$postes .= '</div>';
		
				if ($scroller == "yes"){ $postes .= '</div></div></li>'; }
				else { $postes .= '</div></div></div>'; }
					
				if ($scroller == "no"){
					$el++;
					if ($el == $posts_per_row){
						$postes .= "</div>";
						$el = 0;
					}
				}
			}
				
			if ($scroller == "yes"){
				wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
				echo '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts"><div class="projects_container rposts2 sixteen columns"><div class="anyatitle page_title_s2 "><span class="page_info_title_s2 wdgt-test">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2 deswidget" style="width:100%;"><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1});});</script><div class="clear"></div></section>';
			} else {
				echo '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts"><div class="projects_container rposts2 sixteen columns"><div class="anyatitle page_title_s2 "><span class="page_info_title_s2 wdgt-test">'. $title . '</span></div><div class="project_list_s2 deswidget"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';
			}
		} else {
			
			/* recent posts style 2 NEW */
			foreach ($losposts as $post){
		
				query_posts('p='.$post->ID);
				the_post();
			
				$audio = "";
					 	
			 	if ($scroller == "no" && $el == 0){
				 	$postes .= "<div class=\"posts_row\">";
			 	}
			 	
			 	if ($scroller == "no"){
				 	$postes .= "<div class=\"".$columnslayout."\">";
			 	} else {
				 	$postes .= "<li>";
			 	}
			 		 
			 	$postes .= "<div id=\"post-" . get_the_ID() . "\" class=\"slides-item post no-flicker\"><div class=\"the_content\">";
			 	
			 	$posttype = (get_post_meta(get_the_ID(), 'posttype_value', true)) ? get_post_meta(get_the_ID(), 'posttype_value', true) : "none";
			 	
			 	$postid = get_the_ID();
			 	
			 	switch($posttype){
				 	case "image": case "text": case "audio":
				 		
				 		if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
					 		$postes .= "<div class=\"posttype_preview eight columns alpha\"><img alt=\"".get_the_title()."\" src=\"". wp_get_attachment_url( get_post_thumbnail_id($postid)) ."\" title=\"". get_the_title() ."\" style=\"position: relative; float: left; height: 140px; width: auto;\" /><div class=\"posttype_date\"><div class=\"posttype_date_triangle\"></div>";
					 		
					 		$postes .= "<div class=\"title_date\" style=\"position: relative; left: 10px;\"><div class=\"date\""; 
						 	$postes .= "><span class=\"theday\">" . get_the_date("d") . "</span> " . get_the_date("F") . ", " . get_the_date("Y") . "</div></div><div class=\"post_type ".$posttype."\"><i class=\"icon-\"></i></div></div>";
					 		
					 		$postes .= "</div>";
					 		$postes .= "<div class=\"title_content eight columns omega\">";
				 		} else {
					 		$postes .= "<div class=\"title_content\">";
				 		}
				 		
				 	break;
				 	case "slider":
				 		$postes .= "<div class=\"posttype_preview eight columns alpha\">"; 
				 		$randClass = rand(0,1000);
				 		
				 		$postes .= "<div class=\"flexslider ".$posttype."\" id=\"flex-".$randClass."\" style=\"height: 140px;\"><ul class=\"slides\">";
				 		
				 		$sliderData = get_post_meta($postid, "sliderImages_value", true);
						$slide = explode("|*|",$sliderData);
					    foreach ($slide as $s){
					    	if ($s != ""){
					    		$url = explode("|!|",$s);
					    		$postes .= "<li>";
					    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
						    		$postes .= "<a href=\"".$url[1]."\" rel=\"prettyPhoto[pp_gal-".$randClass."]\" >";
					    		}
					    		$postes .= "<img src=\"".$url[1]."\" alt=\"\" class=\"rp_style1_img\" style=\"height: 140px; width: auto;\" />";
					    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
						    		$postes .= "</a>";
					    		}
					    		$postes .= "</li>";
					    	}
					    }
					    $postes .= "</ul>";
					    if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
							$postes .= "<div class=\"mask\" onclick=\"jQuery(this).siblings('.flex_this_thumb').trigger('click');\"><div class=\"more\" onclick=\"jQuery(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();\"></div></div>";
						}
						$postes .= "</div>";
						$postes .= "<div class=\"posttype_date\"><div class=\"posttype_date_triangle\"></div><div class=\"title_date\" style=\"position: relative; left: 10px;\"><div class=\"date\""; 
					 	$postes .= "><span class=\"theday\">" . get_the_date("d") . "</span> " . get_the_date("F") . ", " . get_the_date("Y") . "</div></div><div class=\"post_type ".$posttype."\"><i class=\"icon-\"></i></div></div>";
				 		
				 		$postes .= "</div>";
				 		$postes .= "<div class=\"title_content eight columns omega\">";
				 	break;
				 	case "video":
				 		$postes .= "<div class=\"video-thumb eight columns alpha\" style=\"height: 147px;\">"; 
						$videosType = get_post_meta($postid, "videoSource_value", true);
						$videos = get_post_meta($postid, "videoCode_value", true);
						$videos = preg_replace( '/\s+/', '', $videos );
						$vid = explode(",",$videos);
						switch (get_post_meta($postid, "videoSource_value", true)){
							case "youtube":
								foreach ($vid as $v){
									$postes .= "<iframe style=\"height: 140px;\" src=\"http://www.youtube.com/embed/".$v."?autoplay=0&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0\" allowfullscreen=\"\"></iframe>";
								}
							break;
							case "vimeo":
								foreach ($vid as $v){
									$postes .= "<iframe style=\"height: 140px;\" src=\"http://player.vimeo.com/video/".$v."\" allowfullscreen=\"\"></iframe>";
								}
							break;
						}
				 		$postes .= "<div class=\"posttype_date\"><div class=\"posttype_date_triangle\"></div><div class=\"title_date\" style=\"position: relative; left: 10px;\"><div class=\"date\""; 
					 	$postes .= "><span class=\"theday\">" . get_the_date("d") . "</span> " . get_the_date("F") . ", " . get_the_date("Y") . "</div></div><div class=\"post_type ".$posttype."\"><i class=\"icon-\"></i></div></div>";
				 		
				 		$postes .= "</div>";
				 		$postes .= "<div class=\"title_content eight columns omega\">";
				 	break;
				 	case "none":
				 		$postes .= "<div class=\"title_content\">";
				 	break;
			 	}
			 	
			 	//if ($posttype != "none" && $posttype != "") $postes .= '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>';		 	
			 	
			 	/*
	$postes .= '<div class="title_date" style="position: relative; left: 10px;"><div class="date"'; 
			 	if ($posttype == "none" || $posttype == "") $postes .= ' style="border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -o-border-radius: 3px; -ms-border-radius: 3px;"';
			 	$postes .= '>' . get_the_date("d") . ' ' . get_the_date("F") . ', ' . get_the_date("Y") . '</div></div>';
	*/
			 						
				if (get_the_title() != "") $postes .= "<div class=\"the_title\"><a href=\"". get_permalink() . "\">". get_the_title() ."</a><div class=\"numberofcomments\">".wp_count_comments($postid)->approved."<div class=\"numberofcomments_triangle\"></div></div></div>";
				
				if ($posttype == 'text'){
					$postes .= "<div class=\"posttype_date textposttype\"><div class=\"title_date\" style=\"position: relative; left: 10px;\"><div class=\"date\"><span class=\"theday\">" . get_the_date("d") . "</span> " . get_the_date("F") . ", " . get_the_date("Y") . "</div></div><div class=\"post_type ".$posttype."\"><i class=\"icon-\"></i></div></div>";
				}
				
				if ($posttype == 'none' || !$posttype){
					$postes .= "<div class=\"posttype_date noposttype\"><div class=\"title_date\" style=\"position: relative; left: 10px;\"><div class=\"date\"><span class=\"theday\">" . get_the_date("d") . "</span> " . get_the_date("F") . ", " . get_the_date("Y") . "</div></div></div>";
				}
				
				/*the author*/
				$postes .= "<div class=\"divider-tags\"><div class=\"the_author\">".get_the_author()."</div></div>";
	
				/*the cats*/
				$post_categories = wp_get_post_categories( $postid );
				$cats = array();
				$first = true;
				if (!empty($post_categories)){
					$postes .= "<div class=\"divider-tags\"><div class=\"the_categories\">";
				}
				foreach($post_categories as $c){
					$cat = get_category( $c );
					if ($first){
						$postes .= $cat->name;
						$first = false;
					} else {
						$postes .= ', '.$cat->name;
					}
				}
				if (!empty($post_categories)){
					$postes .= "</div></div>";	
				}
							
				$textcontent = "";
				$char = 0;
				$idx = 0;
				if ($max_chars > 0){
					$textcontent = get_the_content();
					$textcontent = strip_shortcodes($textcontent);
					$textcontent = strip_tags($textcontent);
					$the_str = substr($textcontent, 0, $max_chars);
		
					if (strlen($textcontent) > $max_chars){
						$textcontent = $the_str."...";
					} else {
						$textcontent = get_the_excerpt();
					}
				} else {
					$textcontent = get_the_excerpt();
				}
				
				
				$postes .= "<div class=\"the_content\"><p>".$textcontent." <span class=\"rp_readmore\"><a href=\"".get_permalink()."\">".__('Read More','anya')."</a></span>"."</p>"."</div>";
				
				
				$postes .= "</div></div></div>";
		
				if ($scroller == "yes"){
					$postes .= "</li>";	
				} else {
					$postes .= "</div>";
				}
					
				if ($scroller == "no"){
					$el = $el + 1;
					if ($el == $posts_per_row){
						$postes .= "</div>";
						$el = 0;
					}
				}
			}
				
			if ($scroller == "yes"){
				wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
				if ($link_to_blog != ""){
					echo '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2 recent_testimonials"><div class="projects_container rposts2 sixteen columns"><div class="anyatitle page_title_s2"><span class="page_info_title_s2 wdgt-test">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_blog"  onclick="window.location = \''.$link_to_blog.'\';" title="'.$title_to_blog_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2_style2 deswidget" ><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1});});</script><div class="clear"></div></section>';		
				} else {
					echo '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2 recent_testimonials"><div class="projects_container rposts2 sixteen columns"><div class="anyatitle page_title_s2 "><span class="page_info_title_s2 wdgt-test">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2_style2 deswidget" style="width:100%;"><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1});});</script><div class="clear"></div></section>';
				}	
			} else {
				if ($link_to_blog != ""){
					echo '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2"><div class="projects_container rposts2 sixteen columns"><div class="anyatitle page_title_s2"><span class="page_info_title_s2 wdgt-test">'. $title . '</span><div class="pag-proj2_s2"><div class="goto_blog"  onclick="window.location = \''.$link_to_blog.'\';" title="'.$title_to_blog_link.'"></div></div></div><div class="project_list_s2_style2 deswidget"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';		
				} else {
					echo '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2"><div class="projects_container rposts2 sixteen columns"><div class="anyatitle page_title_s2 "><span class="page_info_title_s2 wdgt-test">'. $title . '</span></div><div class="project_list_s2_style2 deswidget"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';
				}
			}
			
		}
	}
}
register_widget('RecentPostsSidebar_Widget');

?>
