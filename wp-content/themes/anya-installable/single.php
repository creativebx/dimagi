<?php
/**
 * @package WordPress
 * @subpackage Anya
 */

get_header(); ?>

	
	<?php 
		if (have_posts()) {
			while (have_posts()){
				the_post(); 
				$type = get_post_type();
			}
		}
		if ($type === "post") {
			get_template_part('post-single', 'single');
		}
		$portfolio_permalink = get_option(DESIGNARE_SHORTNAME."_portfolio_permalink");
		if ($type === $portfolio_permalink) {
			get_template_part('proj-single', 'single');
		}
		?>

	
<?php get_footer(); ?>