<?php get_header();  ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php 
		global $anya_custom;
		if ($anya_custom == "on"){
	    	$sidebar = get_post_meta(get_the_ID(), 'sidebar_value', true); 
	    } else {
		    $sidebar = get_option(DESIGNARE_SHORTNAME."_blog_single_sidebar");
	    }
    	$postconfig = " sixteen columns";
    	$postlistingstyle = "";
    	
    	if ($sidebar == "left" || $sidebar == "right") {
    		$postconfig = " twelve columns";
    		$postlistingstyle = 'style="border-right: 1px dashed #ccc; margin-top: 25px;"';
    	}
    	if ($sidebar == "left") {
	    	//get_sidebar();	
	    	$postlistingstyle = 'style="border-left: 1px dashed #ccc; margin-top: 25px;"';
	    	
    	}

    ?>
    
    <div class="fullwidth-container" style="
	    	
	    	<?php 
		    	global $anya_custom, $anya_styleColor;	    		
	    		$type = des_get_value(DESIGNARE_SHORTNAME."_header_type");
	    		if (empty($type)) $type = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
				$color = des_get_value(DESIGNARE_SHORTNAME."_header_color"); 
				$image = des_get_value(DESIGNARE_SHORTNAME."_header_image"); 
				$pattern = DESIGNARE_PATTERNS_URL.des_get_value(DESIGNARE_SHORTNAME."_header_pattern"); 
				$height = des_get_value(DESIGNARE_SHORTNAME."_header_height"); 
				$margintop = des_get_value(DESIGNARE_SHORTNAME."_header_text_margin_top");	
				$banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider");
				if (empty($banner)) $banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider option:selected");	
		 		if ($height != "") echo "height: ". $height . ";";
				if($type == "none") echo "background: none;"; 
				if($type == "color") echo "background: #" . $color . ";";
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto";  
	 			if($type == "pattern") echo "background: url('" . $pattern . "') 0 0 repeat;";
	 			if($type == "border") echo "background: white;";
	    	?>">
	    	
	    	<?php
		    	if ($type === "banner"){
			    	?>
			    	<div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div>
			    	<?php
		    	} else {
	    	?>
	    	
				<div class="container">

					<div class="pageTitle sixteen columns" <?php if ($margintop != "") echo " style='margin-bottom: ".$margintop.";margin-top: ".$margintop.";'"; ?>>
		    			<h1 class="page_title" style="<?php
					    	$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));
							echo "color: #$tcolor; font-size: $tsize;";
			    	?>"><?php echo get_option(DESIGNARE_SHORTNAME."_blog_single_primary_title"); ?></h1>
		    		<?php
				    	if (get_post_meta($post->ID, 'secondaryTitle_value', true) != ""){
					?>
					    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";
			    		?>" ><?php echo get_post_meta($post->ID, 'secondaryTitle_value', true); ?></h2>
			    		<?php
			    		} else {
				    		if (get_option(DESIGNARE_SHORTNAME."_archive_secondary_title") != ""){
					    		?>
						    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";
			    		?>" ><?php echo get_option(DESIGNARE_SHORTNAME."_archive_secondary_title"); ?></h2>
				    		<?php
				    		}
			    		}
		    		?>

		    		</div>
		    		<div class="breadcrumbs-container"> 
					<?php global $template;
						if (!strstr($template, "woocommerce.php")){
			  			wp_reset_query();
			  			$bc = des_get_value(DESIGNARE_SHORTNAME. '_breadcrumbs');
			  			if ($bc == "on"){
				  			?>
				    			<div class="entry-breadcrumb no-flicker" style="border: none;"> 
									<p><?php echo __(get_option(DESIGNARE_SHORTNAME."_you_are_here"), "anya"); ?> <?php designare_the_breadcrumb(); ?></p>
								</div>
				    		<?php
			  			}	
						} else {
			  			$args = array(
							'delimiter'   => ' &raquo; ',
							'wrap_before' => '<div class="entry-breadcrumb no-flicker" style="border: none;"><p>'. __(get_option(DESIGNARE_SHORTNAME."_you_are_here"), "anya").' ',
							'wrap_after'  => '</p></div>',
							'before'      => '',
							'after'       => '',
							'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
						);
						woocommerce_breadcrumb($args);
						}
					?>  
			</div>
			<?php
				if ($type == "border"){
					?>
					<div class="borderline"><div class="borderline-colored"></div></div>
					<?php
				}
			?>
				</div>
			</div>
			
		<?php } ?>
	<div id="white_content">
	
		<div id="wrapper">
		
			<div class="container">
				

		
			<?php
				
				$postconfig = " sixteen columns";
		    	$postlistingstyle = "";
		    	
		    	if ($sidebar == "left" || $sidebar == "right") {
		    		$postconfig = " twelve columns";
		    		$postlistingstyle = 'style="border-right: 1px solid #ededed; "';
		    	}
		    	if ($sidebar == "left") {
			    	//get_sidebar();	
			    	$postlistingstyle = 'style="border-left: 1px solid #ededed; "';
			    	
		    	}
				if ($sidebar == "left"){
					?> <div class="four columns">
					<?php get_sidebar();?>
					</div>
					<?php
				}
			?>
						
		<div id="primary" class="blogarchive single <?php echo $postconfig; if ($sidebar == "none") echo " fullwidth"; ?>">
			<div id="content">
			
				<div class="post-listing" <?php echo $postlistingstyle; ?>>
					
					<?php
						$columns = "";
						if ($sidebar === "none") $columns = "";
					?>

					<article id="post-<?php the_ID(); ?>" class="post">
								    	
					    	<?php
					    	
					    	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
					    	
					    	$postid = get_the_ID(); ?>
					    	
					    	<div class="postcontent <?php echo $columns; ?>" style="<?php if ($sidebar == "left") echo "margin-right:0px;margin-left:25px;"; else echo "margin-left: 0;"; if ($sidebar == "none") echo "position:relative;float:left;width:100%;"?>">
								    									    	
					    	<?php
					    	
					    		switch($posttype){
						    		case "image":
						    		
						    			if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
										?>
										
											<div class="featured-image-thumb" onmouseover="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0.6)'); $(this).find('.magnify_this_thumb').css('left', '51%').css('opacity',1); $(this).find('.hyperlink_this_thumb').css('left', '39%').css('opacity',1);" onmouseout="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0)'); $(this).find('.magnify_this_thumb').css('left', '-15%').css('opacity',0); $(this).find('.hyperlink_this_thumb').css('left', '105%').css('opacity',0);">
												<h2><a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
													<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($postid)); ?>" title="<?php the_title(); ?>"/>
												</a></h2>
												<?php
													if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
														?>
														<a class="flex_this_thumb" rel="prettyPhoto" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($postid)); ?>"></a>
														<div class="mask" onclick="$(this).siblings('.flex_this_thumb').trigger('click');">
															<div class="more" onclick="$(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();"></div>
														</div>
														<?php
													}
												?>
											</div>
											<?php 
										}
						    			
						    			break;
						    		case "slider": 
						    			$randClass = rand(0,1000);
										?>
											<div class="flexslider <?php echo $posttype." ".$columns; ?>" id="<?php echo $randClass; ?>">
												<ul class="slides">
													<?php
														$sliderData = get_post_meta($postid, "sliderImages_value", true);
														$slide = explode("|*|",$sliderData);
													    foreach ($slide as $s){
													    	if ($s != ""){
													    		$url = explode("|!|",$s);
													    		echo "<li>";
													    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
														    		echo "<a href='".$url[1]."' rel='prettyPhoto[pp_gal]' >";
													    		}
													    		echo "<img src='".$url[1]."' alt='' class='rp_style1_img'>";
													    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
														    		echo "</a>";
													    		}
													    		echo "</li>";	
													    	}
													    }
													?>
												</ul>
												<?php
													if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
														?>
															<div class="mask" onclick="$(this).siblings('.flex_this_thumb').trigger('click');">
																<div class="more" onclick="$(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();"></div>
															</div>
														<?php
													}
												?>
											</div>
											<?php 
						    			break;
						    		case "audio":
						    			$randClass = rand(0,1000);
										?>
										<div class="audioContainer <?php echo $columns; ?>">
											<?php echo get_post_meta($postid, 'audioCode_value', true); ?>
										</div>
										<?php
						    			break;
						    		case "video":
						    			echo "<div id='the_movies' class='the_movies'></div>";
										$videosType = get_post_meta($postid, "videoSource_value", true);
										$videos = get_post_meta($postid, "videoCode_value", true);
										$videos = preg_replace( '/\s+/', '', $videos );
										$vid = explode(",",$videos);
										switch (get_post_meta($postid, "videoSource_value", true)){
											case "youtube":
												foreach ($vid as $v){
													echo "<div class='v_links'>http://www.youtube.com/embed/".$v."?autoplay=1&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0</div>";	
												}
												break;
											case "vimeo":
												foreach ($vid as $v){
													echo "<div class='v_links'>http://player.vimeo.com/video/".$v."</div>";	
												}
												break;
										}
						    			break;
						    	}
						    						    	
					    		?>
						    
								<div class="post-cc">
									<div class="tr-blogfw">
										<div class="td-blogfw">
											<div class="data_type">
						    		
									    		<div class="cutcorner_top"></div>
									    		
									    		<div class="data">
									    			<div class="day"><?php echo get_the_date("d"); ?></div>
									    			<div><?php echo __(substr(get_the_date("F"), 0, 3), "anya"); ?></div>
									    		</div>
									    	
									    		<?php if ($posttype != "none" && $posttype != "") echo '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>'; ?>
									    		
									    		<div class="cutcorner_bottom"></div>
	
									    	</div>
										</div>
										<div class="thepostcont">
											<div class="post-single-stuff">
								    	
										    	<div class="metas_container">											
								    				<div class="the_title"><h2><a href="<?php the_permalink() ?>"><?php  the_title(); ?></a></h2></div>
											    	
										    	</div>
										    	
										    	<div class="metas">
														    	
										    		<div class="metas-div">
										    			<div class="divider-tags">
										    				<span class="blog-i comments"><?php 
										    					$nocomment = get_option(DESIGNARE_SHORTNAME."_no_comments_text");
										    					if ($nocomment == "") $nocomment = "comments";
										    					$onecomment = get_option(DESIGNARE_SHORTNAME."_comment_text");
										    					if ($onecomment == "") $onecomment = "comment";
										    					$severalcomments = get_option(DESIGNARE_SHORTNAME."_comments_text");
										    					if ($severalcomments == "") $severalcomments = "comments";
										    					comments_number(__("0 ".$nocomment, "anya"), __("1 ".$onecomment,"anya"), __("% ".$severalcomments, "anya")); 
										    				?></span>
										    			</div>
														
														<div class="divider-tags">
															<a class="the_author" href="?author=<?php the_author_meta('ID'); ?>"><?php  the_author(); ?></a>
														</div>
														<div class="divider-tags">
															<span class="tags"><?php the_tags( ''. '', ', ', ''); ?></span>
														</div>
														<div class="divider-tags">
														<span class="categories"><?php the_category(', '); ?></span>
													</div>
													</div>
										    	</div>
										    	
										    	<div class="the_content">
											    	<?php 
											    		the_content();
											    		$args = array(
															'before'           => '<div class="navigation" style="margin-top: 0px;"><div class="des-pages"><span class="pages current">' . __('Post Pages:', 'anya') . '</span>',
															'after'            => '</div></div>',
															'link_before'      => '<div class="postpagelinks">',
															'link_after'       => '</div>',
															'next_or_number'   => 'number',
															'nextpagelink'     => __('Next page','anya'),
															'previouspagelink' => __('Previous page','anya'),
															'pagelink'         => '%',
															'echo'             => 1
														); 
											    		wp_link_pages($args); 
											    	?>
											    </div>   
											    

										    </div> <!-- end of .postcontent -->
										    <div class="des-sc-dots-divider"></div>
										    <div class="unk" style="<?php if ($sidebar == "left") echo 'padding-left:15px;'; ?>">
											    <?php comments_template( '', true ); ?>
										    </div>
										    <nav id="nav-below">
										    	
												<div class="nav-previous"><div class="icon-singles-left"><i class="icon-chevron-left"></i></div><?php if (!function_exists('icl_object_id')) previous_post_link( '%link', '%title <span class="meta-nav">' . get_option('anya_previous_text') . '</span>' ); else previous_post_link( '%link', '%title <span class="meta-nav">' . __('Older Entries','anya') . '</span>' ); ?></div>
												<div class="nav-next"><?php if (!function_exists('icl_object_id')) next_post_link( '%link', '%title <span class="meta-nav">' . get_option('anya_next_text') . '</span>' ); else next_post_link( '%link', '%title <span class="meta-nav">' . __('Newer Entries','anya') . '</span>' ); ?><div class="icon-singles-right"><i class="icon-chevron-right"></i></div></div>
											</nav><!-- #nav-below -->
										    	
									    	</div>
									    	
										</div>
										
									</div>

						    
						    </div> <!-- end of .postcontent -->
					    		    
					    </article> <!-- end of post -->

				<?php endwhile; // end of the loop. ?>

			
			</div><!-- #content -->
			</div>
			
			<?php if ($sidebar != "left") {
				?>
					</div>
				<?php
			} ?>	
			
			<?php if ($sidebar == "right") {
				?>
			
					<div class="four columns sright">
						<?php get_sidebar(); ?>
					</div>
			
				<?php
			} ?>
		</div><!-- #primary -->

<?php if ($sidebar == "left") {
	?>
		</div>
	<?php
} ?>

	<div class="clear"></div>

	<?php get_footer(); ?>
