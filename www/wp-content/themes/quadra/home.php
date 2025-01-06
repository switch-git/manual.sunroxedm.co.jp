<?php

    get_header();
    $options = get_design_plus_option();

    $catch = $options['post_archive_catch'];
    $desc = $options['post_archive_desc'];

    if($options['show_post_archive_header']){
      get_template_part('template-parts/page-header-title');
    }

    if($options['show_post_archive_search_form']){
      echo custom_searchform($options);
    }

?>
<div id="post_archive">
  <div class="inner">
    <?php if($catch && $desc){ ?>
    <div class="content">
    <?php if($catch){ ?><h2 class="headline common_headline rich_font"><span><?php echo wp_kses_post(nl2br($catch)); ?></span></h2><?php }; ?>
    <?php if($desc){ ?><p class="description"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p><?php }; ?>
    </div>
    <?php }; ?>
    <div class="category_list">
    <?php

      $args = array(
          'type' => 'post',
          'child_of' => 0,
          'parent' => 0, // 親だけ
          'orderby' => 'term_order',
          'order' => 'ASC',
          'hierarchical' => 1,
          'taxonomy' => 'category'
      );

	    $cats = get_categories( $args );

      foreach( $cats as $cat ) :

        $cat_id   = $cat->term_id;
        $cat_name = $cat->cat_name;
        $cat_desc = $cat->category_description;
        $cat_url  = get_category_link( $cat_id );

        $term_meta = get_option( 'taxonomy_' . $cat_id, array() );

        $class = '';
        if(isset($term_meta['icon_type'])){
          if($term_meta['icon_type'] == 'type1' && empty($term_meta['icon_image'])){
            $class = 'no_thumbnail';
          }
        }

    ?>
    <article class="item cat_id<?php echo esc_html($cat_id); ?>">
      <a class="link <?php echo quadra_hover_type() ?>" href="<?php echo esc_html($cat_url); ?>">
        <?php echo get_taxonomy_metadata($term_meta,$cat_name); //get_icon_image($icon_type, $icon_retina, $icon, $cat_name); ?>
        <div class="content_wrap <?php echo $class; ?>">
          <?php if($cat_name){ ?>
          <h3 class="title rich_font line"><?php echo wp_kses_post($cat_name); ?></h3>
          <?php }; if($cat_desc) { ?><p class="desc pc lines"><span class="two"><?php echo esc_html($cat_desc); ?></span></p><?php }; ?>
        </div>
        <?php if($cat_desc) { ?><p class="desc sp lines"><span class="two"><?php echo esc_html($cat_desc); ?></span></p><?php }; ?>
      </a>
    </article>
    <?php endforeach; ?>
    </div><!-- END manual_category_list -->
  </div><!-- END manual_archive_inner -->
</div><!-- END #manual_archive -->
<?php get_footer(); ?>