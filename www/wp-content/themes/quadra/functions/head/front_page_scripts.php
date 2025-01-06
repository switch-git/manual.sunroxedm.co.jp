<?php

  function front_page_scripts($options, $show, $type){

    // PC/SP設定
    $device = '';
    if(is_mobile()){ $device = 'mobile_'; }

?>
<script>
document.addEventListener("DOMContentLoaded", function(){
<?php

  if($show == 'show'):

    $index_slider_time = $options['index_slider_time'];
    if(is_mobile() && $options['mobile_show_index_slider'] == 'type2'){
      $index_slider_time = $options['mobile_index_slider_time'];
    }

    // フロントカバー
    if($type == 'type1'){
    
?>
(function(){

  // ロード画面用
  var header_wrap = document.getElementById('index_header_type1');
  if(header_wrap != null){

    var screenWidth = window.innerWidth;

    function headerContentResize() { 
      var screenHeight = window.innerHeight;
      var headerHeight = screenHeight - 60;
      if(screenWidth < 751 ){
        header_wrap.style.height = headerHeight + 'px';
      }
    }

    headerContentResize();

    window.addEventListener("resize", function(event) {
          // 横幅が変わった時のみ実行
      if (screenWidth == window.innerWidth) {
        return false;
      }else{
        headerContentResize();
      }
    });

    var target = document.getElementById('body');
    if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

    // 一度クラス削除
      header_wrap.classList.remove('is-animate');

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if(target.classList.contains('end_loading') == true){ // ロード画面終了後にswiper初期化
            header_wrap.classList.add('is-animate');
            observer.disconnect();
          }
        });
      });

      const config = { attributes: true }; // 属性のみ監視
      observer.observe(target, config); // 監視開始

    }

  } // header_wrap

}());
<?php

    // 記事スライダー
    }elseif($type == 'type2'){
      wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '6.8.1', true );
      wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.css', array(), '6.8.1' );

?>
(function(){

  // spanにdata-href追加
  let categories = document.querySelectorAll('#index_blog_slider .category_link');
  if(categories.length > 0){
    categories.forEach(cat => {
      cat.addEventListener('click', function(event){
        event.stopPropagation();
        event.preventDefault();
        window.location.href = this.dataset.href;
      });
    });
  } // END data-href

  // swiper
  let selector = document.getElementById('index_blog_slider');
  if(selector != null){

    const index_blog_slider = new Swiper(selector, {
        
      init:false,
      loop: false,
      effect: 'fade', // オプションが正常に動作するためのエフェクト指定
      speed: 700,
      autoplay: {
        delay: <?php echo esc_html($index_slider_time); ?>,
      },
      pagination: { // ページネーション
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
      },
      on: {

        // スライド切り替え時のアニメーション
        slideChange: function(){

          let slides         = this.slides,
              active_index   = this.activeIndex,
              previous_index = this.previousIndex,
              last_index     = slides.length - 1,
              active_slide   = slides[active_index],
              prev_slide     = slides[previous_index];

          // 全てのスライドからクラスを削除
          for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove('previous_slide','next_animating','prev_animating');
          }

          // スライド番号でアニメーションを分ける
          if(active_index > previous_index){ // next
            active_slide.classList.add('next_animating');
          }else if(active_index == 0 && previous_index == last_index){ // last >> first
            active_slide.classList.add('next_animating');
          }else{ // prev
            active_slide.classList.add('prev_animating');
          }

          // 前回のスライドにクラス追加
          prev_slide.classList.add('previous_slide');
              
        }, 

      } // slideChange

    }); // new Swiper

    // ロード画面用
    var target = document.getElementById('body');
    if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if(target.classList.contains('end_loading') == true){ // ロード画面終了後にswiper初期化
            index_blog_slider.init();
            observer.disconnect();
          }
        });
      });

      const config = { attributes: true }; // 属性のみ監視
      observer.observe(target, config); // 監視開始

    }else{ // ロード画面を使用しない（DOMツリー構築後に初期化）
      index_blog_slider.init();
    }

  } // if selector

}());
<?php

    }elseif($type == 'type3'){
      wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '6.8.1', true );
      wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.css', array(), '6.8.1' );

