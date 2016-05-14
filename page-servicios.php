<?php get_header(); ?>

    <div class="slider-wrapper theme-light">
        <div class="ribbon"></div>
      <div id="slider" class="nivoSlider">
          <?php $args=array( 'post_type'=> 'servicios', 'post_status' => 'publish', 'posts_per_page' => 1000, 'order' => 'ASC', 'tax_query' => array( array(  'taxonomy' => 'ubicacion', 'field' => 'slug', 'terms' => 'bannerlg' ) ) ); $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                  while ($my_query->have_posts()) : $my_query->the_post();
                    $categories = get_the_category(); $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                           <img src="<?php echo $url; ?>" alt="">
                <?php endwhile; }  wp_reset_query(); ?>
      </div>
      <div id="sliderxs" class="nivoSlider">
          <?php $args=array( 'post_type'=> 'servicios', 'post_status' => 'publish', 'posts_per_page' => 1000, 'order' => 'ASC', 'tax_query' => array( array(  'taxonomy' => 'ubicacion', 'field' => 'slug', 'terms' => 'bannerxs' ) ) ); $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                  while ($my_query->have_posts()) : $my_query->the_post();
                    $categories = get_the_category(); $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                           <img src="<?php echo $url; ?>" alt="">
                <?php endwhile; }  wp_reset_query(); ?>
      </div>
    </div>
    <div class="cuerpo">
      <div class="container">
        <div class="col-md-12">
          <h1 class="text-center"><img src="<?php echo get_bloginfo('template_directory');?>/img/dress.png" width="35" height="35" class="instagramsize"> Servicios</h1>
          <hr class="hr hrcentro">

        </div>
        <div class="col-md-12">
          <div class="grid">
              <div class="grid-sizer"></div>
                <?php $args=array( 'post_type'=> 'servicios', 'post_status' => 'publish', 'posts_per_page' => 1000, 'order' => 'ASC', 'tax_query' => array( array(  'taxonomy' => 'ubicacion', 'field' => 'slug', 'terms' => 'servicios' ) ) ); $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                  while ($my_query->have_posts()) : $my_query->the_post();
                    $categories = get_the_category(); $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                      <div class="grid-item">
                           <img src="<?php echo $url; ?>" alt="">
                      </div>
                  <?php endwhile; }  wp_reset_query(); ?>
          </div>
        </div>
      </div>
    </div>
        <script>
            jQuery(document).ready(function() {
                function checkWidth() {
                    var w = jQuery(window).width();
                    if (w>768){
                      jQuery('#slider').nivoSlider({
                        effect: 'fade',
                        prevText: '',
                        nextText: '',
                        controlNav: false,
                        pauseTime: 4000, 
                        animSpeed: 500,
                      });
                    } else {
                      jQuery('#sliderxs').nivoSlider({
                        effect: 'fade',
                        prevText: '',
                        nextText: '',
                        controlNav: false,
                        pauseTime: 4000, 
                        animSpeed: 500,
                      });
                    }
                }
                checkWidth();
                jQuery(window).resize(checkWidth);
            });
        </script>
    <script>
      jQuery(document).ready( function() {
        // init Masonry
        var $grid = jQuery('.grid').masonry({
          itemSelector: '.grid-item',
          percentPosition: true,
          columnWidth: '.grid-sizer'
        });
        // layout Isotope after each image loads
        $grid.imagesLoaded().progress( function() {
          $grid.masonry();
        });  

      });
    </script>
<?php get_footer(); ?>