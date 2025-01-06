<?php
     global $post;
     $options = get_design_plus_option();

     $sidebar = '';

     if ( is_mobile() ) {

       if(is_singular('blog')) {
         $sidebar = 'blog_single_widget_mobile';
       } elseif(is_singular('news')) {
         $sidebar = 'news_single_widget_mobile';
       } elseif ( is_page() ) {
         $sidebar = 'page_single_widget_mobile';
       } elseif ( is_single() ) {
         $sidebar = 'post_single_widget_mobile';
       }

       if ( is_active_sidebar( $sidebar ) || is_active_sidebar( 'common_widget_mobile' )) {
?>
<div id="side_col">
 <div class="inner">
 <?php if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar( $sidebar ); } elseif(is_active_sidebar( 'common_widget_mobile' )) { dynamic_sidebar( 'common_widget_mobile' ); }; ?>
 </div>
</div>
<?php
       };

     } else {

       if(is_singular('blog')) {
         $sidebar = 'blog_single_widget';
       } elseif(is_singular('news')) {
         $sidebar = 'news_single_widget';
       } elseif ( is_page() ) {
         $sidebar = 'page_single_widget';
       } elseif ( is_single() ) {
         $sidebar = 'post_single_widget';
       }

       if ( is_active_sidebar( $sidebar ) || is_active_sidebar( 'common_widget' )) {
?>
<div id="side_col">
 <div class="inner">
 <?php
    if($options['show_single_post_category_widget'] && is_singular( 'post' )){
      get_template_part('template-parts/single-side-widget');
    }
 ?>
 <?php if ( is_active_sidebar( $sidebar ) ) { dynamic_sidebar( $sidebar ); } elseif(is_active_sidebar( 'common_widget' )) { dynamic_sidebar( 'common_widget' ); }; ?>
 </div>
</div>
<?php
       };

     };
?>