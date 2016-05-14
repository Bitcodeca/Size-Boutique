<?php get_header(); ?>
		<div class='embed-container'>
			<iframe src="https://player.vimeo.com/video/143088178?autoplay=1&color=ff0179&title=0&byline=0&portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
		<div class="cuerpo">
				<?php $args=array( 'post_type'=> 'home', 'post_status' => 'publish', 'posts_per_page' => 1000, 'order' => 'ASC' ); $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
                  while ($my_query->have_posts()) : $my_query->the_post();
                    $categories = get_the_category(); $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                    <div class="col-md-12 fondohome margintop25">
	                    <div class="container">
							<div class="col-md-6 margintophome">
								<h1><?php the_title(); ?></h1>
								<hr class="hr hrtitulo">
								<p style="text-align: justify;"><?php echo get_the_content(); ?></p>
							</div>
							<div class="col-md-6 fotohome">
		                        <img src="<?php echo $url; ?>" class="img-responsive" alt="">
							</div>
						</div>
					</div>
                  <?php endwhile; }  wp_reset_query(); ?>
			<div class="container">
				<div class="col-md-12 margintop25">
					<a href="#"><h1><img src="<?php echo get_bloginfo('template_directory');?>/img/instagram.png" width="40" height="40" class="instagramsize"> @SizeBoutiqueCa</h1></a>
					<hr class="hr hrtitulo">
				</div>
				<div class="hidden-xs">
					<div class="col-md-12">
						<?php echo do_shortcode( '[si_feed limit="12"]' ); ?>
					</div>
				</div>
				<div class="visible-xs">
					<?php echo do_shortcode( '[si_feed]' ); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>