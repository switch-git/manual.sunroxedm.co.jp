<?php
function memo_meta_box() {
  $post_types = array ( 'post', 'page', 'news', 'blog');
  add_meta_box(
    'memo',//ID of meta box
    __('Notes', 'tcd-w'),//label
    'show_memo_meta_box',//callback function
    $post_types,// post type
    'side',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'memo_meta_box', 998);


function show_memo_meta_box() {
  global $post;
  $options =  get_design_plus_option();

  $memo = get_post_meta($post->ID, 'memo', true);

  echo '<input type="hidden" name="memo_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">
 <div class="tcd_cf_content">
  <textarea id="memo" class="large-text" cols="50" rows="5" name="memo"><?php if(!empty($memo)){ echo esc_textarea($memo); }; ?></textarea>
 </div><!-- END .content -->
</div><!-- END #tcd_custom_fields -->

<?php
}

function save_memo_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['memo_meta_box_nonce']) || !wp_verify_nonce($_POST['memo_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array('memo');
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_memo_meta_box');

