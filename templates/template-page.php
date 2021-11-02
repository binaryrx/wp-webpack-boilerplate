<?php
/**
 * Template Name: Page Template
 * Template Post Type: page
 */

// get_template_part( 'singular' );
?>

<?php get_header();?>

<main id="homepage">
    <?php while ( have_posts() ) : the_post(); ?>
        <h1>Page</h1>
    <?php endwhile; ?>
</main>

<?php get_footer();?>