?>
(function(){

  var header_slider = document.getElementById('header_slider');
  var ytSlides = header_slider.querySelectorAll('.youtube-player');
  for(var ytSlide of ytSlides) { ytSlide.style.opacity = '0'; }

  // YouTube API 読み込み
  let scripts = document.querySelectorAll('script[src="//www.youtube.com/iframe_api"]');
  if(ytSlides.length > 0 && scripts.length == 0){
    var tag = document.createElement('script');
    tag.src = 'https://www.youtube.com/iframe_api';
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  }

  if(header_slider != null){

    var indexSwiper = new Swiper(header_slider, {
      init: false,
      effect: 'cube', // エフェクトを指定しているだけ
      cubeEffect: {
        shadow: false,
      },
      speed: 1200, // スライドが切り替わるスピー
      slidesPerView: 'auto',
      autoplay: { // 自動再生
        delay: <?php echo esc_html($index_slider_time); ?>,
      },
      loop:false,
      pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true,
      }
    }); // new Swiper

    // init
    indexSwiper.on('init', function() {

      let currentSlide = this.slides[this.activeIndex];
      if(currentSlide.classList.contains('video') == true){

        let video = currentSlide.querySelector('video');
        video.currentTime = 0;
        video.play();
        indexSwiper.autoplay.stop();
        indexSwiper.params.autoplay.delay=0;

        video.addEventListener('ended', function() {
          indexSwiper.autoplay.start();
        }, false);

      }else if(currentSlide.classList.contains('youtube') == true){
        indexSwiper.autoplay.stop();
        indexSwiper.params.autoplay.delay=0;
      }
    
    });

    // YouTubeプレイヤー
    var ytPlayers = {};

    // swiper初期化（ロード画面）
    var target = document.getElementById('body');
    if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if(target.classList.contains('end_loading') == true){ // ロード画面終了後にswiper初期化
            indexSwiper.init();
            youtubeControl();
            observer.disconnect();
          }
        });
      });

      const config = { attributes: true }; // 属性のみ監視
      observer.observe(target, config); // 監視開始

    }else{ // ロード画面を使用しない（DOMツリー構築後に初期化）  
      indexSwiper.init();
      window.onYouTubeIframeAPIReady = function(){
        youtubeControl();
      };

    }

    // YouTubeプレイヤー制御
    function youtubeControl() {

      var slides = indexSwiper.slides;
      ytSlides.forEach(slide => {

        var ytPlayerId = slide.id;
        if (!slide) return;

        var player = new YT.Player(ytPlayerId, {

          events: {

            onReady: function(e) {

              ytPlayers[ytPlayerId] = player;
              ytPlayers[ytPlayerId].mute();
              ytPlayers[ytPlayerId].lastStatus = -1;

              let active_slide = slides[indexSwiper.activeIndex];

              if(active_slide.classList.contains('youtube') == true){
                    
                let active_ytPlayerId = active_slide.querySelector('.youtube-player').id;
                if(active_ytPlayerId == ytPlayerId){
                  ytPlayers[ytPlayerId].seekTo(0, true);
                  ytPlayers[ytPlayerId].playVideo();
                }

              }

            }, // onReady

            onStateChange: function(e) {

              if (e.data === 0) { // 再生終了
                indexSwiper.autoplay.start();
              }else if(e.data === 1){
                slide.style.opacity = '1';
              }

            }

          } // events

        });

      }); // for

    }


    // slide change
    indexSwiper.on('slideChange', function() {

      let currentSlide = this.slides[this.activeIndex];
      let prev_slide = this.slides[this.previousIndex];

      if(currentSlide.classList.contains('video') == true){

        let video = currentSlide.querySelector('video');
        video.currentTime = 0;
        setTimeout(function(){ video.play(); }, 100);
        this.autoplay.stop();
        this.params.autoplay.delay=0;
        video.addEventListener('ended', function() {
          indexSwiper.autoplay.start();
        }, false);

      }else if(currentSlide.classList.contains('youtube') == true){

        this.autoplay.stop();
        let iframe = currentSlide.querySelector('.youtube-player');
        let ytPlayerId = iframe.id;
        ytPlayers[ytPlayerId].seekTo(0, true);
        ytPlayers[ytPlayerId].playVideo();

      }else{ // image

        this.params.autoplay.delay=<?php echo esc_html($index_slider_time); ?>;
        this.autoplay.start();

      }

      if(prev_slide.classList.contains('video') == true){
      
        prev_slide.querySelector('video').pause();

      }else if(prev_slide.classList.contains('youtube') == true){

        let ytPlayerPrevId = prev_slide.querySelector('.youtube-player').id;
        if(ytPlayerPrevId){
          ytPlayers[ytPlayerPrevId].pauseVideo();
        }

      }

    });

  } // if selector

}());
<?php

    } // END slider type
      
  endif; // display_header_content

  // ニュースティッカー
  $show_news_ticker = $options[$device.'show_index_news'];
  if($show_news_ticker):

    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '6.8.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.css', array(), '6.8.1' );
      
