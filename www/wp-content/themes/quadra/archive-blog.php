<?php

    get_header();
    $options = get_design_plus_option();

    $animation_type = 'animation_'.$options['archive_blog_animation'];

    if($options['show_archive_blog_header_title']){
      get_template_part('template-parts/page-header-title'); 
    }

?>
<div id="blog_archive">
  <div class="inner">
  <?php

     $blog_category_list = get_terms( 'blog_category', array( 'orderby' => 'order' ) );
     if ( $blog_category_list && ! is_wp_error( $blog_category_list ) && $options['archive_blog_show_category_list'] ) {
       $label = $options['archive_blog_category_list_label'];
  ?>
  <ol class="category_list">
    <?php if($label){ ?>
    <li class="active item"><a href="<?php echo esc_url(get_post_type_archive_link('blog')); ?>" class="link"><?php echo esc_html($label); ?></a></li>
    <?php } ?>
    <?php
       foreach ( $blog_category_list as $cat ):
         $cat_id = $cat->term_id;
         $cat_name = $cat->name;
         $cat_url = get_category_link( $cat_id );
    ?>
    <li class="item"><a class="link" href="<?php echo esc_attr($cat_url); ?>" id="blog_cat_<?php echo esc_attr($cat_id); ?>"><?php echo esc_html($cat_name); ?></a></li>
    <?php endforeach; ?>
  </ol>
  <?php

      };

  ?>
  <div class="post_list <?php echo $animation_type; ?>">
    <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }

         $blog_category = wp_get_post_terms( $post->ID, 'blog_category' , array( 'orderby' => 'term_order' ));
         if ( $blog_category && ! is_wp_error($blog_category) ) {
           foreach ( $blog_category as $blog_cat ) :
            $blog_cat_name = $blog_cat->name;
            $blog_cat_id = $blog_cat->term_id;
            $blog_cat_url = get_category_link( $blog_cat_id );
            break;
           endforeach;
         }

    ?>
    <article class="item animate_background <?php echo quadra_hover_type(); ?>">
      <a href="<?php the_permalink(); ?>" class="link">
        <div class="title_wrap">
          <h2 class="title lines"><span class="two"><?php the_title(); ?></span></h2>
        </div>
        <div class="image_wrap">
          <?php if ( $blog_category && ! is_wp_error($blog_category) ) { ?>
          <span class="category" data-href="<?php echo esc_attr($blog_cat_url); ?>"><?php echo esc_attr($blog_cat_name); ?></span>
          <?php } ?>
          <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center top; background-size:cover;"></div>
        </div>
        <div class="content_wrap">
          <p class="desc lines"><span class="two"><?php echo trim_excerpt(150); ?></span></p>
          <p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
        </div>
      </a>
    </article>
    <?php endwhile; ?>
  </div><!-- END post_list -->
  <?php get_template_part('template-parts/navigation'); ?>
  </div><!-- END .inner -->
</div><!-- END #blog_archive2 -->
<?php get_footer(); ?>