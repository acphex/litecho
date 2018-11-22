<?php get_header(); ?>
	<header class="site-header">
		<h1><?php bloginfo('name'); ?></h1>
	</header>
	<div class="posts">	
		<?php if ( have_posts() ) : ?>
		<ul class="post-list">
		<?php while ( have_posts() ) : the_post(); ?>
	
		<li id="post-<?php the_ID(); ?>">
			<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<p class="post-meta"><em><?php the_time('Y-m-d H:i:s'); ?></em><?php the_tags('', '', ''); ?></p>
		</li>
		<?php endwhile; ?>
		</ul>
		<?php 
		
			the_posts_pagination(
				array(
					'mid_size' => 2,
					'prev_text' => '前一页',
					'next_text' => '后一页',
					'screen_reader_text' => '分页'
				)			
			);
		
		else :
		
			//get_template_part( 'template-parts/post/content', 'none' );
		
		endif;
		?>
	</div>
<?php get_footer(); ?>
