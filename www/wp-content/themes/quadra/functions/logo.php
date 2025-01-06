<?php

//ヘッダーロゴ　---------------------------------------------------------------------------------------------
function header_logo(){

  $options = get_design_plus_option();

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['header_logo_image'], 'full' );
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['header_logo_retina'] == 1) {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['header_logo_image_mobile'], 'full' );
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['header_logo_retina_mobile'] == 1) {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  $font_color = $options['header_logo_font_color'];
  $title = get_bloginfo('name');
  $url = home_url();

?>
<?php if( !is_front_page() ) { ?>
<p class="logo">
<?php } else { ?>
<h1 class="logo">
<?php }; ?>
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php if( ($options['header_logo_type'] == 'type2') && $logo_image ){ ?>
  <img class="logo_image<?php if($logo_image_mobile){ echo ' pc'; }; ?>" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php if($logo_image_mobile){ ?><img class="logo_image mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" /><?php }; ?>
  <?php } else { ?>
  <span class="logo_text" style="color:<?php echo esc_attr($font_color); ?>;"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
<?php if( !is_front_page() ) { ?>
</p>
<?php } else { ?>
</h1>
<?php }; ?>

<?php
}


//フッターロゴ　---------------------------------------------------------------------------------------------
function footer_logo(){

  $options = get_design_plus_option();

  $pc_image_width = '';
  $pc_image_height = '';

  $logo_image = wp_get_attachment_image_src( $options['footer_logo_image'], 'full' );
  if($logo_image) {
    $pc_image_width = $logo_image[1];
    $pc_image_height = $logo_image[2];
    if($options['footer_logo_retina'] == 1) {
      $pc_image_width = round($pc_image_width / 2);
      $pc_image_height = round($pc_image_height / 2);
    };
  };

  $logo_image_mobile = wp_get_attachment_image_src( $options['footer_logo_image_mobile'], 'full' );
  if($logo_image_mobile) {
    $mobile_image_width = $logo_image_mobile[1];
    $mobile_image_height = $logo_image_mobile[2];
    if($options['footer_logo_retina_mobile'] == 1) {
      $mobile_image_width = round($mobile_image_width / 2);
      $mobile_image_height = round($mobile_image_height / 2);
    };
  };

  $title = get_bloginfo('name');
  $url = home_url();

?>

<div class="logo">
 <a href="<?php echo esc_url($url); ?>/" title="<?php echo esc_attr($title); ?>">
  <?php if( ($options['footer_logo_type'] == 'type2') && $logo_image ){ ?>
  <img class="logo_image<?php if($logo_image_mobile){ echo ' pc'; }; ?>" src="<?php echo esc_attr($logo_image[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
  <?php if($logo_image_mobile){ ?><img class="logo_image mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>?<?php echo esc_attr(time()); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" /><?php }; ?>
  <?php } else { ?>
  <span class="logo_text"><?php echo esc_html($title); ?></span>
  <?php }; ?>
 </a>
</div>

<?php
}

// QUADRA専用アイコン
function get_taxonomy_metadata($term_meta,$title){

  $icon_html = '';
  $icon_wrap = '';
  $icon_type = (!empty($term_meta['icon_type'])) ? $term_meta['icon_type'] : '';
  $image = (!empty($term_meta['icon_image'])) ? wp_get_attachment_image_src( $term_meta['icon_image'], 'full' ) : '';
  if(isset($term_meta['color2_use_sub'] ) && isset($term_meta['color2'])){
  $style = (!$term_meta['color2_use_sub']) ? 'style="background:'.esc_attr($term_meta['color2']).';"' : '';
  }
  if($icon_type == 'type1' && $image){

    $icon = $image;
    $use_retina = isset($term_meta['icon_image_retina']);

    $image_url = $icon[0];
    $image_width = $icon[1];
    $image_height = $icon[2];

    if($use_retina){
      $image_width = round($image_width / 2);
      $image_height = round($image_height / 2);
    }

    $icon_html = '<img class="image icon" src="'.esc_attr($image_url).'" alt="'.esc_html($title).'" width="'.esc_attr($image_width).'" hright="'.esc_attr($image_height).'">';

  }elseif($icon_type == 'type2'){

    $icon = $term_meta['icon_font'];
    $color = 'color:'.esc_attr($term_meta['icon_font_color']).';';
    $size = 'font-size:'.esc_attr($term_meta['icon_font_size']).'px;';

    $icon_html = '<div class="image icon box_icon '.esc_attr($icon).'" style="'.$color.$size.'"></div>';

  }

  if($icon_html){
    $icon_wrap = '<div class="image_wrap"'.$style.'>'.$icon_html.'</div>';
  }

  return $icon_wrap;

}