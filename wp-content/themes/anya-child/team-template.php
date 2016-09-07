<?php
/**
 * Template Name: Team Template
 * @package WordPress
 * @subpackage Anya
 */



$style = "";
$headerFontSize = "";
$tshadow = "";

get_header(); 

if(get_the_post_thumbnail()){ 
 $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 $style = "background-image: url('".$featuredImage[0]."');";
 $headerY = get_post_meta($post->ID, 'headerImageY_value', true);
 if ($headerY) {
    $style .= "background-position: center " . $headerY . " !important;";
 }
 $excerpt = get_the_excerpt();
}


?>
	<div class="fullwidth-container header-image <?=get_post_meta($post->ID, 'headerImageAlign_value', true); ?>" style="<?=$style;?>">
	    	<div class="page-title-container<?php
	    	if (get_post_meta($post->ID, 'pageCustomColor_value', true) != ""){
            ?> page-title-container-<?=get_post_meta($post->ID, 'pageCustomColor_value', true);?><?php } ?>">
                <div class="container">
	    	        <h1 class="page_title"><?php echo the_title(); echo $subheading; ?></h1>
                </div>
            </div>
	    	<?php
	    	if (get_post_meta($post->ID, 'leadText_value', true) != ""){
            ?>
                <div class="lead-container<?php
	    	if (get_post_meta($post->ID, 'pageCustomColor_value', true) != ""){
            ?> lead-container-<?=get_post_meta($post->ID, 'pageCustomColor_value', true);?><?php } ?>">
                    <div class="container">
                        <?=get_post_meta($post->ID, 'leadText_value', true);?>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
	    	if (get_post_meta($post->ID, 'pageNav_value', true) != ""){
            ?>
                <div class="pagenav-container<?php
	    	if (get_post_meta($post->ID, 'pageCustomColor_value', true) != ""){
            ?> pagenav-container-<?=get_post_meta($post->ID, 'pageCustomColor_value', true);?><?php } ?>">
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

	    	<?php
		    	if ($type === "banner"){
			    	?>
			    	<div class="revBanner"> 
			    		<?php if (function_exists('putRevSlider')) putRevSlider(substr($banner, 10)); ?> 
			    	</div>
			    	<?php
		    	}
	    	?>
		    </div>
	<div id="white_content">
	
		<div id="wrapper">
		
			<div class="container">
				<?php
					if ($type == "border"){
						?>
				
						<?php
					}
				?>
				<?php the_post(); ?>
			
				<div class="post" id="post-<?php the_ID(); ?>">

					<div class="entry sidebar-<?php echo get_post_meta($post->ID, 'sidebar_for_default_value', true); ?> container">
						<?php
							$sidebar = get_post_meta($post->ID, 'sidebars_available_value', true);
							switch (get_post_meta($post->ID, 'sidebar_for_default_value', true)){
								case "none":
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
									do_shortcode(the_content());
								break;
							}
                    $staffCategories = get_pages( array( 'child_of' => 176243767, 'sort_column' => 'menu_order', 'parent' => 176243767 ) );
                    ?>
					</div>
					<?php
					foreach ($staffCategories as $cat) { ?>
						<section>
						    <p class="anchor-team-container"><a id="<?=$cat->post_name;?>" class="anchor-team"></a></p>
							<h2 class="team-header"><?=$cat->post_title;?></h2>
							<div class="team-row 4">
                                <?php 	$staffList = get_pages( array( 'child_of' => $cat->ID, 'sort_column' => 'menu_order' ) );
                                foreach( $staffList as $ind=>$staff ) {
                                    $staff_photo = get_post_meta($staff->ID, 'staff_photo', true);
                                    $staff_role = get_post_meta($staff->ID, 'staff_role', true);
                                ?>
                                    <div class="team-member four columns">
                                        <a class="team-member-link"
                                            href="<?= get_permalink($staff->ID); ?>"
                                            <?php if ($staff_photo): ?>style="background-image: url('/<?php echo $staff_photo; ?>');"<?php endif; ?>>
                                            <span class="team-member-desc">
                                                <span><?=$staff->post_title;?></span>
                                                <span class="team-member-role"><?=$staff_role;?></span>
                                            </span>
                                        </a>
                                    </div>
                                    <?php if (($ind+1) % 4 == 0) { ?>
                            </div><div class="clear"></div>
                            <div class="team-row 4">
                                    <?php } ?>
                                <?php } ?>
						</section>
						<div class="clear"></div>

					<?php } ?>
					<div class="clear"></div></div>



				</div>
		
				<div class="clear"></div>
		
<?php get_footer(); ?>
