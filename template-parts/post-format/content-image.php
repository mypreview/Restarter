<?php
/**
 * The default template for displaying content.
 * Used for index/archive/search only.
 *
 * @see 			https://developer.wordpress.org/reference/functions/get_media_embedded_in_content/
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.1.3
 */
?>
<!-- Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class('tile post-tile format-image'); ?> itemscope="itemscope" itemtype="https://schema.org/BlogPosting" itemprop="blogPost">
	<?php 
	// A list of found HTML images.
	$get_images = get_media_embedded_in_content(apply_filters('the_content', get_the_content()), array('img'));
	if ((has_post_thumbnail() || !empty($get_images)) && ! post_password_required() && ! is_attachment()): ?>
	<div class="post-thumb">
		<a href="<?php the_permalink(); ?>" target="_self">
			<?php 
			if (has_post_thumbnail()):
				the_post_thumbnail('full', array('itemprop' => 'image')); 
			elseif (!has_post_thumbnail() && !empty($get_images)):
				echo $get_images[0];
			endif;
			?>
		</a>
		<div class="post-meta">
			<?php 
			Restarter::entry_date();
			if (comments_open()): 
			?>
			<span class="comments-count">
				<?php comments_popup_link(__('Leave a comment', 'restarter'), __('One comment so far', 'restarter'), __('View all % comments', 'restarter') ); ?>
			</span><!-- .comments-count -->
			<?php endif; ?>
		</div><!-- .post-meta -->
	</div><!-- .post-thumb -->
	<?php endif; ?>
	<div class="tile-body post-body">
		<?php if ((has_post_thumbnail() || !empty($get_images)) && ! post_password_required() && ! is_attachment()): ?>
		<div class="post-format"></div>
		<?php else: ?>
		<div class="post-meta">
			<?php 
			Restarter::entry_date();
			if (comments_open()): 
			?>
			<span class="comments-count">
				<?php comments_popup_link(__('Leave a comment', 'restarter'), __('One comment so far', 'restarter'), __('View all % comments', 'restarter') ); ?>
			</span><!-- .comments-count -->
			<?php endif; ?>
		</div>
		<?php 
		endif;
		the_title('<h3 class="post-title" itemprop="headline"><a href="' . esc_url(get_the_permalink()) . '" target="_self" rel="bookmark" itemprop="url">', '</a></h3>');
		?>
		<div class="post-meta">
			<?php if ('post' === get_post_type()): ?>
			<span class="post-author" itemprop="author" itemscope="itemscope" itemtype="https://schema.org/Person">
				<?php the_author_posts_link(); ?>
			</span><!-- .post-author -->
			<?php
			endif;
			$get_categories = get_the_category();
			if(! empty($get_categories)):
			?>
			<span class="delimiter">|</span>
			<span class="post-taxonomy" itemprop="about">
				<?php
				esc_html_e('in ', 'restarter');
				the_category(', '); 
				?>
			</span><!-- .post-taxonomy -->
			<?php 
			endif; 
			if (get_post_type() === 'post'):
				edit_post_link(__('Edit', 'restarter'), '<span class="delimiter">|</span><span class="post-edit">', '</span>');
			else:
				edit_post_link(__('Edit', 'restarter'), '<span class="page-edit">', '</span>');
			endif;
			?>
		</div><!-- .post-meta -->
		<a href="<?php the_permalink(); ?>" class="btn btn-ghost btn-primary btn-sm" target="_self"><?php esc_html_e('Read More', 'restarter'); ?></a>
	</div><!-- .tile-body post-body -->
</article><!-- .tile.post-tile.format-standard -->