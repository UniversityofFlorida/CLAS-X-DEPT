<?php
/**
*      THEME: UF CLAS 2020 Department Theme
*      AUTHOR: Yash Singh
*      EMAIL: yash5@ufl.edu
*      DATE: September 2017 
*/





/* LOAD THEME X CSS*/
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
   wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array('parent-style') );
}

function load_custom_fonts($init) {

    $stylesheet_url = 'https://t2.publications.clas.ufl.edu/wp-content/themes/X/editor-styles.css';

    if(empty($init['content_css'])) {
        $init['content_css'] = $stylesheet_url;
    } else {
        $init['content_css'] = $init['content_css'].','.$stylesheet_url;
    }

    $font_formats = isset($init['font_formats']) ? $init['font_formats'] : 'Gentona Thin=Gentona_Thin; Gentona Thin Italic=Gentona_ThinItalic; Gentona Extra Light=Gentona_ExtraLight; Gentona Extra Light Italic=Gentona_ExtraLightItalic; Gentona Light=Gentona_Light; Gentona Light Italic=Gentona_LightItalic; Gentona Extra Light=Gentona_ExtraLight; Gentona Extra Light Italic=Gentona_ExtraLightItalic; Gentona Light=Gentona_Light; Gentona Light Italic=Gentona_LightItalic; Gentona Book=Gentona_Book; Gentona Book Italic=Gentona_BookItalic; Gentona Medium=Gentona_Medium; Gentona Medium Italic=Gentona_MediumItalic; Gentona Semi Bold=Gentona_SemiBold; Gentona Semi Bold Italic=Gentona_SemiBoldItalic; Gentona Bold=Gentona_Bold; Gentona Bold Italic=Gentona_BoldItalic;Gentona Extra Bold=Gentona_ExtraBold; Gentona Extra Bold Italic=Gentona_ExtraBoldItalic; Gentona Heavy=Gentona_Heavy;Gentona Heavy Italic=Gentona_HeavyItalic;Quadon Thin=Quadon_Thin;Quadon Thin Italic=Quadon_ThinItalic;Quadon Light=Quadon_Light;Quadon Light Italic=Quadon_LightItalic;Quadon Regular=Quadon_Regular;Quadon Regular Italic=Quadon_RegularItalic;Quadon Medium=Quadon_Medium;Quadon Medium Italic=Quadon_MediumItalic;Quadon Bold=Quadon_Bold;Quadon Bold Italic=Quadon_BoldItalic;Quadon Extra Bold=Quadon_ExtraBold;Quadon Extra Bold Italic=Quadon_ExtraBoldItalic;Quadon Ultra Bold=Quadon_UltraBold;Quadon Ultra Bold Italic=Quadon_UltraBoldItalic;Quadon Black=Quadon_Black;Quadon Black Italic=Quadon_BlackItalic;Quadon Heavy=Quadon_Heavy;Quadon Heavy Italic=Quadon_HeavyItalic';
    $custom_fonts = ';'.'';
    $init['font_formats'] = $font_formats . $custom_fonts;

    return $init;
}
add_filter('tiny_mce_before_init', 'load_custom_fonts');


function load_custom_fonts_frontend() {

    echo '<link type="text/css" rel="stylesheet" href="/wp-content/themes/X/editor-style.css">';
}
add_action('wp_head', 'load_custom_fonts_frontend');
add_action('admin_head', 'load_custom_fonts_frontend');



