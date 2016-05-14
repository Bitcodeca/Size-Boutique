<?php get_header(); ?>
    <div class="cuerpo margintop25">
      <div class="container">
        <div class="col-md-12">
          <h1 class="text-center"><img src="<?php echo get_bloginfo('template_directory');?>/img/gallery.png" width="40" height="40" class="instagramsize"> Galeria</h1>
          <hr class="hr hrcentro">
        </div>
        <div class="col-md-12 margintop25">        
              <div class="col-md-12 text-right">
                  <a class="filter active" data-filter="*">Todas </a>
                  <?php $terms = get_terms('category');
                    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
                    foreach ( $terms as $term ) { if($term->name != '.'){echo '<a class="filter" data-filter=".'.$term->name.'">'.$term->name.' </a>'; }}
                  }?>
              </div>
              <section id="inner" class="margintop50">
                <div id="Container">
                  <div class="galleryWrap margintop25" id="resultado">
                      <center>
                        <?php $args=array( 'post_type'=> 'galeria', 'post_status' => 'publish', 'posts_per_page' => 1000, 'orderby' => 'rand' ); $my_query = new WP_Query($args); if( $my_query->have_posts() ) {
                        while ($my_query->have_posts()) : $my_query->the_post(); 
                          $category = get_the_category(); $categoria = $category[0]->cat_name;
                          $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                          <div class="mix <?php echo $categoria; ?>">
                              <a class="fancybox"  href="<?php echo $url; ?>" data-fancybox-group="<?php echo $categoria; ?>"> <?php echo the_post_thumbnail(); ?> </a>
                          </div>
                        <?php endwhile; }  wp_reset_query(); ?>
                      </center>
                  </div> 
                </div>
              </section>        
              <div class="pager-list"></div>
        </div>
      </div>
    </div>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
jQuery(document).ready(function ($) {
    jQuery('.fancybox').attr('rel', 'media-gallery').fancybox({
        prevEffect: 'none',
        nextEffect: 'none',
        closeBtn: true,
        arrows: true,
        nextClick: true,
        helpers: {
           title	: {
				type: 'float'
			},
			thumbs	: {
				width	: 100,
				height	: 100
			}
		}
    });
});
</script>
<script>
// To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "buttonFilter".
var buttonFilter = {
  
  // Declare any variables we will need as properties of the object
  
  $filters: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "buttonFilter" object so that we can share methods and properties between all parts of the object.
    
    self.$filters = $('#Filters');
    self.$reset = $('#Reset');
    self.$container2 = $('#Container');
    
    self.$filters.find('fieldset').each(function(){
      var $this = $(this);
      
      self.groups.push({
        $buttons: $this.find('.filter'),
        $dropdown: $this.find('select'),
        active: ''
      });
    });
    
    self.bindHandlers();
  },
  
  // The "bindHandlers" method will listen for whenever a button is clicked. 
  
  bindHandlers: function(){
    var self = this;
    
    // Handle filter clicks
    
    self.$filters.on('click', '.filter', function(e){
      e.preventDefault();
      
      var $button = $(this);
      
      // If the button is active, remove the active class, else make active and deactivate others.
      
      $button.hasClass('active') ?
        $button.removeClass('active') :
        $button.addClass('active').siblings('.filter').removeClass('active');
      
      self.parseFilters();
    });
    
    // Handle dropdown change
    
    self.$filters.on('change', function(){
      self.parseFilters();           
    });
    
    // Handle reset click
    
    self.$reset.on('click', function(e){
      e.preventDefault();
      
      self.$filters.find('.filter').removeClass('active');
      self.$filters.find('.show-all').addClass('active');
      self.$filters.find('select').val('');
      
      self.parseFilters();
    });
  },
  
  // The parseFilters method checks which filters are active in each group:
  
  parseFilters: function(){
    var self = this;
 
    // loop through each filter group and grap the active filter from each one.
    
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = group.$buttons.length ? 
        group.$buttons.filter('.active').attr('data-filter') || '' :
        group.$dropdown.val();
    }
    
    self.concatenate();
  },
  
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  
  concatenate: function(){
    var self = this;
    
    self.outputString = ''; // Reset output string
    
    for(var i = 0, group; group = self.groups[i]; i++){
      self.outputString += group.active;
    }
    
    // If the output string is empty, show all rather than none:
    
    !self.outputString.length && (self.outputString = 'all'); 
    
    console.log(self.outputString); 
    
    // ^ we can check the console here to take a look at the filter string that is produced
    
    // Send the output string to MixItUp via the 'filter' method:
    
	  if(self.$container2.mixItUp('isLoaded')){
    	self.$container2.mixItUp('filter', self.outputString);
	  }
  }
};
  
// On document ready, initialise our code.

jQuery(function(){

  // Initialize buttonFilter code
      
  buttonFilter.init();


jQuery('#Container').mixItUp({
	animation: {
		effects: 'fade translateZ(-10deg)',
		duration: 200
	},
	pagination: {
		limit: 10,
		loop: true,
		prevButtonHTML: '<a><img src="<?php echo get_bloginfo('template_directory');?>/img/back.png"></a>',
		nextButtonHTML: '<a><img src="<?php echo get_bloginfo('template_directory');?>/img/forward.png"></a>'
	}
});
});

</script>
<?php get_footer(); ?>