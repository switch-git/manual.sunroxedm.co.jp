<?php
    
    get_header();
    $options = get_design_plus_option();

    $query_obj = get_queried_object();
    $current_cat_id = $query_obj->term_id;
    $children = get_term_children($current_cat_id, 'category');

    if($options['show_post_category_header']){
      get_template_part('template-parts/page-header-title'); 
    }
    get_template_part('template-parts/breadcrumb');
    
    if($options['show_post_category_search_form']){
      echo custom_searchform($options);
    }

    if(empty($children)){ // 通常の記事一覧
      get_template_part('template-parts/index_post_list');
    
    }else{ // 子カテゴリーに属する記事一覧
  
?>
<div id="post_category_archive">
 <div class="inner">
  <?php

    $args = array(
      'child_of' => $current_cat_id, //親カテゴリーに属する子カテゴリー
      'orderby' => 'term_order',
	  );

	  $cats = get_categories( $args );

    foreach( $cats as $cat ) : 

     $cat_id   = $cat->term_id;
     $cat_name = $cat->cat_name;
     $cat_desc = $cat->category_description;
     $cat_url  = get_category_link( $cat_id );

     $term_meta = get_option( 'taxonomy_' . $cat_id, array() );

  ?>
  <div class="category_group cat_id<?php echo esc_attr($cat_id); ?>">
   <?php // 子カテゴリー ---------------------------------------------------------- ?>
   <div class="content_wrap">
    <h2 class="headline"><a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a></h2>
    <?php if($cat_desc){ ?>
    <p class="description"><span><?php echo esc_html($cat_desc); ?></span></p>
    <?php } ?>
   </div><!-- END content_wrap -->
   <?php // 記事一覧    ---------------------------------------------------------- ?>
   <div class="post_list">
    <?php

      $args = array(
        'cat' => $cat_id, // 特定のカテゴリーのみ
        'posts_per_page' => -1,
        'no_found_rows' => true,  //ページャーを使う時はfalseに。
      );

      $the_query = new WP_Query($args);
      if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
   
    ?>
    <article class="item <?php if(!$options['show_post_category_desc']){ echo 'no_desc'; } ?>">
      <a class="link <?php echo quadra_hover_type() ?>" href="<?php the_permalink(); ?>">
        <h3 class="title line"><span><?php the_title(); ?></span></h3>
        <?php if($options['show_post_category_desc']){ ?>
        <p class="desc lines"><span class="two"><?php echo trim_excerpt(150); ?></span></p>
        <?php } ?>
      </a>
    </article>
    <?php endwhile; endif; wp_reset_postdata(); ?>
   </div><!-- END .post_list -->
  </div><!-- END .category_group -->
  <?php endforeach; ?>
 </div><!-- .inner -->
</div><!-- #post_category_archive -->

<?php

} // children
get_footer();

?>