<?php
     get_header();
     $options = get_design_plus_option();

     $page_sidebar_type = get_post_meta($post->ID, 'page_sidebar_type', true);
     if($page_sidebar_type == 'type1'){
       $sidebar_type = 'left';
     }elseif($page_sidebar_type == 'type2'){
       $sidebar_type = 'right';
     }

     $use_custom_side_content = get_post_meta($post->ID, 'use_custom_side_content', true);

     $hide_header_image = get_post_meta($post->ID, 'page_hide_header_image', true);
     $hide_sidebar = get_post_meta($post->ID, 'page_hide_sidebar', true);
     $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '850';

     do_action( 'tcd_before_page_content' );
     
     get_template_part('template-parts/page-header-title');
     
?>
<div id="main_contents" class="<?php if(!$hide_sidebar){ echo $sidebar_type; }else{ echo 'no_side'; }  ?>">
  <div class="inner" <?php if($hide_sidebar) { ?>style="max-width:<?php echo esc_attr($page_content_width); ?>px;"<?php }; ?>>
    <div id="main_col">
      <div class="inner">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="article">
          <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
          <div class="post_content clearfix">
          <?php
               the_content();
               if ( ! post_password_required() ) {
                    custom_wp_link_pages();
               }
          ?>
          </div>
       </article>
       <?php endwhile; endif; ?>
      </div><!-- END #main_col .inner -->
    </div><!-- END #main_col -->
  <?php

     if(!$hide_sidebar){
       if($use_custom_side_content){
          get_template_part('template-parts/page_side_widget');
       }else{
          get_sidebar();
       }
     }

  ?>
  </div><!-- END #main_contents .inner -->
</div><!-- END #main_contents -->
<?php get_footer(); ?>