<?php get_header(); ?>

	<!-- section -->
	<section role="main">

		<h1><?php echo sprintf( __( '%s Search Results for ', 'imaginet' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('search_result'); ?>>
					<div class="title"><?php the_title(); ?></div>
					<div class="excerpt"><?php the_excerpt(); ?></div>
					<a href="<?php the_permalink();?>"><?php _e('Read More','imaginet');?></a>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
