<?php
/**
 * Template Name: Blog Template Right-Sidebar
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

if(get_the_post_thumbnail()){
	 $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	 $style = "background-image: url('".$featuredImage[0]."');";
	 $headerY = get_post_meta($post->ID, 'headerImageY_value', true);
	 if ($headerY) {
	    $style .= "background-position: center " . $headerY . " !important;";
	 }
	 $headerFontSize = "font-size:40px;";
	 $tshadow = "text-shadow: 1px 1px 2px rgba(0, 0, 0, 1);";
	 $excerpt = get_the_excerpt();
}
global $anya_custom, $anya_styleColor;
$type = des_get_value(DESIGNARE_SHORTNAME."_header_type");
if (empty($type)) $type = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
$color = des_get_value(DESIGNARE_SHORTNAME."_header_color");
$image = des_get_value(DESIGNARE_SHORTNAME."_header_image");
$pattern = DESIGNARE_PATTERNS_URL.des_get_value(DESIGNARE_SHORTNAME."_header_pattern");
$height = des_get_value(DESIGNARE_SHORTNAME."_header_height");
$margintop = des_get_value(DESIGNARE_SHORTNAME."_header_text_margin_top");
$banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider");

$user_image    = get_post_meta($post->ID,'staff_photo',true);
$user_linkedin = get_post_meta($post->ID,'staff_linkedin',true);
$user_twitter  = get_post_meta($post->ID,'staff_twitter',true);
$user_github   = get_post_meta($post->ID,'staff_github',true);
$user_facebook = get_post_meta($post->ID,'staff_facebook',true);

?>

	<div class="fullwidth-container header-image <?=get_post_meta($post->ID, 'headerImageAlign_value', true); ?>" style="<?=$style;?>">
        <div class="page-title-container
            <?=get_post_meta_or_default_with_prefix(
            $post->ID, 'pageCustomColor_value', 'color-brand-primary',
            ' page-title-container-');?><?php if (!$style) { ?>
            page-title-container-no-image<?php } ?>">
            <div class="container">
                <h1 class="page_title">
                    <?php echo the_title(); ?>
                </h1>
            </div>
        </div>
        <?php
        if (get_post_meta($post->ID, 'pageNav_value', true) == "") {
        ?>
        <div class="lead-container
        <?=get_post_meta_or_default_with_prefix(
            $post->ID, 'pageCustomColor_value',
            'color-brand-primary', ' lead-container-'
            );?>">
            <div class="container">
                <?=get_post_meta($post->ID, 'staff_role', true); ?>
                <?php
                if (get_post_meta($post->ID, 'leadText_value', true) != ""){
                ?>
                    <?=get_post_meta($post->ID, 'leadText_value', true);?>
                <?php } ?>
            </div>
        </div>

        <?php
        } else {
        ?>
            <div class="pagenav-container
            <?=get_post_meta_or_default_with_prefix(
            $post->ID, 'pageCustomColor_value', 'color-brand',
            ' pagenav-container-');?>">
                <div class="container">
                    <ul class="nav nav-page">
                        <li class="nav-header">
                            Go To
                        </li>
                    <?php
                        $pNavString = get_post_meta($post->ID, 'pageNav_value', true);
                        $pNavString = trim($pNavString, ";");
                        $pageNav = explode(";", $pNavString);
                    ?>
                    <?php foreach ($pageNav as $pItem) {
                        $navElems = explode(",", $pItem);
                    ?>
                        <li>
                            <a href="#<?=trim($navElems[1]);?>">
                                <?=trim($navElems[0]);?>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
        <?php
        }
        ?>

        <?php if ($type === "banner") { ?>
            <div class="revBanner">
                <?php if (function_exists('putRevSlider')) putRevSlider(substr($banner, 10)); ?>
            </div>
         <?php } ?>

        <div class="clear"></div>
    </div>
	<div id="white_content">

		<div id="wrapper">

			<div class="container">


<?php

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

	global $anya_reading_option; $anya_reading_option = get_option('anya_blog_reading_type');
	global $anya_more;
		$anya_more = 0;
?>


		<section id="primary" role="region" class="blogarchive blog-rs twelve columns">
			<div id="content">

				<?php
				    $args = array(
				    	'showposts' => $nposts,
				    	'cat' => $category,
				    	'post_status' => 'publish',
				    	'paged' => $pag
				    );

				    global $post, $wp_query;

				    $the_query = new WP_Query( $args );

				    if ($the_query->have_posts()){ ?>

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

						<div class="navigation navigation-blog">
							<?php

								global $anya_reading_option;
								if ($anya_reading_option != "paged" && $anya_reading_option != "dropdown"){ ?>
									<div class="next-posts"><?php next_posts_link('&laquo; ' . __(get_option(DESIGNARE_SHORTNAME."_older_posts"), "anya"), $the_query->max_num_pages);  ?></div>
									<div class="prev-posts"><?php previous_posts_link(__(get_option(DESIGNARE_SHORTNAME."_newer_posts"), "anya") . ' &raquo;', $the_query->max_num_pages); ?></div>
								<?php
								} else {
									wp_pagenavi();
								}
							?>

						</div>

					<?php  }

				?>


			</div><!-- #content -->

		</section><!-- #primary -->

		<div class="four columns" style="margin-left: 2.5% !important; margin-right:0;">
			<?php get_sidebar(); ?>
		</div>

		<div class="clear"></div>
		<!-- BREADCRUMBS -->

<?php get_footer(); ?>