/* SETUP THEME X*/
add_action( 'after_setup_theme', 'X_theme_setup' );
function X_theme_setup() {

   // Disable Twenty Seventeen changes to the image size attribute
   remove_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr' );
   remove_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr' );

   // Default layout of page is one column
   //update_post_meta( $post_id, 'page_layout', 'one-column' );


   // Make sure featured images are enabled
   add_theme_support( 'post-thumbnails' );


    // This will remove support for post thumbnails on ALL Post Types
    remove_theme_support( 'post-thumbnails' );
    // Add this line in to re-enable support for just Posts
    add_theme_support( 'post-thumbnails', array( 'post' ) );
        // Default Content Width
	$GLOBALS['content_width'] = 1440;
        $content_width = 1440;
        //update_option('image_default_align', 'left' );
        //update_option('image_default_link_type', 'custom' );
        //update_option('image_default_size', 'large' );
        // Custom Image Sizes
        add_image_size( 'portrait', 414, 9999, false );
        add_image_size( 'portrait-crop', 414, 532, true ); // Crop 
        add_image_size( 'square-crop', 768, 768, true ); // Crop 
        add_image_size( 'thumbnail', 736, 9999, true ); 
        add_image_size( 'thumbnail-crop', 736, 535, true ); // Crop
        add_image_size( 'page-wide', 768, 9999, false );
        add_image_size( 'page-wide', 768, 9999, false );
        add_image_size( 'featured-image-mobile-crop', 768, 460.8, true); // Crop -- IMPORTANT
        add_image_size( 'breakout', 940, 9999, false );
        add_image_size( 'jumbo-breakout', 1440, 9999, false );
        add_image_size( 'featured-image-crop', 1440, 864, true); // Crop
        add_image_size( 'full-screen', 2000, 9999, true); // Crop
        add_image_size( 'full-screen-crop', 2000, 1200, true); // Crop 
        update_option( 'portrait', 414 );
        update_option( 'portrait-crop', 414 );
        update_option( 'square-crop-hd', 960, 750, true  );
        update_option( 'square-crop', 768 );
        update_option( 'thumbnail', 736 );
        update_option( 'thumbnail-crop', 736 );
	update_option( 'page-wide', 768 );	
	update_option( 'breakout', 940 );
	update_option( 'jumbo-breakout', 1440 );
	update_option( 'featured-image-crop', 1440 );
	update_option( 'full-screen', 2000 );
	update_option( 'full-screen-crop', 2000 );
        update_option( 'image_default_align', 'center' );


        // Register Menu
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' )
	) );
  




     

        // Set the Featured Image 
        if ( has_post_thumbnail() ) { 
           the_post_thumbnail( 'full-screen-crop' ); 
        }







}
add_filter( 'image_size_names_choose', 'my_custom_sizes' );
function my_custom_sizes( $sizes ) {

   unset( $sizes['thumbnail']);
   unset( $sizes['medium']);
   unset( $sizes['Medium']);
   unset( $sizes['medium-Large'] );
   unset( $sizes['Medium-large'] );
   unset( $sizes['large']);
   unset( $sizes['twentyseventeen-featured-image'] ); 
   unset( $sizes['twentyseventeen-thumbnail-avatar'] ); 

    return array_merge( $sizes, array(
        'portrait' => __('Portrait'),
        'portrait-crop' => __('Portrait Crop'),
        'square-crop-hd' => __('Square Crop HD'),
        'square-crop' => __('Square Crop'),
        'thumbnail' => __('Thumbnail'),
        'thumbnail-crop' => __('Thumbnail Crop'), 
        'page-wide' => __('Page Wide'),     
        'breakout' => __('Breakout'),
        'jumbo-breakout' => __('Jumbo Breakout'),
        'featured-image-crop' => __('Featured Image Crop'),
        'full-screen' => __('Full Screen'),
        'full-screen-crop' => __('Full Screen Crop')
    ) );
}


/**
* I define the custom SIZES TAG for theme X.
 */
function X_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 100vw';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'X_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function X_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'X_header_image_tag', 10, 3 );

/**
* I define the custom SIZES TAG for the FEATURED IMAGE.
 */
function X_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 768px, 768px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'X_post_thumbnail_sizes_attr', 10, 3 );

function childtheme_content_width( $content_width ) {
    if ( twentyseventeen_is_frontpage() ) {
        $content_width = 864;
    }
    return $content_width;
}
add_filter( 'twentyseventeen_content_width', 'childtheme_content_width' );

