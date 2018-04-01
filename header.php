<?php
// THE HEADER.PHP FILE
// (C) CATS 2018
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="<?php bloginfo('charset'); ?>" />
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


  <?php
  // wordpress header script
  wp_head();
  ?>

  <!-- stylesheet, favicon, etc -->
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png" type="image/png"/>
</head>

<body>

<section id="sidebar">

<div class="masthead">
<img src="https://castle.eiu.edu/britto/wp-content/uploads/sites/7/2017/05/cropped-display_image_gsm-e1496330964657.jpg" alt="<?php wp_title(); ?>">
<h1><?php echo get_bloginfo('name'); ?></h1>
<h2>Eastern Illinois University</h2>
</div>

<nav id="primary">
<?php wp_nav_menu(array('theme_location' => 'primary')); ?>
</nav>
</section>

<!-- BEGIN SECTION#PAGE (ends in footer.php) -->
<section id="page">
