<?php 


/*-----------------------------------------------------------------------------------*/
/* xx RPosts 2 - [sector_list]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_sector_list ( $atts, $content = null ) {

		$defaults = array( 'title' => '', 'page_ids'=>'', 'page_per_row' => 2, 'title_to_blog_link' => '', 'max_chars'=>155, 'title_height' =>'60px' );

		extract( shortcode_atts( $defaults, $atts ) );
		
		$randID = rand();
		$uagent_obj = new uagent_info();
		$postes = "";
		
		if(!empty($title))
			$t = "$title";
		else
			$t = "";
			
		if(!isset($total) || $total == 0)
  		$total = -1;
				
		
		global $post;
		
		global $more;
			$more = 0;
		
		/*if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }*/
		
		$args = array(
			'include' => $page_ids,
			'post_type' => 'page',
			'post_status' => 'publish'
		);

		$pages = get_pages($args); 
	
		switch($page_per_row){
			case "1": 
				$columnslayout = "";
				break;
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

		$title_height_style = ' height:'.$title_height;
		
		
		$filteredposts = array();
	 	$rows = ceil(count($pages)/$page_per_row);
	 	$el = 0;
		//query_posts($args);
		foreach ($pages as $page){
			$page_title = $page->post_title;
			$page_id = $page->ID;
			$page_link = get_permalink($page_id);
			 	
			if ( $el == 0 ){
			 	$postes .= "<div class=\"posts_row\">";
		 	}
		 	
		 	$postes .= "<div class=\"".$columnslayout."\">";
		 		 
		 	$postes .= "<div id=\"post-" . $page_id . "\" class=\"slides-item post no-flicker\"><div class=\"the_content\">";

		 	$page_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page_id),'sectors-thumb');

	 		if (isset($page_thumb[0])){
	 		    $postes .= "<div class=\"title_content sixteen columns \"><a class=\"section-summary-image\" href=\"". $page_link . "\" style=\"background-image: url('". $page_thumb[0] ."');\"><span class=\"section-title\">". $page_title ."</a>";

		 		//$postes .= "<div class=\"posttype_preview sixteen columns alpha\"><a href=\"". $page_link . "\"><img alt=\"".$page_title."\" src=\"". $page_thumb[0] ."\" title=\"". $page_title ."\" style=\"position: relative; float: left; height: 140px; width: auto;\" /><div class=\"posttype_date\"><div></a></div>";
		 		
		 		//$postes .= "<div class=\"title_date\" style=\"position: relative; left: 10px;\"><a href=\"". $page_link . "\"><div style=\"width:100%;text-align: center;font-size: 15px;".$title_height_style."\" class=\"date\"";
			 	//$postes .= "><span  class=\"theday\">" . $page_title. "</div></div></a></div>";
		 		
		 		//$postes .= "</div>";
		 		//$postes .= "<div class=\"title_content sixteen columns \">";
	 		} else {
		 		$postes .= "<div class=\"title_content\">";
	 		}			
						
			$textcontent = "";
			$char = 0;
			$idx = 0;
			
			//var_dump($page);
			if($page->post_excerpt != ''){
				$textcontent =  my_excerpt($page->post_excerpt,false);
			}else{
				$textcontent =  my_excerpt($page->post_content,false);
			}
			//$postes .= "<div class=\"the_content\"><p>".$textcontent." <span class=\"rp_readmore\"><a href=\"".$page_link."\">".__('Learn More;','anya')."</a></span>"."</p>"."</div>";
			
			// title_content sixteen columns
			$postes .= "</div>";

			// slides-item post no-flicker
			$postes .= "</div></div>";

	        // $columnslayout
			$postes .= "</div>";
			
			$el = $el + 1;
			if ($el == $page_per_row){
				$postes .= "</div>";
				$el = 0;
			}
			
		}
		
		return "<section id=\"recentPosts-" . $randID . "\" class=\"home_widget recentPosts_style2\"><div class=\"projects_container rposts2 sixteen columns\">".$postes."</div></section>";
			

}