function prefix_child_theme_setup() {
    // Set the default content width.
	$GLOBALS['content_width'] = 1600;
}
add_action( 'after_setup_theme', 'prefix_child_theme_setup', 11 );






/**
 * Add span to menu items with icon class so we can hide the text and show icons instead
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
 */
add_filter( 'walker_nav_menu_start_el', 'hrt_span_to_nav_menu', 10, 4 );
function hrt_span_to_nav_menu( $item_output, $item, $depth, $args ) {
   if ( isset( $item->classes ) && !empty( $item->classes ) ) {		
      if ($depth == 0) {
         $item_output = '<a href="'. $item->url .'" title="'. apply_filters( 'the_title', $item->title, $item->ID ) .'"> <span>'. apply_filters( 'the_title', $item->title, $item->ID ) .'</span></a>';
      }
      else {
         $item_output = '<a href="'. $item->url .'" title="'. apply_filters( 'the_title', $item->title, $item->ID ) .'"> '. apply_filters( 'the_title', $item->title, $item->ID ) .'</a>';
      }
   }
	return $item_output;
}

add_filter( 'nav_menu_link_attributes', 'my_nav_menu_attr_add', 10, 3 );
function my_nav_menu_attr_add( $atts, $item, $args ) {
    
    if ( ! empty( $item->attr_title ) ) {
		/**
		 * Add title attribute for a element
		 */
        $atts['attr_title'] = esc_attr( $item->attr_title );
	$atts['class'] = 'tooltip';		
       return $atts;
    }
    return $atts;
}


/* VERY IMPORTANT -- DOM MANIPULATIONS 
function addDataAttr( $items, $args ) {
    $dom = new DOMDocument();
    $dom->loadHTML($items);
    $find = $dom->getElementsByTagName('li');

    foreach ($find as $item ) :
        $item->setAttribute('data-menuanchor','s1');
    endforeach;

    return $dom->saveHTML();

}

add_filter('wp_nav_menu_items', 'addDataAttr', 10, 2);

*/

/**
 * Add span to menu items with icon class so we can hide the text and show icons instead
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
 */
// add post-formats to post_type 'page'
// add post-formats to post_type 'page'



// add post-formats to post_type 'page'
add_action('init', 'my_theme_slug_add_post_formats_to_page', 11);

function my_theme_slug_add_post_formats_to_page(){
    add_post_type_support( 'page', 'post-formats' );
    register_taxonomy_for_object_type( 'post_format', 'page' );
}


//add post-formats to post_type 'my_custom_post_type'
add_post_type_support( 'my_custom_post_type', 'post-formats' );

// register custom post type 'my_custom_post_type' with 'supports' parameter
add_action( 'init', 'create_my_post_type' );
function create_my_post_type() {
    register_post_type( 'my_custom_post_type',
      array(
        'labels' => array( 'name' => __( 'Products' ) ),
        'public' => true,
        'supports' => array('title', 'editor', 'post-formats')
    )
  );
} 

add_action( 'after_setup_theme', 'childtheme_formats', 11 );
function childtheme_formats(){
     add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link' ) );
}




/**
 * Apply styles to the visual editor
 */ 
add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {
 
    if ( !empty($url) )
        $url .= ',';
 
    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( get_stylesheet_directory_uri() ) . '/editor-styles.css';
 
    return $url;
}
 
/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );
 
function tuts_mce_editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );

    return $buttons;
}
 
/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
 
