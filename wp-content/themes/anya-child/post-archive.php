<?php
/**
 * @package WordPress
 * @subpackage Anya
 */

get_header();


$style = "";
$headerFontSize = "";
$tshadow = "";
$subheading = get_the_subheading($post->ID);
if($subheading){
	$subheading = ' - '.$subheading;
}
    if (get_the_post_thumbnail()) {
        $featuredImage = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
        $style = "background-image: url('" . $featuredImage[0] . "');";
         $headerY = get_post_meta($post->ID, 'headerImageY_value', true);
         if ($headerY) {
            $style .= "background-position: center " . $headerY . " !important;";
         }
        $headerFontSize = "font-size:40px;";
        $tshadow = "text-shadow: 1px 1px 2px rgba(0, 0, 0, 1);";
        $excerpt = get_the_excerpt();
    }


		global $anya_reading_option; $anya_reading_option = get_option(DESIGNARE_SHORTNAME.'_blog_reading_type');
		
		global $anya_more;
			$anya_more = 0;

		?>
		
		<div class="fullwidth-container header-image <?=get_post_meta($post->ID, 'headerImageAlign_value', true); ?>" style="<?=$style;?>">

			<div class="page-title-container page-title-container-blog-single
	    	<?=get_post_meta_or_default_with_prefix(
	    	    $post->ID, 'pageCustomColor_value', 'color-brand-secondary',
	    	    ' page-title-container-');?><?php if ($style == "") { ?> page-title-container-no-image<?php } ?>">
                <div class="container">
                    <h1 class="page_title">
                        <a href="/blog/" style="color: #ffffff;">Blog</a>
                    </h1>
                    <h2 class="post_title">
                        <?php /* If this is a category archive */ if (is_category()) { ?>
                            Category: <?php single_cat_title(); ?>
                        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                            Posts Tagged &#8216;<?php single_tag_title(); ?>
                        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                            Archive for <?php the_time('F jS, Y'); ?>
                        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                            Archive for <?php the_time('F, Y'); ?>
                        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                            Archive for <?php the_time('Y'); ?>
                        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                            <?php the_author();?> - Author Archive
                        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                            Blog Archives

                        <?php } ?></h1>
                            <?php
                                if (!is_array(get_option(DESIGNARE_SHORTNAME."_archive_secondary_title"))){	?>
                                <h2 class="secondaryTitle" style="<?php
                                    $stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
                                    $stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
                                    echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";
                                ?>" ><?php echo get_option(DESIGNARE_SHORTNAME."_archive_secondary_title"); ?></h2>
                                <?php
                                }
                            ?>
                    </h2>
                </div>
            </div>
            <div class="lead-container
            <?=get_post_meta_or_default_with_prefix(
                $post->ID, 'pageCustomColor_value',
                'color-brand-secondary', ' lead-container-'
                );?>">
                <div class="container">
                    <?php
                    if (get_post_meta($post->ID, 'leadText_value', true) != ""){
                    ?>
                        <?=get_post_meta($post->ID, 'leadText_value', true);?>
                    <?php } ?>
                </div>
            </div>
		</div>
	<div id="white_content">
	
		<div id="wrapper">
		
			<div class="container">
				

			
			<?php
				$sidebar = get_option(DESIGNARE_SHORTNAME."_blog_archive_sidebar");
				$postconfig = " sixteen columns";
		    	$postlistingstyle = "";
		    	
		    	if ($sidebar == "left" || $sidebar == "right") {
		    		$postconfig = " twelve columns";
		    		$postlistingstyle = 'style="border-right: 1px solid #ededed; "';
		    	}
		    	if ($sidebar == "left") {
			    	//get_sidebar();	
			    	$postlistingstyle = 'style="border-left: 1px solid #ededed; width: 100% !important;"';
			    	
		    	}
				if ($sidebar == "left"){
					?> 
					<div class="four columns" style="margin-left: 0 !important;">
						<?php get_sidebar(); ?>
					</div>
					<?php
				}
			?>
		
		<div id="primary" class="blogarchive <?php echo $postconfig; if ($sidebar == "none") echo " fullwidth"; if ($sidebar == "left") echo " blog-ls"; if ($sidebar == "right") echo " blog-rs"; ?>">
			<div id="content">
			
			
	    	
	   	<?php
		
		if (have_posts()){
		
		?> 
		
		<div style="padding-top:20px;" class="post-listing" <?php echo $postlistingstyle; ?>>
		
			<?php

				$columns = "twelve columns";
		    	if ($postconfig === " sixteen columns") $columns = "sixteen columns";					

			    while ( have_posts() ) : 
						
			    	the_post();	 ?>
			    	
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
					
			<div class="navigation">
				<?php
					
					global $anya_reading_option;
					if ($anya_reading_option != "paged" && $anya_reading_option != "dropdown"){ 
						$the_query = new WP_Query();
					?>
						<div class="next-posts"><?php  next_posts_link('&laquo; ' . __(get_option(DESIGNARE_SHORTNAME."_previous_text"), "anya"), $the_query->max_num_pages);  ?></div>
							<div class="prev-posts"><?php  previous_posts_link(__(get_option(DESIGNARE_SHORTNAME."_next_text"), "anya") . ' &raquo;', $the_query->max_num_pages); ?></div>		
					<?php
					} else { 
						wp_pagenavi();
					}
				?>
				
			</div>

									
		<?php  }
		
		?>
			<?php if ($sidebar != "left") {
				?>
					</div>
				<?php
			} ?>
	    
			
		</div><!-- #content -->		
		
	</section><!-- #primary -->


<?php if ($sidebar == "right") {
	?>
		<div class="four columns" style="margin-left: 2.5% !important; margin-right:0;">	
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

	<div class="clear"></div>
		
<?php get_footer(); ?>
