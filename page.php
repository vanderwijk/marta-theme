<?php get_header(); ?>

    <div id="content">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </article>
            <?php endwhile; // end of the loop. ?>
    </div>

    <?php get_footer(); ?>