?>
(function(){

  let news_ticker = document.getElementById('news_ticker_slider');
  if(news_ticker != null){

    const news_ticker_slider = new Swiper(news_ticker, {
      allowTouchMove: false,
      direction: 'vertical',
      effect: 'slide',
      loop: true,
      speed: 700,
      autoplay: {
        delay: 5000,
      }
    });

    news_ticker_slider.autoplay.stop();

    if(news_ticker_slider.slides.length > 3){
    
      // ロード画面使用可否による初期化
      var target = document.getElementById('body');
      if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

        const observer = new MutationObserver((mutations) => {
          mutations.forEach((mutation) => {
            if(target.classList.contains('end_loading') == true){ // ロード画面終了後にswiper初期化
              news_ticker_slider.autoplay.start();
              observer.disconnect();
            }
          });
        });

        const config = { attributes: true }; // 属性のみ監視
        observer.observe(target, config); // 監視開始

      }else{ // ロード画面を使用しない（DOMツリー構築後に初期化）
        news_ticker_slider.autoplay.start();
      }

    }

  } // news_ticker

}());
<?php

  endif;

  // CBブログカルーセル
  if ($options['contents_builder'] || $options['mobile_contents_builder']) :
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.js', array( 'jquery' ), '6.8.1', true );
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/js/swiper-bundle.min.css', array(), '6.8.1' );

?>
(function(){
var cb_silders = document.querySelectorAll('.blog_carousel_slider');

  if(cb_silders.length > 0){

    // カテゴリーにdata-href追加
    for(let cb_slider of cb_silders) {
      let categories = cb_slider.querySelectorAll('.category');
      if(categories.length > 0){
        categories.forEach(cat => {
          cat.addEventListener('click', function(event){
            event.stopPropagation();
            event.preventDefault();
            window.location.href = this.dataset.href;
          });
        });
      }
    } // END data-href

    var swiperBool;
    var breakPoint = 750;
    var swipers = [];

    // swiper初期化
    const initSlider = ( cb_silders, swipers ) => {
      let index = 0;
      for(let slider of cb_silders) { index++;

        let sliderId = '#cb_blog_slider' + index;
        let sliderWrapId = '#cb_blog_slider_wrap' + index;

        let options = {
          loop: true,
          speed: 700,
          navigation: {
            nextEl: sliderWrapId + ' .swiper-button-next',
            prevEl: sliderWrapId + ' .swiper-button-prev',
          },
          autoplay: {
            delay: 500,
          },
          breakpoints: {
            1000: { slidesPerView: 3, spaceBetween: 28 },
            750: { slidesPerView: 2, spaceBetween: 28 },
            350: { slidesPerView: 1, spaceBetween: 28 }
          },
          on: {
            init: function () {

              // カルーセルが画面内に表示されたらautoplay開始
              let options = {
                root: null,
                rootMargin: "0px",
                threshold: 0,
              };
              let observer = new IntersectionObserver(callback, options);
              observer.observe(slider);

              function callback(entries) {
                entries.forEach(function (entry) {
                  if (entry.isIntersecting) {
                    swipers[sliderId].autoplay.start();
                    swipers[sliderId].params.autoplay.delay=5000;
                    observer.unobserve(entry.target);
                  }
                });
              }
            }, // END init function
          },
        } // END options

        swipers[sliderId] = new Swiper( sliderId, options );
        swipers[sliderId].autoplay.stop();

      }
    };

    // swiper解除
    const destroySlider = ( cb_silders, swipers ) => {
      let index = 0;
      for(let slider of cb_silders) { index++;
        let sliderId = '#cb_blog_slider' + index;
        swipers[sliderId].destroy(true,true);
      }
    };

    // 読み込み時にウィンドウ幅に応じて初期化
    const loadSliderAction = () => {
      if(window.innerWidth > breakPoint ) { // 750より大きい
        initSlider(cb_silders, swipers);
        swiperBool = true;
      }else{ // 750以下
        swiperBool = false;
      }
    }

    // ロード画面使用可否による初期化
    var target = document.getElementById('body');
    if(target.classList.contains('use_loading_screen') == true){ // ロード画面を使用する

      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if(target.classList.contains('end_loading') == true){ // ロード画面終了後にswiper初期化
            loadSliderAction();
            observer.disconnect();
          }
        });
      });

      const config = { attributes: true }; // 属性のみ監視
      observer.observe(target, config); // 監視開始

    }else{ // ロード画面を使用しない（DOMツリー構築後に初期化）
      loadSliderAction();
    }

    // リサイズ時にウィンドウ幅に応じて初期化・解除
    window.addEventListener('resize', function() {
      if( window.innerWidth <= breakPoint && swiperBool == true ){ // 750以下
        destroySlider(cb_silders, swipers);
        swiperBool = false;
      }else if( window.innerWidth > breakPoint && swiperBool == false){
        initSlider(cb_silders, swipers);
        swiperBool = true;
      }
    });

  }

}());
<?php

  endif;

?>
});
</script>
<?php

  }

?>