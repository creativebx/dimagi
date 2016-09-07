<?php 
/**
 * The template for displaying a single event
 *
 * Please note that since 1.7, this template is not used by default. You can edit the 'event details'
 * by using the event-meta-event-single.php template.
 *
 * Or you can edit the entire single event template by creating a single-event.php template
 * in your theme. You can use this template as a guide.
 *
 * For a list of available functions (outputting dates, venue details etc) see http://codex.wp-event-organiser.com/
 *
 ***************** NOTICE: *****************
 *  Do not make changes to this file. Any changes made to this file
 * will be overwritten if the plug-in is updated.
 *
 * To overwrite this template with your own, make a copy of it (with the same name)
 * in your theme directory. See http://docs.wp-event-organiser.com/theme-integration for more information
 *
 * WordPress will automatically prioritise the template in your theme directory.
 ***************** NOTICE: *****************
 *
 * @package Event Organiser (plug-in)
 * @since 1.0.0
 */

//Call the template header
get_header();

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
?>

<?php while ( have_posts() ) : the_post(); ?>
<div class="fullwidth-container header-image <?=get_post_meta($post->ID, 'headerImageAlign_value', true); ?>" style="<?=$style;?>">
	<div class="page-title-container
        <?=get_post_meta_or_default_with_prefix(
        $post->ID, 'pageCustomColor_value', 'color-brand-primary',
        ' page-title-container-');?><?php if (!$style) { ?>
        page-title-container-no-image<?php } ?>">
        <div class="container">
            <h1 class="page_title events-page-title">
                <strong>Event:</strong> <?php echo the_title(); ?>
            </h1>
        </div>
    </div>
</div>	
<div id="white_content">
	
	<div id="wrapper">
		
		<div class="container">
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="entry container">

					<div class="entry-content">
						<!-- Get event information, see template: event-meta-event-single.php -->
						<?php eo_get_template_part('event-meta','event-single'); ?>

						<!-- The content or the description of the event-->
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->

					<!-- If comments are enabled, show them -->
					<div class="comments-template">
						<?php comments_template(); ?>
					</div>				

			
				</div><!-- #entry container -->
			</div><!-- #post -->
		</div><!-- #container -->
	</div><!-- #wrapper -->
</div><!-- #white_content -->
<?php endwhile; // end of the loop. ?>
<!-- Call template footer -->
<?php get_footer(); ?>
