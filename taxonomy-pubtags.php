<?php
// THE TAXONOMY-PUBTAGS.PHP FILE
// LISTS ALL PUBLICATIONS WITH SPECIFIC TAG
// (C) CATS 2018

// grab the header file
get_header();
?>

<header id="content_header">
<h1>All Publications</h1>
</header>

<section class="content pubs">

  <div class="taglist">
  <h1>Filter by tags:</h1>
  <ul class="tags">
    <?php $new_link = get_site_url() . '/?post_type=publications'; ?>
    <li title="Click to show all tags"><a href="<?php echo $new_link; ?>">All</a></li><li class="divider"></li>
  <?php
  $tags = get_terms( array(
      'taxonomy' => 'pubtags',
      'hide_empty' => false,
      'orderby' => 'count',
      'order' => 'DESC'
  ) );
  $getme = $_GET['pubtags'];

  foreach($tags as $tag){
  $current = explode(' ',$getme);
  $current = array_filter($current);
  if(in_array($tag->slug,$current)){
  $key = array_search($tag->slug,$current);
  unset($current[$key]);
  $new_get = implode('+',$current);
  if(count($current) == 0){
    $new_link = get_site_url() . '/?post_type=publications';
  }
  else{
      $new_link = get_site_url() . '/?pubtags=' . $new_get;
  }
  ?>
  <li title="Click to remove this tag from filter" class="current"><a href="<?php echo $new_link;?>"></i><?php echo $tag->name; ?></a></li>
  <?php } else{
    $current[] = $tag->slug;
    $new_get = implode('+',$current);
    $new_link = get_site_url() . '/?pubtags=' . $new_get;
  ?>
  <li title="Click to filter by this tag"><a href="<?php echo $new_link;?>"><?php echo $tag->name; ?></a></li>
  <?php } }?>
  </ul>
  </div>

<ul>
<!-- MAIN PAGE CONTENT -->
<?php
$pub_query = new WP_Query($query_string."&orderby=meta_value&meta_key=publication_year&order=DESC");

if( $pub_query->have_posts() ) : while ( $pub_query->have_posts() ) : $pub_query->the_post();
$terms = get_the_terms( get_the_ID(), 'pubtags' );
?>

    <li>
      <?php the_post_thumbnail('thumbnail'); ?>
      <h1><?php the_title(); ?></h1>
    <?php
      if ( $terms && ! is_wp_error( $terms ) ) :


      ?>
            <ul class="tags">
              <?php if(get_field('external_link') || get_field('downloadable_file')){ ?>
              <?php if(get_field('external_link')){ ?>
                <li title="Click to view this publication's abstract" class="link"><a href="<?php the_field('external_link');?>">Abstract<i class="fa fa-external-link"></i></a></li>
              <?php } if(get_field('downloadable_file')){ ?>
                <li title="Click to download this publication" class="link"><a href="<?php the_field('downloadable_file');?>">Download<i class="fa fa-download"></i></a></li>
              <?php } ?>
              <li></li>
              <?php } ?>
            <?php foreach($terms as $term){ ?>
            <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
            </ul>
          <?php endif; ?>
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
