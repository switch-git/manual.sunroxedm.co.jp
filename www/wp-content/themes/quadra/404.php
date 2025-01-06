<?php

     get_header();
     $options = get_design_plus_option();

     $page_404_catch = $options['page_404_catch'];
	$page_404_desc = $options['page_404_desc'];
     
     $page_404_content_color_use_main =  $options['page_404_content_color_use_main'];
     $page_404_content_color = '';
     if(!$page_404_content_color_use_main){
       $page_404_content_color = 'style="color:'.esc_attr($options['page_404_content_color']).';"';
     }

     $page_404_bg_color = $options['page_404_bg_color'];

?>
<div id="page_404_header" style="background:<?php echo esc_attr($page_404_bg_color); ?>;">
  <div class="content" <?php echo $page_404_content_color; ?>>
    <h1 class="catch common_headline rich_font">
    <?php if($page_404_catch){ echo nl2br(esc_html($page_404_catch)); } else { echo '404 NOT FOUND'; }; ?>
    </h1>
    <?php if ($page_404_desc) { ?>
    <p class="desc"><?php echo nl2br(esc_html($page_404_desc)); ?></p>
    <?php } ?>
  </div>
</div>
<?php get_footer(); ?>