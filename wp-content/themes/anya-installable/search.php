<?php
/**
 * @package WordPress
 * @subpackage Anya
 */

 	get_header();
 	
 	
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
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
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
		    			<h3 class="page_title" style="<?php 
			    			$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));			
							echo "color: #$tcolor; font-size: $tsize;";		    	?>"></h3>
		    			<?php
				    	if (get_option(DESIGNARE_SHORTNAME."_search_secondary_title") != ""){	?>
					    <h3 class="secondaryTitle" style="<?php
				    		$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";
			    		?>" ><?php echo get_option(DESIGNARE_SHORTNAME."_search_secondary_title"); ?></h3>
			    		<?php
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
				$sidebar = get_option(DESIGNARE_SHORTNAME."_search_archive_sidebar");
				$postconfig = " sixteen columns";
		    	$postlistingstyle = "";
		    	
		    	if ($sidebar == "left" || $sidebar == "right") {
		    		$postconfig = " twelve columns";
		    		$postlistingstyle = 'style="border-right: 1px solid #ededed;"';
		    	}
		    	if ($sidebar == "left") {
			    	//get_sidebar();	
			    	$postlistingstyle = 'style="border-left: 1px solid #ededed;"';
			    	
		    	}
				if ($sidebar == "left"){
					?>
						<div class="four columns">
							<?php get_sidebar(); ?>
						</div>
			    	<?php
				}

	global $anya_reading_option; $anya_reading_option = get_option('anya_blog_reading_type');
	global $anya_more;
		$anya_more = 0;

	$orderby="";
	$category="";
	$nposts = "";

	$pag = 1;
	
	if (isset($_GET['paged'])) $pag = $_GET['paged'];
	else {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pagina = explode('/page/', $pageURL);
		if(isset($pagina[1])) $pagina = explode ('/', $pagina[1]);
		if ($pagina[0]) $pag = $pagina[0];	
	}
	if (!is_numeric($pag)) $pag = 1;
?>


	<?php 
	
		$se = get_option(DESIGNARE_SHORTNAME."_search_everything");

		if ($se == "on"){
			$args = array(
				'showposts' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'paged' => $pag,
				's' => esc_html($_GET['s'])
			);
				
			//global $post, $wp_query;
		    
		    $the_query = new WP_Query( $args );
		    
		    $args2 = array(
				'showposts' => -1,
				'post_status' => 'publish',
				'paged' => $pag,
				's' => esc_html($_GET['s'])
			);
			
			$counter = new WP_Query($args2);
			
		} else {
			$args = array(
				'showposts' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'paged' => $pag,
				'post_type' => 'post',
				's' => esc_html($_GET['s'])
			);
				
			//global $post, $wp_query;
		    
		    $the_query = new WP_Query( $args );
		    
		    $args2 = array(
				'showposts' => -1,
				'post_status' => 'publish',
				'paged' => $pag,
				'post_type' => 'post',
				's' => esc_html($_GET['s'])
			);
			
			$counter = new WP_Query($args2);
		}
	
	    
	    
	    ?>
	    	
	    <div id="primary" class="blogarchive <?php echo $postconfig;  ?>">
			<div id="content">
			
			
	    	
	   	<?php
		
		if ($the_query->have_posts()){
		
		?>
		<div class="pageTitle">
            <h2 class="hsearchtitle"><?php echo $counter->post_count . " " . __(get_option(DESIGNARE_SHORTNAME.'_search_results_text'), "anya") . " " . $_GET['s'];  ?></h2>
        </div>
		
		<div class="post-listing">

            <?php

                while ( $the_query->have_posts() ) :

                    $the_query->the_post();	 ?>

                        <?php
                            global $anya_more;
                            $anya_more = 0;
                        ?>

                        <article id="post-<?php the_ID(); ?>" class="post <?php post_class(); ?>">

                            <?php

                            $posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
                            $postid = get_the_ID(); ?>

                            <div class="postcontent">

                            <?php

                                switch($posttype){
                                    case "image":

                                        if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
                                        ?>

                                            <div class="featured-image-thumb" onmouseover="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0.6)'); $(this).find('.magnify_this_thumb').css('left', '51%').css('opacity',1); $(this).find('.hyperlink_this_thumb').css('left', '39%').css('opacity',1);" onmouseout="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0)'); $(this).find('.magnify_this_thumb').css('left', '-15%').css('opacity',0); $(this).find('.hyperlink_this_thumb').css('left', '105%').css('opacity',0);">
                                                <h2>
                                                    <img alt="" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($postid)); ?>" title="<?php the_title(); ?>"/>
                                                </h2>
                                            </div>
                                            <?php
                                        }

                                        break;
                                    case "slider":
                                        $randClass = rand(0,1000);
                                        ?>
                                            <div class="flexslider <?php echo $posttype; ?>" id="<?php echo $randClass; ?>">
                                                <ul class="slides">
                                                    <?php
                                                        $sliderData = get_post_meta($postid, "sliderImages_value", true);
                                                        $slide = explode("|*|",$sliderData);
                                                        foreach ($slide as $s){
                                                            if ($s != ""){
                                                                $url = explode("|!|",$s);
                                                                echo "<li>";
                                                                echo "<img src='".$url[1]."' alt='' class='rp_style1_img'>";
                                                                echo "</li>";
                                                            }
                                                        }
                                                    ?>
                                                </ul>
                                            </div>
                                        <?php
                                        break;
                                    case "audio":
                                        $randClass = rand(0,1000);
                                        ?>
                                        <div class="audioContainer">
                                            <?php echo get_post_meta($postid, 'audioCode_value', true); ?>
                                        </div>
                                        <?php
                                        break;
                                    case "video":
                                        ?>
                                        <div class="video-thumb">
                                            <?php
                                                $datamovie = rand();
                                                echo "<div data-movie='$datamovie' id='the_movies' class='the_movies'></div>";
                                                $videosType = get_post_meta($postid, "videoSource_value", true);
                                                $videos = get_post_meta($postid, "videoCode_value", true);
                                                $videos = preg_replace( '/\s+/', '', $videos );
                                                $vid = explode(",",$videos);
                                                switch (get_post_meta($postid, "videoSource_value", true)){
                                                    case "youtube":
                                                        foreach ($vid as $v){
                                                            echo "<div data-movie='$datamovie' class='v_links'>http://www.youtube.com/embed/".$v."?autoplay=0&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0</div>";
                                                        }
                                                        break;
                                                    case "vimeo":
                                                        foreach ($vid as $v){
                                                            echo "<div data-movie='$datamovie' class='v_links'>http://player.vimeo.com/video/".$v."</div>";
                                                        }
                                                        break;
                                                }
                                            ?>
                                        </div>
                                        <?php
                                        break;
                                }
                            ?>

                                <div class="post-cc">
                                    <div class="tr-blogfw">
                                        <div class="td-blogfw">
                                            <div class="data_type">

                                                <div class="cutcorner_top"></div>
                                                <?php $authors = get_all_authors($post->ID); ?>

                                                <div class="data author-image" style="background: inherit !important;">
                                                    <a style="background: url('<?=$authors[0]['image'];?>') no-repeat; background-size: cover;" title="<?=$authors[0]['name'];?>" href="<?=$authors[0]['url']; ?>"></a>
                                                </div>

                                                <?php if ($posttype != "none" && $posttype != "") echo '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>'; ?>

                                                <div class="cutcorner_bottom"></div>

                                            </div>
                                        </div>
                                        <div class="thepostcont post-list">

                                            <div class="the_title"><h2><a href="<?php the_permalink() ?>"><?php  the_title(); ?></a></h2></div>

                                            <ul class="meta-list">
                                                <li class="date-author">
                                                    <?php  echo get_the_date(); ?>
                                                    <?=format_by_line($authors);?>
                                                </li>
                                                <li class="comments">
                                                    <?php
                                                        if (comments_open()) {
                                                            $nocomment = get_option(DESIGNARE_SHORTNAME."_no_comments_text");
                                                            if ($nocomment == "") $nocomment = "comments";
                                                            $onecomment = get_option(DESIGNARE_SHORTNAME."_comment_text");
                                                            if ($onecomment == "") $onecomment = "comment";
                                                            $severalcomments = get_option(DESIGNARE_SHORTNAME."_comments_text");
                                                            if ($severalcomments == "") $severalcomments = "comments";
                                                            comments_number(__(""), __("<i class=\"fa fa-comment\"></i> 1 ".$onecomment,"anya"), __("<i class=\"fa fa-comments\"></i> % ".$severalcomments, "anya"));
                                                        }
                                                    ?>
                                                </li>
                                            </ul>

                                            <div class="blog_excerpt">
                                                <?php the_excerpt(); ?>
                                            </div>

                                            <ul class="meta-list meta-list-bottom">
                                                <li class="tag-icon"><i class="fa fa-tags"></i></li>
                                                <li class="category"><?php
                                                    the_category('', 'multiple');
                                                    $cat = get_the_category($post->ID );
                                                ?></li>
                                                <?php if(!empty(wp_get_post_tags($post->ID))) { ?>
                                                <li class="tags">
                                                       <?php the_tags( ''. '', '', ''); ?>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="des-sc-dots-divider"></div>

                        </article> <!-- end of post -->

                    <?php endwhile; ?>

            </div> <!-- end of post-listing -->
					
			<div class="navigation navigation-blog" style="margin-top: 10px;">
				<?php
					global $anya_reading_option;
					if ($anya_reading_option != "paged" && $anya_reading_option != "dropdown"){ ?>
						<div class="next-posts"><?php next_posts_link('&laquo; ' . __(get_option(DESIGNARE_SHORTNAME."_previous_text"), "anya"), $the_query->max_num_pages);  ?></div>
						<div class="prev-posts"><?php  previous_posts_link(__(get_option(DESIGNARE_SHORTNAME."_next_text"), "anya") . ' &raquo;', $the_query->max_num_pages); ?></div>
					<?php
					} else {
						wp_pagenavi();
					}
				?>
				
			</div>

									
		<?php  }  else { ?>
	
		<div class="post-listing eleven columns">
			<div class="pageTitle">
				<h2 class="hsearchtitle">No results found for '<?=$_GET['s']?>'.</h2>
				<p class="titleSep"></p>
			</div>
		</div>
		
		
	<?php } ?>
	
		<?php if ($sidebar != "left") {
				?>
					</div>
				<?php
			} ?>
	    
			

			</div><!-- #primary -->

<?php if ($sidebar == "right") {
	?>
		<div class="four columns sright" style="margin-left:2.5%;">	
	<?php
	get_sidebar(); 
	?>
		</div>
	<?php
} if ($sidebar == "left") {
	?>
		</div>
	<?php
} ?>

</div>

	<div class="clear"></div>
	
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('h3.page_title').html($('.pageTitle > h2').html());
	});
</script>


<?php get_footer(); ?>