add_shortcode( 'sector_list', 'des_shortcode_sector_list', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx rposts_author_img - [rposts_author_img]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_rposts_author_img ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'title' => '', 'category' => 'all', 'total' => -1, 'orderby' => '', 'scroller' => 'yes', 'posts_per_row'=>'3', 'order' => '', 'link_to_blog' => '', 'title_to_blog_link' => '', 'max_chars'=>-1, 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed'=>'' );

		extract( shortcode_atts( $defaults, $atts ) );
		
		$randID = rand();
		$uagent_obj = new uagent_info();
		$postes = "";
		
		if(!empty($title))
			$t = "$title";
		else
			$t = __("Latests Posts", "anya");
			
		if(!isset($total) || $total == 0)
  		$total = -1;
				
		
		global $post;
		
		global $more;
			$more = 0;
			
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		
		$args = array(
			'showposts' => $total,
			'orderby' => $orderby,
			'order' => $order,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1
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
		if ($categories != "all"){
			foreach ($losposts as $p){
				$postscats = get_the_terms($p->ID, 'category');
				$found = false;
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
		
	 	$rows = ceil(count($losposts)/$posts_per_row);
	 	$el = 0;
		//query_posts($args);
		foreach ($losposts as $post){
		
			query_posts('p='.$post->ID);
			the_post();
		
			$audio = "";
				 	
		 	if ($scroller == "no" && $el == 0){
			 	$postes .= "<div class=\"update-row\">";
		 	}
		 	
		 	if ($scroller == "no")
			 	$postes .= "<div class=\"update-content-container\">";
		 	else
		 		$postes .= "<li>";
		 		 
		 	$postes .= "<div id=\"post-" . get_the_ID() . "\" class=\"slides-item post no-flicker\"><div class=\"the_content\">";
		 	
		 	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
		 	
		 	$postid = get_the_ID();
		 	
		 	$postes .= "<div  style=\"z-index: 999\"  class=\"data_type\">"; 
		 	
		 	$postes .= "<div class=\"cutcorner_top\"></div>";
		 	
		 	//================================= author data============
			$authors = get_all_authors($post->ID);

			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

			if ( comments_open() ) {
				$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
				if ( $num_comments == 0 ) {
					$comments = __('0','anya');
				} elseif ( $num_comments > 1 ) {
					$comments = $num_comments . __('','anya');
				} else {
					$comments = __('1','anya');
				}
				$comments_thml = "<div class=\"update-comments\"><i class=\"fa fa-comments\"></i> ".$comments."</div>";
			}

			$postes .= '<div class="data author-image" style="background: inherit !important;"><a style="background: url(\''.$authors[0]['image'].'\') no-repeat; background-size: cover; width: 60px; height: 60px;" title="'.$authors[0]['name'].'" href="'.$authors[0]['url'].'"></a></div>'.$comments_thml;

		 	if ($posttype != "none" && $posttype != "") $postes .= "<div class=\"post_type ".$posttype."\"><i class=\"icon-\"></i></div>";
		 	
		 	$postes .= "<div class=\"cutcorner_bottom\"></div>";
		 	
		 	$postes .= "</div><div class=\"update-body\">";
			
			$postes .= "<h3 class=\"update-title\"><a  href=\"". get_permalink() . "\">". get_the_title() ."</a></h3><div class=\"update-date\"> ".get_the_date().' '.format_by_line($authors)."</div>";

			$textcontent = "";
			$char = 0;
			$idx = 0;
			$max_chars += 100;
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
				$postes .= "<div class=\"the_content\">".$audio."</div>";
			} else {
				$postes .= "<div class=\"the_content\"><p>".$textcontent."</p> <div class=\"update-readmore\"><a href=\"".get_permalink()."\">".__('Read More','anya')."</a></div>"."</div>";
			}
			
			$postes .= "</div>";
	
			if ($scroller == "yes")
			    $postes .= "</div></div></li>";
			else 
				$postes .= "</div></div></div>";
				
			if ($scroller == "no"){
				$el++;
				if ($el == $posts_per_row){
					$postes .= "</div>";
					$el = 0;
				}
			}
		}
			
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
			
		if ($scroller == "yes"){
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
			if ($link_to_blog != ""){
				return "<section id=\"recentPosts-" . $randID . "\" class=\"home_widget recentPosts\"><div class=\"projects_container rposts2 sixteen columns\"><div class=\"anyatitle page_title_s2\"><span class=\"page_info_title_s2\">". $title . "</span><div class=\"pag-proj2_s2\"><div class=\"nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal\"></div><div class=\"goto_blog\"  onclick=\"window.location = '".$link_to_blog."';\" title=\"".$title_to_blog_link."\"></div><div class=\"prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal\"></div></div></div><div class=\"project_list_s2\" ><ul class=\"slides_container post_listing jcarousel-skin-tango\">".$postes."</ul></div></div><script type=\"text/javascript\">jQuery(document).ready(function($){jQuery(\"#recentPosts-".$randID." .slides_container\").parent().carousel({dispItems: 1".$autoplay_output."});});</script><div class=\"clear\"></div></section>";		
			} else {
				return "<section id=\"recentPosts-" . $randID . "\" class=\"home_widget recentPosts\"><div class=\"projects_container rposts2 sixteen columns\"><div class=\"anyatitle page_title_s2 \"><span class=\"page_info_title_s2\">". $title . "</span><div class=\"pag-proj2_s2\"><div class=\"nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal\"></div><div class=\"prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal\"></div></div></div><div class=\"project_list_s2\" style=\"width:100%;\"><ul class=\"slides_container post_listing jcarousel-skin-tango\">".$postes."</ul></div></div><script type=\"text/javascript\">jQuery(document).ready(function($){jQuery(\"#recentPosts-".$randID." .slides_container\").parent().carousel({dispItems: 1".$autoplay_output."});});</script><div class=\"clear\"></div></section>";
			}	
		} else {
			if ($link_to_blog != ""){
				return "<section id=\"recentPosts-" . $randID . "\" class=\"home_widget recentPosts\"><div class=\"projects_container rposts2 sixteen columns\"><div class=\"anyatitle page_title_s2\"><span class=\"page_info_title_s2\">". $title . "</span><div class=\"pag-proj2_s2\"><div class=\"goto_blog\"  onclick=\"window.location = '".$link_to_blog."';\" title=\"".$title_to_blog_link."\"></div></div></div><div class=\"project_list_s2\"><div class=\"slides_container post_listing jcarousel-skin-tango\">".$postes."</div></div></div><div class=\"clear\"></div></section>";		
			} else {
				return "<section id=\"recentPosts-" . $randID . "\" class=\"home_widget recentPosts\"><div class=\"projects_container rposts2 sixteen columns\"><div class=\"anyatitle page_title_s2 \"><span class=\"page_info_title_s2\">". $title . "</span></div><div class=\"project_list_s2\"><div class=\"slides_container post_listing jcarousel-skin-tango\">".$postes."</div></div></div><div class=\"clear\"></div></section>";
			}
		}

} // End des_shortcode_rposts_author_img()

add_shortcode( 'rposts_author_img', 'des_shortcode_rposts_author_img', 90 );
