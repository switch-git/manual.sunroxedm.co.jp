<?php
     $options = get_design_plus_option();
     global $post;
     if(is_page()){
       $change_content_width = get_post_meta($post->ID, 'change_content_width', true);
       $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '850';
       if(!$change_content_width) {
         $page_content_width = '850';
       };
     };

     $post_label = $options['post_label'] ? esc_html( $options['post_label'] ) : __( 'Post', 'tcd-w' );
     $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
     $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>
<div id="bread_crumb">
 <ul class="clearfix" itemscope itemtype="http://schema.org/BreadcrumbList"<?php if(is_page()){ echo ' style="width:' . esc_attr($page_content_width). 'px;"'; }; ?>>
 <?php
      //  single -----------------------
     if(is_singular('post')) {

       $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
       $exist_child = '';
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

 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($post_label); ?></span></a><meta itemprop="position" content="2"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url($parent_cat_url); ?>"><span itemprop="name"><?php echo esc_html($parent_cat_name); ?></span></a><meta itemprop="position" content="3"></li>
 <?php if(!$exist_child){ ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
 <?php }else{ ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url($child_cat_url); ?>"><span itemprop="name"><?php echo esc_html($child_cat_name); ?></span></a><meta itemprop="position" content="4"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="5"></li>
 <?php } ?>

 <?php
     // news single -----------------------
     }elseif(is_singular('news')) {

 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($news_label); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
 <?php
     // blog single -----------------------
     } elseif(is_singular('blog')) {
       $category = wp_get_post_terms( $post->ID, 'blog_category' , array( 'orderby' => 'term_order' ));
       if ( $category && ! is_wp_error($category) ) {
         foreach ( $category as $cat ) :
           $cat_name = $cat->name;
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'blog_category');
           break;
         endforeach;
       };
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('blog')); ?>"><span itemprop="name"><?php echo esc_html($blog_label); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if ( $category && ! is_wp_error($category) ) { ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url($cat_url); ?>"><span itemprop="name"><?php echo esc_html($cat_name); ?></span></a><meta itemprop="position" content="3"></li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="<?php if ( $category && ! is_wp_error($category) ) { echo '4'; } else { echo '3';}; ?>"></li>
 <?php
      // Search -----------------------
      } elseif(is_search()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-w'); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // Home page -----------------------
      } elseif(is_home()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($post_label); ?></span><meta itemprop="position" content="2"></li>
 <?php

      } elseif(is_category()) {

        $query_obj = get_queried_object();
        $current_cat_id = $query_obj->term_id;
        $current_cat = get_category($current_cat_id);
        $current_cat_name = $current_cat->name;
        $parent_cat_id = $current_cat->parent;

 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($post_label); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if($parent_cat_id == 0){ ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($current_cat_name ); ?></span><meta itemprop="position" content="3"></li>
 <?php }else{
        $parent_cat = get_category($parent_cat_id);
        $parent_cat_name = $parent_cat->name;
        $parent_cat_url = get_category_link($parent_cat_id);
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url($parent_cat_url); ?>"><span itemprop="name"><?php echo esc_html($parent_cat_name); ?></span></a><meta itemprop="position" content="3"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($current_cat_name ); ?></span><meta itemprop="position" content="4"></li>
 <?php } // END parent_cat_id

      // Category, Tag , Archive page -----------------------
      } elseif(is_tag() || is_day() || is_month() || is_year() || is_author()) {
        if( is_tag() ) {
          $title = single_tag_title('', false);
        } elseif( is_author() ) {
          $author_info = $wp_query->get_queried_object();
          $author_id = $author_info->ID;
          $user_data = get_userdata($author_id);
          $title = $user_data->display_name;
        } elseif (is_day()) {
          $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w')) );
        } elseif (is_month()) {
          $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w')) );
        } elseif (is_year()) {
          $title = sprintf(__('Archive for %s', 'tcd-w'), get_the_time(__('Y', 'tcd-w')) );
        };
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($post_label); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
 <?php
      //  Page -----------------------
      } elseif(is_page()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
 <?php
      // Other page -----------------------
      } else {
      $category = get_the_category();
 ?>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-w'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($post_label); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if($category) { ?>
 <li class="category" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
  <?php
       $count=1;
       foreach ($category as $cat) {
  ?>
  <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php $count++; } ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="4"></li>
 <?php }; ?>
 </ul>
</div>
