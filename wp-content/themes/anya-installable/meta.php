<div class="metas">									    	
	<div class="metas-div">
		<?php
			if (comments_open()){
				?>
				<div class="divider-tags">
					<span class="blog-i comments"><?php comments_number(__("0 Comments", "anya"), __("1 Comment","anya"), __("% Comments", "anya")); ?></span>
				</div>
				<?php
			}
		?>
		
		<div class="divider-tags">
			<a class="the_author" href="?author=<?php the_author_meta('ID'); ?>"><?php  the_author(); ?></a>
		</div>
		<?php if (count(get_the_tags())>0) {
			?>
				<div class="divider-tags">
					<span class="tags"><?php the_tags( ''. '', ', ', ''); ?></span>
				</div>
			<?php
		} ?>
		<?php if (count(get_the_category())>0) {
			?>
				<div class="divider-tags">
					<span class="categories"><?php the_category( ''. '', ', ', ''); ?></span>
				</div>
			<?php
		} ?>
		<div class="divider-tags">
			<span class="date"><?php echo get_the_date(); ?></span>
		</div>
	</div>
</div>