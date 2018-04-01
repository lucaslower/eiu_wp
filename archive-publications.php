<?php
// THE ARCHIVE-PUBLICATIONS.PHP FILE
// LISTS ALL PUBLICATIONS
// (C) CATS 2018

// grab the header file
get_header();
?>

<header id="content_header">
<h1>All Publications</h1>
</header>

<section class="content pubs">

<ul>
<!-- MAIN PAGE CONTENT -->
<?php
//custom query
$args = array(
  'post_type' => 'publications',
  'order' => 'DESC',
  'orderby' => 'meta_value',
  'meta_key' => 'publication_year'
);
$pub_query = new WP_Query($args);

if( $pub_query->have_posts() ) : while ( $pub_query->have_posts() ) : $pub_query->the_post();
$terms = get_the_terms( get_the_ID(), 'pubtags' );

if ( $terms && ! is_wp_error( $terms ) ) :

    $tags = array();

    foreach ( $terms as $term ) {
        $tags[] = $term->name;
    }
  endif;
?>
    <li>
      <?php the_post_thumbnail('thumbnail'); ?>
      <h1><?php the_title(); ?></h1>
      <?php foreach($tags as $tag){ ?>
      <ul class="tags"><li><?php echo $tag; ?></li></ul>
    <?php } ?>
      <p><?php the_field('publication_authors'); ?></p>
      <p><?php the_field('citation'); ?></p>
      <p>Publication Year: <?php the_field('publication_year'); ?></p>
    </li>
<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

</ul>

</section>


<?php
// grab the footer file
get_footer();
?>
