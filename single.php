<?php get_header(); ?>

<?php
if ( have_posts() ) :

	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		//get_template_part( 'template-parts/post/content', get_post_format() );

?>

<article>
	<header class="post-header">
		<?php the_title( '<h1>', '</h1>' ); ?>
	</header>
	<div class="post-content">
		<?php the_content(); ?>
	</div>
	<footer class="post-footer">
		<p class="post-meta"><em><?php the_time('Y-m-d H:i:s'); ?></em><?php the_tags('', '', ''); ?></p>
	</footer>
</article>

<?php

	endwhile;

	/*the_posts_pagination( array(
		'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
		'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
	) );*/

else :

	get_template_part( 'template-parts/post/content', 'none' );

endif;
?>

<?php get_footer(); ?>