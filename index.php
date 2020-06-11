<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<?php
if ( have_posts() ) {
    while ( have_posts() ) : the_post();?>

        <div class="content-container">
            <?php the_content(); ?>
        </div>

    <?php
    endwhile;

}

?>
<?php get_footer(); ?>