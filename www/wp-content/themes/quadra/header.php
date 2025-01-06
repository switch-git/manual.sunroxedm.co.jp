<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>
<?php

     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         load_icon();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page()){
         load_icon();
       } elseif( ($options['load_icon_hide_archive'] != '1') && (is_home() || is_archive()) ){
         load_icon();
       }
     };

    // Message --------------------------------------------------------------------
    if($options['show_header_message'] && $options['header_message']) {
      if( (is_front_page() && $options['show_header_message_top']) || (!is_front_page() && $options['show_header_message_sub']) ) {
        if(isset($post->ID)){
          if(!get_post_meta($post->ID, 'page_hide_header_message', true)) {
            get_template_part( 'template-parts/header-message' );
          }
        }
      }
    }
 
    if( !is_page() || !get_post_meta($post->ID, 'page_hide_header', true) ) {
   
 ?>
 <header id="header" <?php if( (is_category() && $options['scroll_post_category_header']) ){ echo 'style="position:inherit;"'; } ?>>

  <div class="header_top">
    <div class="header_top_inner">
      <?php
          // Logo --------------------------------------------------------------------
      ?>
      <div id="header_logo">
      <?php header_logo(); ?>
      <p class="site_description"><?php echo esc_html(get_bloginfo('description')); ?></p>
      </div>
      <?php
          // Search form --------------------------------------------------------------------
          if( $options['show_header_search']) {
      ?>
      <div id="header_search">
      <!-- <div id="header_search_button"></div> -->
      <form role="search" method="get" id="header_searchform" action="<?php echo esc_url(home_url()); ?>">
        <div class="input_area"><input type="text" value="" id="header_search_input" name="s" autocomplete="off"></div>
        <div class="button"><label for="header_search_button"></label><input type="submit" id="header_search_button" value=""></div>
      </form>
      </div>
      <?php }; ?>
    </div>
  </div>

  <?php if(!is_404()){ ?>

  <div class="header_bottom">
    <!-- <div class="header_bottom_inner"> -->

      <?php
          // global menu ----------------------------------------------------------------
          if ( has_nav_menu('global-menu') ) {
      ?>
      <nav id="global_menu">
      <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
      <div id="global_menu_border" style="opacity:0;"></div>
      </nav>
      <?php }; ?>
      <?php get_template_part( 'template-parts/megamenu' ); ?>

    <!-- </div> -->
  </div>
  <?php } ?>

  <a id="global_menu_button" href="#"><span></span><span></span><span></span></a>

 </header>

 <?php }; // END hide header ?>

<div id="container">

 <?php
      //  Front page -------------------------------------------------------------------------
      if(is_front_page()) {

        $index_slider = '';
        $display_header_content = '';
        $slider_type = '';

        if(is_mobile() && ($options['mobile_show_index_slider'] == 'type2')){
          $device = 'mobile_';
        } else {
          $device = '';
        }

        if(!is_mobile() && $options['show_index_slider']) {
          $index_slider = $options['index_slider'];
          $display_header_content = 'show';
          $slider_type = $options['index_slider_type'];
        } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type2') ) {
          $index_slider = $options['mobile_index_slider'];
          $display_header_content = 'show';
          $slider_type = $options['mobile_index_slider_type'];
        } elseif(is_mobile() && ($options['mobile_show_index_slider'] == 'type1') ) {
          $index_slider = $options['index_slider'];
          $display_header_content = 'show';
          $slider_type = $options['index_slider_type'];
        }

        //  Header slider -------------------------------------------------------------------------
        if($display_header_content == 'show'){

          switch ($slider_type) {
            case 'type1':
              get_template_part('template-parts/index_slider_type1');
              break;
            case 'type2':
              get_template_part('template-parts/index_slider_type2');
              break;
            case 'type3':
              get_template_part('template-parts/index_slider_type3');
              break;
          }

        }; // END display_header_content

        // ボックスコンテンツ & ニュースティッカー
        get_template_part('template-parts/header-bottom-contents');

      }; // END front page
 ?>