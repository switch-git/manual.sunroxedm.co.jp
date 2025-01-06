<?php

  $options = get_design_plus_option();
    
  $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
  $counter = 0;
    
  if ( $category && ! is_wp_error($category) ) {
    
    foreach ( $category as $cat ) : $counter++;

      if($counter == 1) { //一周目

        $cat_name = $cat->name;
        $cat_id = $cat->term_id;
        $cat_url = get_term_link($cat_id,'category');
        $cat_parent = $cat->parent;

        if($cat_parent == 0) { // 親カテゴリーだったら

          $parent_cat_id = $cat_id;
          $parent_cat_name = $cat_name; //これが親カテゴリーの名前
          $parent_cat_url = $cat_url; //これが親カテゴリーのURL
          $children = get_term_children( $cat_id, 'category' );//子カテゴリーを持っていたら
          if ($children) { continue; } else { break; }

        } else { $exist_child = true; //子カテゴリーだったら
                    
          $child_cat_id = $cat_id;
          $child_cat_name = $cat_name;
          $child_cat_url = $cat_url;
          $parent_cat_id = $cat_parent;
          $parent_cat_name = get_the_category_by_ID($parent_cat_id); // 親カテゴリーの名称
          $parent_cat_url = get_term_link($parent_cat_id,'category');

          break;

        } //親子判定終了
      } // 一周目終わり

      if(in_array($cat->term_id, $children, true)) { //カテゴリーIDが$childrenの中身と一致するかどうか
        $exist_child = true;
        $child_cat_id = $cat->term_id;
        $child_cat_name = get_the_category_by_ID($child_cat_id); // 子カテゴリーの名称
        $child_cat_url = get_term_link($child_cat_id,'category'); //子カテゴリーのURL
        break;

      } else { continue; }

    endforeach;
    
  };

  $widget_children = get_term_children( $parent_cat_id, 'category' );

  if(!empty($widget_children)){
  
?>
<div class="widget_content category_list_widget">
  <h3 class="widget_headline"><span class="headline"><?php echo esc_html($parent_cat_name);?></span></h3>
  <ul>
    <?php

      foreach($widget_children as $child):

        $widget_cat = get_category( $child );
        $widget_cat_name = $widget_cat->name;
        $widget_cat_url = get_term_link($child,'category');

    ?>
    <li class="cat_<?php echo esc_attr($child); ?>">
      <a href="<?php echo esc_attr($widget_cat_url); ?>"><?php echo esc_html($widget_cat_name); ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>
<?php } ?>