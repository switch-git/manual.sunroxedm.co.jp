<?php

  $options = get_design_plus_option();

  $message = $options['header_message'];
  $url = $options['header_message_url'];
  $font_color = $options['header_message_font_color'];
  $bg_color = $options['header_message_bg_color'];
  $target = $options['header_message_target'];

?>
 <div id="header_message" class="<?php echo esc_attr($options['header_message_width']); ?> show_close_button" <?php if(isset($_COOKIE['close_header_message'])) { echo 'style="display:none;"'; }; ?>>
    <div class="post_content clearfix">
        <?php if($url){ ?>
            <a href="<?php echo esc_url($url); ?>"<?php if($target){ echo ' target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
        <?php }else{ ?>
            <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
        <?php } ?>
    <div id="close_header_message"></div>
  </div>
</div>