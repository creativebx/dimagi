<?php
/*
Template Name: Homepage Template
*/
?>

<?php get_header(); ?>

	<?php
		$slidertype = get_post_meta(get_the_ID(), 'homepageslider_value', true);
		if ($slidertype == "no_slider"){
			?>
				<div class="home-no-slider"></div>
			<?php
		}
	?>

   	<div id="white_content">
	
		<div id="wrapper">
		
			<?php
				global $bodyLayoutType;
				if ($bodyLayoutType == "boxed"){
					if (substr($slidertype, 0, 10) === "revSlider_"){ 
						?>
						<div id="slider_container">
							<?php 
								if (!function_exists('putRevSlider')){
									echo 'Please install the missing plugin - Revolution Slider.';
								} else putRevSlider(substr($slidertype, 10)); 
							?>
						</div>
						<?php
					}
				}				
			?>
		
			<div class="container">
	    		<div class="reset_960">
		    		
			    	<?php the_post(); ?>
		
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
						
							<div class="entry-content">
								<?php do_shortcode(the_content()); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'anya' ), 'after' => '</div>' ) ); ?>
							</div><!-- .entry-content -->
			    		
						</article><!-- #post-<?php the_ID(); ?> -->
		    		
		    		
	    		</div>
    		
    		
    <script type="text/javascript">
    	jQuery(document).ready(function(){
	    	jQuery("#wrapper").siblings(".clear").remove();
    	});
    </script>
    		
<?php get_footer(); ?>