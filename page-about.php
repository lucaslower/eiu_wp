<?php
// THE PAGE-ABOUT.PHP FILE
// DISPLAYS BIO INFORMATION
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

<section class="content listcontainer">
<!-- ACADEMIC POSITIONS -->
<section class="positions">
  <h1 class="title">Academic Positions</h1>
<table>
<?php
//custom query
$args = array(
  'post_type' => 'positions',
  'order' => 'DESC',
  'orderby' => 'meta_value',
  'meta_key' => 'start_year'
);
$pos_query = new WP_Query($args);

if( $pos_query->have_posts() ) : while ( $pos_query->have_posts() ) : $pos_query->the_post();
?>

<tr>
<td>
<div class="years">
<span><?php the_field('end_year'); ?></span>
<?php the_field('start_year'); ?>
</div>
</td>
<td>
<div class="info">
<h1><?php the_title(); ?></h1>
<p><?php the_field('dept_school'); ?></p>
</div>
</td>
</tr>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php
// end custom query
wp_reset_postdata();
?>
</table>
</section>

<!-- EDUCATION -->
<section class="positions ed">
  <h1 class="title">Education & Training</h1>
<table>
<?php
//custom query
$args = array(
  'post_type' => 'degrees',
  'order' => 'DESC',
  'orderby' => 'meta_value',
  'meta_key' => 'degree_year'
);
$deg_query = new WP_Query($args);

if( $deg_query->have_posts() ) : while ( $deg_query->have_posts() ) : $deg_query->the_post();
?>

<tr>
<td>
<div class="years">
<span><?php the_field('degree_type'); ?></span>
<?php the_field('degree_year'); ?>
</div>
</td>
<td>
<div class="info">
<h1><?php the_title(); ?></h1>
<p><?php the_field('school_name'); ?></p>
</div>
</td>
</tr>

<?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php
// end custom query
wp_reset_postdata();
?>
</table>
</section>
</section>

<section class="content">
  <!-- EDUCATION -->
  <section class="awards">
    <h1 class="title">Honors, Awards, & Grants (Selected)</h1>
<ul class="cont">
  <?php
  //custom query
  $args = array(
    'post_type' => 'awards',
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'award_year'
  );
  $award_query = new WP_Query($args);

  if( $award_query->have_posts() ) : while ( $award_query->have_posts() ) : $award_query->the_post();
  ?>

<li>

  <div class="year">
  <?php the_field('award_year'); ?>
  </div>

  <div class="info">
  <h1 id="h1<?php echo get_the_ID(); ?>" onClick="expand(<?php echo get_the_ID(); ?>)"><?php the_title(); ?><i id="i<?php echo get_the_ID(); ?>" class="fa fa-angle-down"></i></h1>
  <div style="height: 0;" class="text" id="<?php echo get_the_ID(); ?>"><?php the_content(); ?></div>
  </div>

</li>
  <?php endwhile; else : ?>
  	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
  <?php
  // end custom query
  wp_reset_postdata();
  ?>
</ul>
  </section>
</section>

<script type="text/javascript">
function expand(postid){
  if($('#' + postid).height() == 0){
    $('#i' + postid).toggleClass('flip');
    $('#' + postid).animate({height: $('#' + postid).get(0).scrollHeight},200,'linear',function(){
    $('#' + postid).height('auto');
});

  }
  else{
    $('#i' + postid).toggleClass('flip');
    $('#' + postid).animate({height: 0},200,'linear','');
  }
}
</script>

<section class="content pubs listcontainer">
  <h1 class="title">Featured Publications</h1>
  <ul>
  <!-- MAIN PAGE CONTENT -->
  <?php
  //custom query
  $args = array(
    'post_type' => 'publications',
    'order' => 'DESC',
    'orderby' => 'meta_value',
    'meta_key' => 'publication_year',
    'meta_query' => array(
    array(
        'key' => 'featured',
        'value' => true,
        'compare' => '=',
    ),
  ),
  );
  $pub_query = new WP_Query($args);

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
        <?php foreach($terms as $term){ ?>
        <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
        <?php } ?>
        </ul>
      <?php endif; ?>
        <p><?php the_field('publication_authors'); ?></p>
        <p><?php the_field('citation'); ?></p>
        <p>Publication Year: <?php the_field('publication_year'); ?></p>
      </li>
  <?php endwhile; else :
    $args = array(
      'post_type' => 'publications',
      'order' => 'DESC',
      'orderby' => 'meta_value',
      'meta_key' => 'publication_year',
      'posts_per_page' => 3
    );
    $pub_query = new WP_Query($args);

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
    <?php endif;
  endif;
  // end custom query
  wp_reset_postdata();
  ?>

  </ul>
</section>

<?php
// grab the footer file
get_footer();
?>
