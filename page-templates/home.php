<?php /* Template Name: home */ get_header(); ?>

<?php $page_thumb_url = get_the_post_thumbnail_url($post->ID,'full'); ?>

<div id="page-wrap" class="page-wrap homepage">
    <main id="main" role="main">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="row">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-md-12">
                            <div class="page_content">
                                <h1 class="page_title"><?php the_title();?></h1>
                                <div class="content">
                                    <?php the_content(); ?>
                                </div>
                                <?php if(has_post_thumbnail()): ?>
                                    <div class="post_thumbnail">
                                        <img src="<?php the_post_thumbnail_url('large');?>" alt="">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
              </div>
            <?php endif; ?>
        </div>

    </main>

</div>


<?php get_footer(); ?>
