<?php

/**
 * 吹き出しクイックタグ用ショートコード
 */
function tcd_shortcode_speech_balloon( $atts, $content, $tag ) {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$atts = shortcode_atts( array(
		'user_image_url' => '',
		'user_name' => ''
	), $atts );

	// user_image_urlが指定されていればメディアID取得・差し替えを試みる
	$user_image_url = $atts['user_image_url'];
	if ( $atts['user_image_url'] ) {
		$attachment_id = attachment_url_to_postid( $atts['user_image_url'] );
		if ( $attachment_id ) {
			$user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
			if ( $user_image ) {
				$atts['user_image_url'] = $user_image[0];
			}
		}
	}

	$html = '<div class="speach_balloon ' . esc_attr( $tag ) . '">'
		  . '<div class="speach_balloon_user">';

	if ( $atts['user_image_url'] ) {
		$html .= '<img class="speach_balloon_user_image" src="' . esc_attr( $atts['user_image_url'] ) . '" alt="' . esc_attr( $atts['user_image_url'] ) . '">';
	}

	$html .= '<div class="speach_balloon_user_name">' . esc_html( $atts['user_name'] ) . '</div>'
		  . '</div>'
		  . '<div class="speach_balloon_text">' .  wpautop( $content )   . '</div>'
		  .  '</div>';

	return $html;
}
add_shortcode( 'speech_balloon_left1', 'tcd_shortcode_speech_balloon' );
add_shortcode( 'speech_balloon_left2', 'tcd_shortcode_speech_balloon' );
add_shortcode( 'speech_balloon_right1', 'tcd_shortcode_speech_balloon' );
add_shortcode( 'speech_balloon_right2', 'tcd_shortcode_speech_balloon' );


/**
 * Google Map用ショートコード
 */
function tcd_google_map( $atts) {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'address' => '',
  ), $atts );

  $html = '';

  if ( $atts['address'] ) {

    $use_custom_overlay = 'type2' === $options['qt_gmap_marker_type'] ? 1 : 0;
    $marker_img = $options['qt_gmap_marker_img'] ? wp_get_attachment_url( $options['qt_gmap_marker_img'] ) : '';
    if(!empty($marker_img)) {
      $marker_text = '';
    } else {
      $marker_text = $options['qt_gmap_marker_text'];
    }
    $access_saturation = isset( $options['qt_access_saturation'] ) ? intval( $options['qt_access_saturation'] ) : -100;
    $rand = rand();

    $html .= "<div class='qt_google_map'>\n";
    $html .= " <div class='qt_googlemap clearfix'>\n";
    $html .= "  <div id='qt_google_map" . $rand . "' class='qt_googlemap_embed'></div>\n";
    $html .= " </div>\n";
    $html .= " <script>\n";
    $html .= " jQuery(window).on('load', function() {\n";
    $html .= "  initMap('qt_google_map" . $rand . "', '" . esc_js( $atts['address'] ) . "', " . esc_js( $access_saturation ) . ", " . esc_js( $use_custom_overlay ) . ", '" . esc_js( $marker_img ) . "', '" . esc_js( $marker_text ) . "');\n";
    $html .= " });\n";
    $html .= " </script>\n";
    $html .= "</div>\n";

    if ( ! wp_script_is( 'qt_google_map_api', 'enqueued' ) ) {
      wp_enqueue_script( 'qt_google_map_api', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $options['qt_gmap_api_key'] ), array(), version_num(), true );
      wp_enqueue_script( 'qt_google_map', get_template_directory_uri() . '/js/googlemap.js', array(), version_num(), true );
    }
  }

	return $html;
}
add_shortcode( 'qt_google_map', 'tcd_google_map' );




function accordion_type1($atts) {

	$title = $atts['q'];
	$desc = $atts['a'];

	$html = '<div class="accordion_type1">';
  $html .= '<div class="title"><span>'.esc_html($title).'</span></div>';
  $html .= '<div class="content">';
  $html .= '<p class="desc"><span>'.esc_html($desc).'</span></p>';
  $html .= '</div></div>';

	return $html;

}
add_shortcode('faq1', 'accordion_type1');

