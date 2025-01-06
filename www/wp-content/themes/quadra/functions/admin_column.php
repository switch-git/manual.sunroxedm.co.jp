<?php
/**
 * Add custom columns (ID, thumbnails)
 */
function manage_columns( $columns ) {
  // Make new column array with ID column and featured image column
  $new_columns = array();

  foreach ( $columns as $column_name => $column_display_name ) {
    // Add post_id column before title column
    if ( isset( $columns['title'] ) && $column_name == 'title' ) {
      $new_columns['post_id'] = 'ID';
    }
    $new_columns[$column_name] = $column_display_name;
  }

  // Add memo column
  $new_columns['new_post_memo'] = __( 'Notes', 'tcd-w' );

  // Add featured image column
  $new_columns['new_post_thumb'] = __( 'Featured Image', 'tcd-w' );

  return $new_columns;
}
add_filter( 'manage_posts_columns', 'manage_columns', 5 ); // For post, news, event and special


/**
 * おすすめ記事を追加
 */
// function manage_post_posts_columns( $columns ) {

//   $new_columns = array();
//   foreach ( $columns as $column_name => $column_display_name ) {
//     if ( isset( $columns['new_post_thumb'] ) && $column_name == 'new_post_thumb' ) {
//       $new_columns['recommend_post'] = __( 'Post type', 'tcd-w' );
//     }
//     $new_columns[$column_name] = $column_display_name;
//   }
//   return $new_columns;

// }
// add_filter( 'manage_post_posts_columns', 'manage_post_posts_columns' ); // Only for post


/**
 * ブログにカテゴリーを追加
 */
function manage_blog_posts_columns( $columns ) {

  $options = get_design_plus_option();
  $blog_category_label = $options['blog_category_label'] ? esc_html( $options['blog_category_label'] ) : __( 'Blog category', 'tcd-w' );

  $new_columns = array();
  foreach ( $columns as $column_name => $column_display_name ) {
    if ( isset( $columns['new_post_thumb'] ) && $column_name == 'new_post_thumb' ) {
      $new_columns['blog_category'] = $blog_category_label;
      $new_columns['recommend_post'] = __( 'Post type', 'tcd-w' );
    }
    $new_columns[$column_name] = $column_display_name;
  }
  return $new_columns;
}
add_filter( 'manage_blog_posts_columns', 'manage_blog_posts_columns' );


/**
 * Output the content of custom columns (ID, featured image, recommend post and event date)
 */
function add_column( $column_name, $post_id ) {

  $options = get_design_plus_option();

  switch ( $column_name ) {

    case 'blog_category' : // ブログカテゴリー
      if ( $blog_category = get_the_terms( $post_id, 'blog_category' ) ) {
        foreach ( $blog_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'blog_category' ) ), $cats->name );
        }
      }
      break;

    case 'new_post_thumb' : // アイキャッチ画像
      $post_thumbnail_id = get_post_thumbnail_id( $post_id );
      if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
        echo '<img width="70" src="' . esc_attr( $post_thumbnail_img[0] ) . '">';
      }
      break;

    case 'recommend_post' : // おすすめ記事
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post1', 'tcd-w' ) . '</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post2', 'tcd-w' ) . '</p>'; }
      break;

    case 'new_post_memo' : // memo
      if ( $memo = get_post_meta( $post_id, 'memo', true ) ) {
        $memo = strip_tags($memo);
        echo '<p>' . esc_html($memo) . '</p>';
      }
      break;

  }

}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 ); // For post
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 ); // For page


/**
 * Enable sorting of the ID column
 */
function custom_quick_edit_sortable_columns( $sortable_columns ) {
  $sortable_columns['post_id'] = 'ID';
  return $sortable_columns;
}
//add_filter( 'manage_edit-post_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For post
//add_filter( 'manage_edit-news_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For news
add_filter( 'manage_edit-page_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For page





?>