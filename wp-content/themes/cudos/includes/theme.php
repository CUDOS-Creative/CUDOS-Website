<?php

namespace App;

use Timber\Site;
use Timber\Timber;

/**
 * Class StarterSite
 */
class StarterSite extends Site
{
	public function __construct()
	{
		add_action('after_setup_theme', array($this, 'theme_supports'));
		add_action('init', array($this, 'register_post_types'));
		add_action('init', array($this, 'register_taxonomies'));
    add_action('init', array($this, 'register_menus'));

    add_action('wp_enqueue_scripts', array($this, 'enqueue_assets')); // Enqueue assets here

		add_filter('timber/context', array($this, 'add_to_context'));
    
		parent::__construct();
	}

	/**
	 * This is where you can register custom taxonomies.
	 */
	public function register_taxonomies()
	{
	}

  public function register_menus() {
    register_nav_menus(
      array(
        'primary' => __('Primary Menu'),
      )
    );
  }

  public function enqueue_assets()
  {
    $css_file = get_template_directory_uri() . '/assets/css/style.min.css';
    $css_version = filemtime(get_template_directory() . '/assets/css/style.min.css');

    $js_file = get_template_directory_uri() . '/assets/js/scripts.min.js';
    $js_version = filemtime(get_template_directory() . '/assets/js/scripts.min.js');
    
    // Enqueue the CSS file with cache busting
    wp_enqueue_style('theme-style', $css_file, array(), $css_version);

    // Enqueue the JS file with cache busting
    wp_enqueue_script('theme-script', $js_file, array(), $js_version, true); // 'true' to load in footer
  }

	/**
	 * This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context($context)
	{
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
    $context['hero'] = get_field('hero');
		$context['menu']  = Timber::get_menu('primary');
		$context['site']  = $this;
    $context['layout'] = get_field('layout');

    $args = array(
      'post_type'       => 'creation',
      'posts_per_page'  => -1,
      'post_status'     => 'publish',
    );

    $context['creations'] = Timber::get_posts($args);

		return $context;
	}

	public function theme_supports()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
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

		add_theme_support('menus');
	}

	/**
	 * Updates Twig environment options.
	 *
	 * @link https://twig.symfony.com/doc/2.x/api.html#environment-options
	 *
	 * @param array $options An array of environment options.
	 *
	 * @return array
	 */
	function update_twig_environment_options($options)
	{
		// $options['autoescape'] = true;

		return $options;
	}
}