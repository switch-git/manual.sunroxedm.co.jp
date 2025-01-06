<?php

    $options = get_design_plus_option();

    $show_home_header = $options['show_post_archive_header'];

    $show_category_header = $options['show_post_category_header'];
    $scroll_category_header = $options['scroll_post_category_header'];

    $title_color = '';
    $tag = 'h1';

    switch (true) {

      case is_home() :

        $title = $options['post_label'] ? esc_html( $options['post_label'] ) : __( 'Post', 'tcd-w' );
        if(!$options['post_header_title_color_use_sub']){
          $title_color = 'style="background:'.esc_attr($options['post_header_title_color']).';"';
        }
        break;

      case is_category() :

        $query_obj = get_queried_object();
        $current_cat_id = $query_obj->term_id;
        $current_cat = get_category($current_cat_id);
        $title = $current_cat->name;
        $parent_cat_id = $current_cat->parent;

        if($parent_cat_id != 0){
         $parent_cat = get_category($parent_cat_id);
         $title = $parent_cat->name;
         $term_meta = get_option( 'taxonomy_' . $parent_cat_id, array() );
         if(isset($term_meta['color2_use_sub'] ) && isset($term_meta['color2'])){
            if(!$term_meta['color2_use_sub']){
              $title_color = 'style="background-color:'.esc_attr($term_meta['color2']).';"';
            }
          }
        }else{
         $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
         $title_color = '';
         if(isset($term_meta['color2_use_sub'] ) && isset($term_meta['color2'])){
            if(!$term_meta['color2_use_sub']){
              $title_color = 'style="background-color:'.esc_attr($term_meta['color2']).';"';
            }
          }
        }
        break;

      case is_single() :

        $tag = 'p';
        $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
        $counter = 0;
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) : $counter++;

            if($counter == 1) { //一周目

                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                $cat_parent = $cat->parent;

                if($cat_parent == 0) { // 親カテゴリーだったら

                    $parent_cat_id = $cat_id;
                    $parent_cat_name = $cat_name; //これが親カテゴリーの名前
                    $children = get_term_children( $cat_id, 'category' );//子カテゴリーを持っていたら
                    if ($children) { continue; } else { break; }

                } else { $exist_child = true; //子カテゴリーだったら

                    $child_cat_id = $cat_id;
                    $child_cat_name = $cat_name;
                    $parent_cat_id = $cat_parent;
                    $parent_cat_name = get_the_category_by_ID($parent_cat_id); // 親カテゴリーの名称

                    break;

                } //親子判定終了
            } // 一周目終わり

            if(in_array($cat->term_id, $children, true)) { //カテゴリーIDが$childrenの中身と一致するかどうか
                $exist_child = true;
                $child_cat_id = $cat->term_id;
                $child_cat_name = get_the_category_by_ID($child_cat_id); // 子カテゴリーの名称
                break;

            } else { continue; }
          endforeach;
        };

        $title = $parent_cat_name;
        $term_meta = get_option( 'taxonomy_' . $parent_cat_id, array() );
        if(isset($term_meta['color2_use_sub'] ) && isset($term_meta['color2'])){
          if(!$term_meta['color2_use_sub']){
            $title_color = 'style="background-color:'.esc_attr($term_meta['color2']).';"';
          }
        }
        break;

      case is_post_type_archive('news') :

        $title = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
        if(!$options['archive_news_header_title_color_use_sub']){
          $title_color = 'style="background:'.esc_attr($options['archive_news_header_title_color']).';"';
        }
        break;

      case is_post_type_archive('blog') :

        $title = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );
        if(!$options['archive_blog_header_title_color_use_sub']){
          $title_color = 'style="background:'.esc_attr($options['archive_blog_header_title_color']).';"';
        }
        break;

      case is_tax('blog_category') :

        $title = single_term_title('', false);
        break;

      case is_page() :

        $title = $title = get_the_title();
        break;

      case is_tag() :

        $query_obj = get_queried_object();
        $title = $query_obj->name;
        break;

      case is_author() :

        $author_info = $wp_query->get_queried_object();
        $author_id = $author_info->ID;
        $user_data = get_userdata($author_id);
        $user_name = $user_data->display_name;
        $title = sprintf( __( 'Archive for %s', 'tcd-w' ), $user_name );
        break;

      case is_day() :

        $title = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F jS, Y', 'tcd-w' ) ) );
        break;

      case is_month() :

        $title = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'F, Y', 'tcd-w') ) );
        break;

      case is_year() :

        $title = sprintf( __( 'Archive for %s', 'tcd-w' ), get_the_time( __( 'Y', 'tcd-w') ) );
        break;


      }

?>
<div class="archive_header_title_wrap">
  <div id="archive_header_title"<?php echo $title_color; ?>>
    <div class="inner">
      <?php
        if(is_category() || is_single()){
          echo get_taxonomy_metadata($term_meta,$title);
        }
      ?>
      <?php if($title){ ?>
      <<?php echo $tag; ?> class="title"><?php echo esc_html($title); ?></<?php echo $tag; ?>>
      <?php } ?>
    </div>
  </div>
</div>
