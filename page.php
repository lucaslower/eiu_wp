<?php
// THE PAGE.PHP FILE
// (C) CATS 2018

// grab the header file
get_header();
?>

<header id="content_header">
<h1><?php single_post_title(); ?></h1>
</header>

<section class="content main">

<!-- MAIN PAGE CONTENT -->
<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</section>


<?php
// grab the footer file
get_footer();
?>