function tuts_mce_before_init( $settings ) {
 
    $style_formats = array(
        array(
            'title' => 'Small Text',
            'selector' => 'p',
            'classes' => 'smallCopy',
            ),
        array(
            'title' => 'Large Text',
            'selector' => 'p',
            'classes' => 'largeCopy',
            ),
        array(
            'title' => 'Largest Text',
            'selector' => 'p',
            'classes' => 'largeCopy2',
            ),

        array(
            'title' => 'READ MORE',
            'inline' => 'p',
            'classes' => 'read-more',
            ),
        array(
            'title' => 'Download Link',
            'selector' => 'a',
            'classes' => 'download'
            ),
        array(
            'title' => 'Testimonial',
            'selector' => 'p',
            'classes' => 'testimonial',
        ),
        array(
            'title' => 'Warning Box',
            'block' => 'div',
            'classes' => 'warning box',
            'wrapper' => true
        ),
        array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#ff0000',
                'fontWeight' => 'bold',
                'textTransform' => 'uppercase'
            )
        )
    );
 
    $settings['style_formats'] = json_encode( $style_formats );
 
    return $settings;
 
}
 
/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
 
/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
 
/*
 * Enqueue stylesheet, if it exists.
 */
function tuts_mcekit_editor_enqueue() {
  $StyleUrl = get_stylesheet_directory_uri().'/editor-styles.css'; // Customstyle.css is relative to the current file
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}


function kv_show_font_selector($buttons) {	
	
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'sub';
	$buttons[] = 'sup';
	$buttons[] = 'forecolor';
	$buttons[] = 'backcolor';
	$buttons[] = 'unlink';
	$buttons[] = 'visualaid';
	
	return $buttons;
}
add_filter('mce_buttons_2', 'kv_show_font_selector');

























class ALPHA_Menu extends Walker_Nav_Menu {
	/**
	 * What the class handles.
	 *
	 * @since 3.0.0
	 * @var string
	 *
	 * @see Walker::$tree_type
	 */
	public $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * Database fields to use.
	 *
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 *
	 * @see Walker::$db_fields
	 */
	public $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		// Default class.
		$classes = array( 'sub-menu' );

		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );
		$output .= "$indent</ul>{$n}";
	}

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filters the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .' data-yash="TEST">';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filters a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string   $title The menu item's title.
		 * @param WP_Post  $item  The current menu item.
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filters a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_el()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Page data object. Not used.
	 * @param int      $depth  Depth of page. Not Used.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$output .= "</li>{$n}";
	}

} // Walker_Nav_Menu



// REMOVE COMMENTS
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');
// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');







/* IF the post has a featured image then add this class to the body tag */ 
add_filter( 'body_class','set_one_column_class' );
function set_one_column_class( $classes ) {
     global $post;
   if ( has_post_thumbnail($post->ID) )
      return array_merge( $classes, array( 'has-featured-image' ) ); 
   return $classes;     
}

/* REMOVE CLASSES FROM BODY TAG 
add_filter( 'body_class', 'adjust_body_class' );
function adjust_body_class( $classes ) {  
    foreach ( $classes as $key => $value ) {
        if ( $value == 'page-two-column' ) unset( $classes[ $key ] );
    }     
    return $classes;      
}
 */


function X_page_layout() {
       update_option( 'page_layout', 'one-column' );


	
}
add_action( 'template_redirect', 'X_page_layout', 0 );






/* ADD PHOTO CREDITS TO MEDIA LIBRARY */
add_filter("attachment_fields_to_edit", "add_photo_credit", 10, 2);
function add_photo_credit($form_fields, $post) {
	$form_fields["photo_credit_txt"] = array(
		"label" => __("Photo Credit"),
		"input" => "text",
		"value" => get_post_meta($post->ID, "photo_credit_txt", true),
                "helps" => __("Add photo credits here"),
	);
 	return $form_fields;
}

add_filter("attachment_fields_to_save", "save_photo_credit", 10 , 2);
function save_photo_credit($post, $attachment) {
	if (isset($attachment['photo_credit_txt']))
		update_post_meta($post['ID'], 'photo_credit_txt', $attachment['photo_credit_txt']  );
	return $post;
}




// SHORTCODE [CLOSE]
function close_func( $atts ){
	return "</div>";
}
add_shortcode( 'close', 'close_func' );


// SHORTCODE [REOPEN]
function reopen_func( $atts ){
	return '<div class="wrap">';
}
add_shortcode( 'reopen', 'reopen_func' );






