<?php

function custom_searchform($options, $color = '', $opacity = '') {
  
  // $options = get_design_plus_option();

  $placeholder = $options['search_form_placeholder'];
  $search_form_label = $options['search_form_label'];
  if(!$search_form_label){ $search_form_label = esc_attr_x( 'Search', 'submit button' ); }
  $search_form_label_color = '';
  if(!$options['search_form_label_color_use_main']){
    $search_form_label_color = 'style="background-color:'.esc_attr($options['search_form_label_color']).';"';
  }

  ob_start();

  if(!is_front_page()){
    echo '<div class="post_archive_form_area">';
  }else{
    echo '<div class="search_form" style="background:rgba('.$color.','.$opacity.');">';
  }

?>
<div class="main_search_area">
  <form role="search" method="get" id="searchform" class="searchform main_searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div>
      <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
      <input type="text" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s" id="s" />
      <div class="submit_button2"<?php echo $search_form_label_color; ?>>
        <input type="submit" id="searchsubmit" value="<?php echo esc_attr($search_form_label); ?>" />
      </div>
    </div>
  </form>
</div>
<?php 
    
  echo '</div>';
  return ob_get_clean();

}

?>