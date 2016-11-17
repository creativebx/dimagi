<?php get_header(); 

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
	<div class="content-container-main content-container-<?=get_post_meta($post->ID, 'pageCustomColor_value', true);?>">
        <div class="container">

            <div class="post" id="post-<?php the_ID(); ?>">
                <?php the_post(); ?>
                <div class="entry sidebar-<?php echo get_post_meta($post->ID, 'sidebar_for_default_value', true); ?> container">
                    <?php
                        $sidebar = get_post_meta($post->ID, 'sidebars_available_value', true);
                        switch (get_post_meta($post->ID, 'sidebar_for_default_value', true)){
                            case "none":
                                if($user_image){
                                    echo ( '<img style="float:left;padding: 0 25px 25px 0;width:250px;" src="/'.$user_image.'">');
                                }
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
		
<?php get_footer(); ?>	
