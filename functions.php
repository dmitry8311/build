<?php
/**
 * aarsleff functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aarsleff
 */

require_once get_template_directory() . '/inc/job-sync.php';
require_once get_template_directory() . '/inc/utilities.php';

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

add_post_type_support( 'page', 'excerpt' );

add_filter( 'block_categories_all', function ( $categories ) {
	array_unshift( $categories, array(
		'slug'  => 'theme-aarsleff',
		'title' => 'AARSLEFF',
	) );


	return $categories;
} );


function aarsleff_filter_jobs() {
	if ( $_POST['post_type'] !== 'job' ) {
		return;
	}

	$args = array(
		'post_type'      => 'job',
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
		'meta_key'       => 'content_type_job__priority',
		'orderby'        => 'meta_value',
		'order'          => 'DESC',
		'tax_query'      => [
			'relation' => 'OR',
		],
	);

	aarsleff_add_loop_filter_to_WP_Query( $args, 'job_location', 'location_ids' );
	aarsleff_add_loop_filter_to_WP_Query( $args, 'job_department', 'department_ids' );

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		$index = 1;
		echo '<div class="block-job-loop__slide">';
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part( 'template-parts/content', get_post_type() );

			if ( $index % 3 === 0 ) {

				if ( $index % 9 === 0 ) {
					echo '</div>';
					echo '<div class="block-job-loop__slide">';
				}
			}
			$index ++;
		endwhile;
		wp_reset_postdata();
	else :
		echo '<h2>Keine Stellenanzeigen gefunden.</h2>';
	endif;

	die();
}

add_action( 'wp_ajax_filter_posts', 'aarsleff_filter_jobs' );
add_action( 'wp_ajax_nopriv_filter_posts', 'aarsleff_filter_jobs' );


function aarsleff_filter_projects() {
	if ( $_POST['post_type'] !== 'projects' ) {
		return;
	}
	$args = array(
		'post_type'      => 'projects',
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'tax_query'      => [
			'relation' => 'OR',
		],
	);

	aarsleff_add_loop_filter_to_WP_Query( $args, 'project_category', 'category_ids' );
	aarsleff_add_loop_filter_to_WP_Query( $args, 'project_service', 'service_ids' );
	aarsleff_add_loop_filter_to_WP_Query( $args, 'project_technology', 'technology_ids' );
	aarsleff_add_loop_filter_to_WP_Query( $args, 'project_region', 'region_ids' );

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		$index = 1;
		echo '<div class="block-project-loop__slide">';
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part( 'template-parts/content', get_post_type() . '--teaser' );
			if ( $index % 12 === 0 ) {
				echo '</div>';
				echo '<div class="block-project-loop__slide">';
			}
			$index ++;
		endwhile;
		wp_reset_postdata();
	else :
		echo '<h2>Keine Datensätze gefunden.</h2>';
	endif;

	die();
}

add_action( 'wp_ajax_filter_posts', 'aarsleff_filter_projects' );
add_action( 'wp_ajax_nopriv_filter_posts', 'aarsleff_filter_projects' );


