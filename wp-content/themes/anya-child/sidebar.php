<?php
/**
 * @package WordPress
 * @subpackage Anya
 */
?>
		<div id="secondary" class="widget-area four columns alpha">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
				<aside id="subscribe" class="widget" role="complementary">
					<h2 class="widget-title"><?php _e( 'Subscribe to our blog!', 'anya' ); ?></h2>
					<!--[if lte IE 8]>
					<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
					<![endif]-->
					<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
					<script>
						hbspt.forms.create({ 
							portalId: '503070',
							formId: 'b5604cf8-d730-43ea-ab51-20d9e1941458'
						});
					</script>

				</aside>

				<aside id="search" class="widget widget_search" role="complementary">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget" role="complementary">
					<h2 class="widget-title"><?php _e( 'Archives', 'anya' ); ?></h2>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget" role="complementary">
					<h2 class="widget-title"><?php _e( 'Meta', 'anya' ); ?></h2>
					<ul>
						<?php wp_register(); ?>
						<aside role="complementary"><?php wp_loginout(); ?></aside>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
