<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu'][$item->ID] ) ) return $item_output;

  if ( 'type1' === $options['megamenu'][$item->ID] ) return $item_output;

  if ( 'type2' === $options['megamenu'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button type2" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'type3' === $options['megamenu'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button type3" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  // if ( 'type4' === $options['megamenu'][$item->ID] ) {
  //   return sprintf( '<a href="%s" class="megamenu_button type4" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  // }

}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A - Category list ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
  if(!empty($megamenus[$id])) {
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_inner">

  <div class="category_list_area">
   <?php
        foreach ( $megamenus[$id] as $menu ) :
          if ( 'category' !== $menu->object ) continue;
            $cat_id = $menu->object_id;
            $cat_name = $menu->title;
            $url = $menu->url;
            $term_meta = get_option( 'taxonomy_' . $cat_id, array() );

            $class = '';
            if(isset($term_meta['icon_type'])){
              if($term_meta['icon_type'] == 'type1' && empty($term_meta['icon_image'])){
                $class = 'no_thumbnail';
              }
            }
   ?>
   <div class="item cat_id<?php echo esc_attr($cat_id); ?>">
    <a class="link <?php echo quadra_hover_type() ?>" href="<?php echo esc_url($url); ?>">
     <?php echo get_taxonomy_metadata($term_meta, $cat_name); ?>
     <div class="title rich_font <?php echo $class ?>"><span class="main_title"><?php if($cat_name) { echo esc_html($cat_name); }; ?></span></div>
    </a>
   </div>
   <?php
        endforeach;
   ?>
  </div>

 </div><!-- END .megamenu_a_inner -->
</div><!-- END .megamenu_a -->
<?php

  };
};

// Mega menu B -  Category post list ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
?>
<div class="megamenu megamenu_b" id="js-megamenu<?php echo esc_attr( $id ); ?>">
 <div class="megamenu_inner">
  <ul class="category_list">
   <?php
        $i = 1;
        if(isset($megamenus[$id])){
        foreach ( $megamenus[$id] as $menu ) :
          if ( 'blog_category' !== $menu->object ) continue;
          $cat_id = $menu->object_id;
          $cat_name = $menu->title;
          $url = $menu->url;
   ?>
   <li<?php if($i == 1) { echo ' class="active"'; }; ?>><a data-cat-id="mega_cat_id<?php echo esc_attr($cat_id); ?>" class="cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($url); ?>"><?php echo esc_html($cat_name); ?></a></li>
   <?php $i++; endforeach; ?>
  </ul>
  <div class="post_list_area">
   <?php
       foreach ( $megamenus[$id] as $menu ) :
         if ( 'blog_category' !== $menu->object ) continue;
           $cat_id = $menu->object_id;
           $post_order = $options['mega_menu_b_post_order'];
           if($post_order == 'rand'){
             $args = array( 'post_type' => 'blog', 'posts_per_page' => 4, 'orderby' => 'rand', 'tax_query' => array( array( 'taxonomy' => 'blog_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
           } else {
             $args = array( 'post_type' => 'blog', 'posts_per_page' => 4, 'tax_query' => array( array( 'taxonomy' => 'blog_category', 'field' => 'term_id', 'terms' => $cat_id ) ) );
           }
           $post_list = new wp_query($args);
           if($post_list->have_posts()):
   ?>
   <div class="post_list clearfix mega_cat_id<?php echo esc_attr($cat_id); ?>">
   <div class="post_list_inner">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
           }
    ?>
    <div class="item">
     <a class="clearfix animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <div class="title rich_font"><span><?php the_title_attribute(); ?></span></div>
      </div>
      <?php if($options['show_mega_menu_b_date']){ ?>
      <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
      <?php }; ?>
     </a>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div>
   </div>
   <?php endif; // END end post list ?>
   <?php endforeach; }?>
  </div><!-- END post_list_area -->
 </div>
</div>
<?php
}
