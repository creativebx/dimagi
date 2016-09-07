<?php
/**
 * Template Name: Team Member Profile Page
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
$user_linkedin = get_post_meta($post->ID,'username_linkedin',true);
$user_twitter  = get_post_meta($post->ID,'username_twitter',true);
$user_github   = get_post_meta($post->ID,'username_github',true);
$user_facebook = get_post_meta($post->ID,'username_facebook',true);

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
	<div class="content-container-main content-container-team <?php if (!$style) { ?> content-container-no-heading<?php } ?> content-container-<?=get_post_meta($post->ID, 'pageCustomColor_value', true);?>">
        <div class="container">
            <div class="breadcrumbs breadcrumbs-team">
                <ul>
                    <li><a href="/team/">Team</a></li>
                    <li><a href="/team/#<?=get_post($post->post_parent)->post_name;?>"><?=get_the_title($post->post_parent);?></a></li>
                    <li><?php echo the_title(); ?></li>
                </ul>
            </div>
            <div class="post" id="post-<?php the_ID(); ?>">
                <?php the_post(); ?>
                <div class="entry entry-team sidebar-<?php echo get_post_meta($post->ID, 'sidebar_for_default_value', true); ?> container">
                    <?php
                        $sidebar = get_post_meta($post->ID, 'sidebars_available_value', true);
                        switch (get_post_meta($post->ID, 'sidebar_for_default_value', true)){
                            case "none":
                                if($user_image){ ?>
                                 <div class="team-profile-photo" style="background-image: url('/<?=$user_image;?>');"></div>
                                    <ul class="team-social-links">
                                        <?php if ($user_twitter != "") { ?>
                                            <li><a href="<?=$user_twitter;?>"><i class="fa fa-twitter-square"></i></a></li>
                                        <?php } ?>
                                        <?php if ($user_linkedin != "") { ?>
                                            <li><a href="<?=$user_linkedin;?>"><i class="fa fa-linkedin-square"></i></a></li>
                                        <?php } ?>
                                        <?php if ($user_facebook != "") { ?>
                                            <li><a href="<?=$user_facebook;?>"><i class="fa fa-facebook-square"></i></a></li>
                                        <?php } ?>
                                        <?php if ($user_github != "") { ?>
                                            <li><a href="<?=$user_github;?>"><i class="fa fa-github-square"></i></a></li>
                                        <?php } ?>
                                    </ul>
                                <?php }
                                do_shortcode(the_content());
                            break;
                            case "left":
                                ?>
                                <div class="four columns sidebar-top-space page-sidebar-left">
                                    <?php
                                        if ( function_exists('dynamic_sidebar')) {
                                            ob_start();
                                            do_shortcode(dynamic_sidebar($sidebar));
                                            $cont = ob_get_contents();
                                            ob_end_clean();
                                            echo $cont;
                                            wp_reset_query();
                                        }
                                    ?>
                                </div>
                                <div class="twelve columns">
                                    <div class="sidebars-contents-left">
                                        <?php do_shortcode(the_content()); ?>
                                    </div>
                                </div>
                                <?php
                            break;
                            case "right":
                                ?>
                                <div class="twelve columns">
                                    <div class="sidebars-contents">
                                        <?php do_shortcode(the_content()); ?>
                                    </div>
                                </div>
                                <div class="four columns sidebar-top-space page-sidebar-right">
                                    <?php
                                        if ( function_exists('dynamic_sidebar')) {
                                            ob_start();
                                            do_shortcode(dynamic_sidebar($sidebar));
                                            $html = ob_get_contents();
                                            ob_end_clean();
                                            echo $html;
                                            wp_reset_query();
                                        }
                                    ?>
                                </div>
                                <?php
                            break;
                            default:
                            break;
                        } ?>

                 </div>
             </div>
            <div class="clear"></div>
        </div>
	</div>

<?php 
//=================================================================================================================================
// Fetches all the entries written by this team member.
$username_blog = get_post_meta( $post->ID, 'username_blog' , true );
$user = get_user_by( 'slug', $username_blog );
if($user):
	$user = $user->data;
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
    <div class="blogarchive">

        <?php
            $args = array(
                'showposts'      => $nposts,
                'posts_per_page' => 6,
                'cat'            => $category,
                'post_status'    => 'publish',
                'paged'          => $pag,
                'author'         => $user->ID
            );

            global $post, $wp_query;

            $the_query = new WP_Query( $args );

            if ($the_query->have_posts()){ ?>

                <div class="container">
                <h2>
                    Most Recent Posts By
                    <?php echo the_title(); ?>
                </h2>
                <?php
                    $postCount = 0;
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post();	 ?>

                        <?php
                        global $anya_more;
                        $anya_more = 0;

                        $posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
                        $postid = get_the_ID();

                        $columns = "sixteen columns";

                        ?>

                        <?php if ($postCount % 2 == 0) { ?><div class="post-row"><?php }
                            $postCount ++;
                        ?>
                            <div class="post-col">
                                <article id="post-<?php the_ID(); ?>" class="post <?php post_class(); ?>">
                                    <div class="postcontent">
                                        <div class="post-cc">
                                            <div class="thepostcont post-list">

                                                <div class="post-info">
                                                    <div class="the_title"><h2><a href="<?php the_permalink() ?>"><?php  the_title(); ?></a></h2></div>

                                                    <ul class="meta-list">
                                                        <li class="date-author">
                                                            <?php  echo get_the_date(); ?>
                                                            by <a href="<?php echo $author_url; ?>">
                                                                <?php  the_author(); ?>
                                                            </a>
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
                                                </div>

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

                                    </div> <!-- end of .postcontent -->
                                </article> <!-- end of post -->
                            </div>
                        <?php if ($postCount % 2 == 0) { ?></div>
                            <div class="des-sc-dots-divider"></div>
                        <?php } ?>

                    <?php endwhile; ?>
                    <?php if ($postCount %2 == 1)   { ?></div>
                        <div class="des-sc-dots-divider"></div>
                    <?php } ?>
                    <div class="navigation navigation-bottom navigation-blog">
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

                </div> <!-- end of post-listing -->



            <?php  }

        ?>

    </div>
<?php
endif;
//======================================================================================================================================= 
?>
		
<?php get_footer(); ?>	
