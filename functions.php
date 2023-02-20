<?php

require('lib/hardcoded_string_translations.php');

Timber::$dirname = array( 'templates', 'views' );
Timber::$autoescape = false;

class StarterSite extends Timber\Site 
{
	/** Add timber support. */
	public function __construct() 
	{
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_filter( 'timber/twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_sidebars' ) );
		
		parent::__construct();
	}

	public function register_sidebars()
	{
		require('lib/sidebars.php');
	}

	public function add_to_context( $context ) {
		$context['foo']   = 'bar';
		$context['site_footer_column_1']  = Timber::get_widgets('site-footer-column-1');
		$context['site_footer_column_2']  = Timber::get_widgets('site-footer-column-2');
		$context['site_footer_column_3']  = Timber::get_widgets('site-footer-column-3');
		$context['site_footer_column_4']  = Timber::get_widgets('site-footer-column-4');
		$context['site_footer_column_5']  = Timber::get_widgets('site-footer-column-5');
		$context['site_header_menu']  = new Timber\Menu('Site header menu');
		$context['icl_language_code'] = ICL_LANGUAGE_CODE;
		$context['site']  = $this;
		return $context;
	}

	public function theme_supports() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig\Extension\StringLoaderExtension() );
		return $twig;
	}

}

new StarterSite();

add_action('wp_enqueue_scripts', 'tbs_enqueue_scripts');
function tbs_enqueue_scripts()
{
	wp_enqueue_style('tbs-app', get_template_directory_uri() . '/static/css/app.css', [], '0.0.9');
	wp_enqueue_script('tbs-app', get_template_directory_uri() . '/static/js/app.js', ['jquery'], '0.0.5');
	
	wp_enqueue_style('tbs-font-adobe-clean', get_template_directory_uri() . '/static/font/adobe_clean/stylesheet.css');
	wp_enqueue_style('tbs-font-georgia', get_template_directory_uri() . '/static/font/sd_georgia/stylesheet.css');

	wp_enqueue_style('tbs-font-fontawesome', get_template_directory_uri() . '/static/lib/fontawesome/css/fontawesome.min.css');
	wp_enqueue_style('tbs-font-fontawesome-regular', get_template_directory_uri() . '/static/lib/fontawesome/css/regular-separated.css');
	wp_enqueue_style('tbs-font-fontawesome-solid', get_template_directory_uri() . '/static/lib/fontawesome/css/solid-separated.css');
	wp_enqueue_style('tbs-font-fontawesome-brands', get_template_directory_uri() . '/static/lib/fontawesome/css/brands-separated.css');

	wp_enqueue_style('tbs-bootstrap-reboot', get_template_directory_uri() . '/static/lib/bootstrap/css/bootstrap-reboot.min.css');
	wp_enqueue_style('tbs-bootstrap-grid', get_template_directory_uri() . '/static/lib/bootstrap/css/bootstrap-grid.min.css');

	wp_enqueue_style('tbs-slick-theme', get_template_directory_uri() . '/static/lib/slick/slick/slick-theme.css');
	wp_enqueue_script('tbs-slick', get_template_directory_uri() . '/static/lib/slick/slick/slick.min.js', ['jquery']);
}