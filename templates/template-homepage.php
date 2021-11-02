<?php
/**
 * Template Name: Homepage Template
 * Template Post Type: page
 */

// get_template_part( 'singular' );
?>

<?php get_header();?>

<main id="homepage">
    <?php while ( have_posts() ) : the_post(); ?>
        <h1>Homepage</h1>
    <?php endwhile; ?>
</main>

<?php get_footer();?>