function aarsleff_filter_library() {
	if ( $_POST['post_type'] !== 'library-item' ) {
		return;
	}
	$args = array(
		'post_type'      => 'library-item',
		'post_status'    => 'publish',
		'posts_per_page' => - 1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'tax_query'      => [
			'relation' => 'OR',
		],
	);


	aarsleff_add_loop_filter_to_WP_Query( $args, 'library__category', 'category_ids' );
	aarsleff_add_loop_filter_to_WP_Query( $args, 'library__filter', 'filter_ids' );

	$types = array_filter(explode(',', $_POST['types']), static fn(string $type) => in_array($type, ['file', 'link', 'video']));
	if($types !== []) {
		$args['meta_query'] = [
			'relation' => 'OR',
		];
		foreach($types as $type) {
			$args['meta_query'][] = [
				'key' => 'content_type_library_item__type',
				'value' => $type,
				'compare' => '='
			];
		}
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		$index = 1;
		echo '<div class="block-library-loop__slide">';
		while ( $query->have_posts() ) : $query->the_post();
			get_template_part( 'template-parts/content', get_post_type() . '--teaser' );
			if ( $index % 9 === 0 ) {
				echo '</div>';
				echo '<div class="block-library-loop__slide">';
			}
			$index ++;
		endwhile;
		wp_reset_postdata();
	else :
		echo '<h2>Keine Projekte gefunden.</h2>';
	endif;

	die();
}

add_action( 'wp_ajax_filter_posts', 'aarsleff_filter_library' );
add_action( 'wp_ajax_nopriv_filter_posts', 'aarsleff_filter_library' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function aarsleff_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on aarsleff, use a find and replace
		* to change 'aarsleff' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'aarsleff', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Header Menu', 'aarsleff' ),
			'menu-2' => esc_html__( 'Footer Primary', 'aarsleff' ),
			'menu-3' => esc_html__( 'Footer Secondary', 'aarsleff' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'aarsleff_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}

add_action( 'after_setup_theme', 'aarsleff_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aarsleff_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aarsleff_content_width', 640 );
}

add_action( 'after_setup_theme', 'aarsleff_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aarsleff_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aarsleff' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'aarsleff' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'aarsleff_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aarsleff_scripts() {
	wp_enqueue_style( 'aarsleff-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), time() );
	wp_enqueue_style( 'aarsleff-carousel', get_stylesheet_directory_uri() . '/node_modules/slick-carousel/slick/slick.css', array(), time() );
	wp_style_add_data( 'aarsleff-style', 'rtl', 'replace' );
	wp_enqueue_script( 'aarsleff-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'aarsleff-carousel', get_stylesheet_directory_uri() . '/node_modules/slick-carousel/slick/slick.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'aarsleff-base', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(
		'jquery',
		'aarsleff-carousel'
	), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'aarsleff_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function aarsleff_register_acf_blocks() {
	/**
	 * We register our block's with WordPress's handy
	 * register_block_type();
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	register_block_type( __DIR__ . '/blocks/hero' );
	register_block_type( __DIR__ . '/blocks/two-column-text' );
	register_block_type( __DIR__ . '/blocks/single-column-text' );
    register_block_type( __DIR__ . '/blocks/two-column-text-manual' );
    register_block_type( __DIR__ . '/blocks/video' );
	register_block_type( __DIR__ . '/blocks/facts' );
	register_block_type( __DIR__ . '/blocks/cta' );
	register_block_type( __DIR__ . '/blocks/locations' );
	register_block_type( __DIR__ . '/blocks/timeline' );
	register_block_type( __DIR__ . '/blocks/deeplinks' );
	register_block_type( __DIR__ . '/blocks/article-loop' );
	register_block_type( __DIR__ . '/blocks/project-loop' );
	register_block_type( __DIR__ . '/blocks/library-loop' );
	register_block_type( __DIR__ . '/blocks/job-loop' );
	register_block_type( __DIR__ . '/blocks/persons' );
	register_block_type( __DIR__ . '/blocks/facts-and-figures' );
	register_block_type( __DIR__ . '/blocks/gallery' );
    register_block_type( __DIR__ . '/blocks/related-articles' );
}

// Here we call our tt3child_register_acf_block() function on init.
add_action( 'init', 'aarsleff_register_acf_blocks' );


function register_widget_areas() {

	register_sidebar( array(
		'name'          => 'Footer area one',
		'id'            => 'footer_area_one',
		'description'   => 'This widget area discription',
		'before_widget' => '<section class="footer-area footer-area-one">',
		'after_widget'  => '</section>',
	) );

	register_sidebar( array(
		'name'          => 'Footer area two',
		'id'            => 'footer_area_two',
		'description'   => 'This widget area discription',
		'before_widget' => '<section class="footer-area footer-area-two">',
		'after_widget'  => '</section>',
	) );

	register_sidebar( array(
		'name'          => 'Footer area three',
		'id'            => 'footer_area_three',
		'description'   => 'This widget area discription',
		'before_widget' => '<section class="footer-area footer-area-three">',
		'after_widget'  => '</section>',
	) );

	register_sidebar( array(
		'name'          => 'Footer area four',
		'id'            => 'footer_area_four',
		'description'   => 'This widget area discription',
		'before_widget' => '<section class="footer-area footer-area-four">',
		'after_widget'  => '</section>',
	) );

}

add_action( 'widgets_init', 'register_widget_areas' );


/**
 * Load Jetpack compatibility file.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280; /* pixels */
}

/**
 * add SVG to allowed file uploads
 **/
function add_file_types_to_uploads( $file_types ) {

	$new_filetypes        = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types           = array_merge( $file_types, $new_filetypes );

	return $file_types;
}

add_action( 'upload_mimes', 'add_file_types_to_uploads' );


/**
 * Load Jetpack compatibility file.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1280; /* pixels */
}


/**
 * Convert png to webp
 */
add_filter( 'wp_handle_upload', 'create_webp' );

function create_webp( $file ) {

	if ( $file['type'] === "image/png" ) {
		// Create and save
		$img = imagecreatefrompng( $file['file'] );
		imagepalettetotruecolor( $img );
		imagealphablending( $img, true );
		imagesavealpha( $img, true );
		imagewebp( $img, str_replace( ".png", ".webp", $file['file'] ), 100 );
		imagedestroy( $img );

	}

	return $file;
}

/**
 * Breadcrumbs
 */
function aarsleff_breadcrumbs() {
    global $post;

    // Only show breadcrumbs on child pages
    if ( $post->post_parent ) {
        echo '<nav class="breadcrumbs">';

        // Get all ancestors (parents)
        $parents = get_post_ancestors( $post->ID );

        // Reverse the array to display in correct order (oldest parent first)
        $parents = array_reverse( $parents );

        // Loop through each parent and display it as a link
        foreach ( $parents as $parent ) {
            echo '<a href="' . get_permalink( $parent ) . '">' . get_the_title( $parent ) . '</a> / ';
        }

        // Display the current page title
        echo '<span>' . get_the_title( $post->ID ) . '</span>';
        echo '</nav>';
    }
}

function modify_existing_role() {
    // Rolle abrufen (z. B. 'editor', 'author', 'subscriber')
    $role = get_role('editor'); // Ersetze 'editor' durch die gewünschte Rolle

    if ($role) {
        // Berechtigung hinzufügen
        $role->add_cap('edit_theme_options'); // Beispiel: Erlaubt das Bearbeiten von Theme-Optionen
    }
}
add_action('init', 'modify_existing_role');