function accordion_type2($atts) {

	$title = $atts['q'];
	$desc = $atts['a'];

	$html = '<div class="accordion_type2">';
  $html .= '<div class="title">'.esc_html($title).'</div>';
  $html .= '<div class="content">';
  $html .= '<p class="desc"><span>'.esc_html($desc).'</span></p>';
  $html .= '</div></div>';

	return $html;

}
add_shortcode('faq2', 'accordion_type2');


function tcd_tab_get_image($img_url, $href) {

	// 画像ファイル名からURL取得
	if($img_url) {

		$img_id = attachment_url_to_postid( $img_url ); // 画像id取得
		$img_obj = wp_get_attachment_image_src( $img_id, 'full' ); // 画像データ取得
		$img_w = isset($img_obj[1]) ? $img_obj[1] : '';// 画像の横幅取得
		$img_h = isset($img_obj[2]) ? $img_obj[2] : ''; // 画像の高さ取得
		$img_alt = get_post_meta( $img_id , '_wp_attachment_image_alt', true ); // 画像のalt取得
		$img_caption = get_post($img_id)->post_excerpt; // キャプション取得
		//$img_desc = get_post($img_id)->post_content; // 説明文取得
		$caption= '';
		if($img_caption) {  $caption= '<p class="caption"><span>'.$img_caption.'</span></p>'; };
		//if($img_desc) { $desc = '<p class="desc"><span>'.$img_desc.'</span></p>'; };

		if($href) {
			$image = $desc.'<a class="tab_link" href="'.$href.'"><img class="compact_image" src="'.$img_url.'" alt="'.$img_alt.'" width="'.$img_w.'" height ="'.$img_h.'" /></a>'.$caption;
		} else {
			$image = '<img class="compact_image" src="'.$img_url.'" alt="'.$img_alt.'" width="'.$img_w.'" height ="'.$img_h.'" />'.$caption;
		}

		return $image;

	};

};

// ショートコードの登録
function tcd_image_tab_function($atts) {

	$tab1 = isset($atts['tab1']) ? $atts['tab1'] : '';
	$tab2 = isset($atts['tab2']) ? $atts['tab2'] : '';
	$tab3 = isset($atts['tab3']) ? $atts['tab3'] : '';

	$img1 = isset($atts['img1']) ? $atts['img1'] : '';
	$img2 = isset($atts['img2']) ? $atts['img2'] : '';
	$img3 = isset($atts['img3']) ? $atts['img3'] : '';

	$url1 = isset($atts['url1']) ? $atts['url1'] : '';
	$url2 = isset($atts['url2']) ? $atts['url2'] : '';
	$url3 = isset($atts['url3']) ? $atts['url3'] : '';

	$desc1 = isset($atts['desc1']) ? $atts['desc1'] : '';
	$desc2 = isset($atts['desc2']) ? $atts['desc2'] : '';
	$desc3 = isset($atts['desc3']) ? $atts['desc3'] : '';

	ob_start();

?>
<div class="tcd_tab">

  <ul class="tab_labels">
    <li class="tab_label is-active"><?php echo esc_html($tab1); ?></li>
    <li class="tab_label"><?php echo esc_html($tab2); ?></li>
    <?php if($tab3) { ?>
      <li class="tab_label"><?php echo esc_html($tab3); ?></li>
		<?php } ?>
  </ul>

  <div class="tab_contents">

    <div class="tab_content is-show">
      <div class="inner">
        <?php if($desc1){ ?><p class="desc"><span><?php echo esc_html($desc1); ?></p></span><?php } ?>
        <?php echo tcd_tab_get_image($img1, $url1); ?>
      </div>
    </div>

    <div class="tab_content">
      <div class="inner">
        <?php if($desc2){ ?><p class="desc"><span><?php echo esc_html($desc2); ?></p></span><?php } ?>
        <?php echo tcd_tab_get_image($img2, $url2); ?>
      </div>
    </div>

    <?php if($img3) { ?>
    <div class="tab_content">
      <div class="inner">
        <?php if($desc3){ ?><p class="desc"><span><?php echo esc_html($desc3); ?></p></span><?php } ?>
        <?php echo tcd_tab_get_image($img3, $url3); ?>
      </div>
    </div>
    <?php } ?>

  </div>

</div>
<?php

	return ob_get_clean();

}
add_shortcode('tcd_tab', 'tcd_image_tab_function');


?>