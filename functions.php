<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function awesome_script_enqueue() {
	//css
	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', array(), '3.3.4', 'all');
	wp_enqueue_style('nivo-slider', get_template_directory_uri() . '/css/nivo-slider.css', array(), '3.3.4', 'all');
	wp_enqueue_style('animate', get_template_directory_uri() . '/css/light/light.css', array(), '1.0.0', 'all');
	wp_enqueue_style('fancyboxcss', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), '1.0.0', 'all');
	wp_enqueue_style('fancyboxthumbnailcss', get_template_directory_uri() . '/css/jquery.fancybox-thumbs.css', array(), '1.0.0', 'all');
	wp_enqueue_style('fancyboxbuttonscss', get_template_directory_uri() . '/css/jquery.fancybox-buttons.css', array(), '1.0.0', 'all');
	wp_enqueue_style('responsive', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('jquery', 'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1.0.0', true);
	wp_enqueue_script('bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array(), '3.3.4', true);
  wp_enqueue_script('masonry', 'http://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js', array(), '3.3.4', true);
  wp_enqueue_script('mixitupjs', get_template_directory_uri() . '/js/jquery.mixitup.js', array(), '1.0.0', true);
	wp_enqueue_script('mixituppaginationjs', 'http://tseoc.co.uk/chris/jquery.mixitup-pagination.min.js', array(), '1.0.0', true);
	wp_enqueue_script('nivosliderjs', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array(), '1.0.0', true);
	wp_enqueue_script('fancyboxjs', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array(), '1.0.0', true);
	wp_enqueue_script('fancybox1js', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), '1.0.0', true);
	wp_enqueue_script('fancybox2js', get_template_directory_uri() . '/js/jquery.fancybox-thumbs.js', array(), '1.0.0', true);
	wp_enqueue_script('fancybox3js', get_template_directory_uri() . '/js/jquery.fancybox-media.js', array(), '1.0.0', true);
	wp_enqueue_script('fancybox4js', get_template_directory_uri() . '/js/jquery.fancybox-buttons.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/
function awesome_theme_setup() {
	
	add_theme_support('menus');
	
  register_nav_menu('primary', 'navbar');
  register_nav_menu('secondary', 'footer');
}

add_action('init', 'awesome_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
    }

    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        if($item->current || $item->current_item_ancestor || $item->current_item_parent){
            $class_names .= ' active';
        }
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .'>';
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        $atts['class']  = ($item->hasChildren)         ? 'dropdown-toggle' : '';
        $atts['data-toggle']  = ($item->hasChildren)   ? 'dropdown'        : '';
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if( $item->hasChildren) {
            $item_output .= ' <b class="caret"></b>';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
update_option('image_default_link_type','none');

add_action( 'init', 'ubicacion_taxonomy', 0 );

function ubicacion_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Ubicacions', 'taxonomy general name' ),
    'singular_name' => _x( 'Ubicacion', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Ubicacion' ),
    'popular_items' => __( 'Ubicacions populares' ),
    'all_items' => __( 'Todas las Ubicaciones' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Ubicacion' ), 
    'update_item' => __( 'Actualizar Ubicacion' ),
    'add_new_item' => __( 'Agregar nueva Ubicacion' ),
    'new_item_name' => __( 'Nombre de nueva Ubicacion' ),
    'separate_items_with_commas' => __( 'Separa las ubicaciones con coma' ),
    'add_or_remove_items' => __( 'Agregar o Quitar Ubicaciones' ),
    'choose_from_most_used' => __( 'Escoger de las Ubicaciones utilizadas' ),
    'menu_name' => __( 'Ubicacion' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('ubicacion','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'ubicacions' ),
  ));
}

add_action( 'init', 'portada_taxonomy', 0 );

function portada_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Portadas', 'taxonomy general name' ),
    'singular_name' => _x( 'Portada', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Portada' ),
    'popular_items' => __( 'Portadas populares' ),
    'all_items' => __( 'Todas las Portadas' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Editar Portada' ), 
    'update_item' => __( 'Actualizar Portada' ),
    'add_new_item' => __( 'Agregar nueva Portada' ),
    'new_item_name' => __( 'Nombre de nueva Portada' ),
    'separate_items_with_commas' => __( 'Separa las portadas con coma' ),
    'add_or_remove_items' => __( 'Agregar o Quitar Portadas' ),
    'choose_from_most_used' => __( 'Escoger de las Portadas utilizadas' ),
    'menu_name' => __( 'Portada' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('portada','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'portadas' ),
  ));
}

function paginahome(){
   $args = array(
   'labels'=> array( 'name'=>'home',
       'singular_name'=> 'home',
       'menu_name'=>'Home',
       'name_admin_bar'=> 'home',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para el home",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail' ),
  'taxonomies' => array('portada'),
   'query_var'=>true,
  );
  register_post_type( "home", $args );
 }
 add_action("init","paginahome");
 
 function paginaservicios(){
   $args = array(
   'labels'=> array( 'name'=>'servicios',
       'singular_name'=> 'servicios',
       'menu_name'=>'Servicios',
       'name_admin_bar'=> 'servicios',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para el servicios",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail' ),
  'taxonomies' => array('ubicacion'),
   'query_var'=>true,
  );
  register_post_type( "servicios", $args );
 }
 add_action("init","paginaservicios");
 
   function paginagaleria(){
   $args = array(
   'labels'=> array( 'name'=>'galeria',
       'singular_name'=> 'galeria',
       'menu_name'=>'Galeria',
       'name_admin_bar'=> 'galeria',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para el galeria",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'thumbnail' ),
  'taxonomies' => array('category'),
   'query_var'=>true,
  );
  register_post_type( "galeria", $args );
 }
 add_action("init","paginagaleria");
 
  function paginagiftcard(){
   $args = array(
   'labels'=> array( 'name'=>'giftcard',
       'singular_name'=> 'giftcard',
       'menu_name'=>'Gift Card',
       'name_admin_bar'=> 'giftcard',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para el giftcard",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail' ),
  'taxonomies' => array('category', 'portada'),
   'query_var'=>true,
  );
  register_post_type( "giftcard", $args );
 }
 add_action("init","paginagiftcard");
 
  function paginacontacto(){
   $args = array(
   'labels'=> array( 'name'=>'contacto',
       'singular_name'=> 'contacto',
       'menu_name'=>'Contacto',
       'name_admin_bar'=> 'contacto',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para el contacto",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail' ),
  'taxonomies' => array('category', 'ubicacion'),
   'query_var'=>true,
  );
  register_post_type( "contacto", $args );
 }
 add_action("init","paginacontacto");
 
   function paginabackground(){
   $args = array(
   'labels'=> array( 'name'=>'background',
       'singular_name'=> 'background',
       'menu_name'=>'Background',
       'name_admin_bar'=> 'background',
       'all_items' =>'Ver todas las publicaciones',
       'add_new'=> 'Añadir nueva publicación' ),
   'description' =>"Este tipo de post es para el background",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail' ),
  'taxonomies' => array('ubicacion'),
   'query_var'=>true,
  );
  register_post_type( "background", $args );
 }
 add_action("init","paginabackground");