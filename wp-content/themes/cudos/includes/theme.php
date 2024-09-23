<?php

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
    add_action('init', array($this, 'register_menus'));
    add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
		add_filter('timber/context', array($this, 'add_to_context'));
		add_filter('timber/twig', array($this, 'add_to_twig'));
    add_filter('timber/twig/environment/options', [$this, 'update_twig_environment_options']);
    
		parent::__construct();
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

		return $context;
	}

	public function theme_supports()
	{
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
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

		add_theme_support('menus');
	}

  public function get_team() 
  {
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
    );

    return Timber::get_posts($args);
  }

  public function get_case_studies($post_count) 
  {
    $args = array(
        'post_type' => 'creation',
        'posts_per_page' => $post_count ? $post_count : -1,
    );

    return Timber::get_posts($args);
  }

  public function get_news($post_count) {
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => $post_count ? $post_count : -1,
    );

    return Timber::get_posts($args);
  }

  public function add_to_twig($twig)
	{
    $twig->addFunction(new \Twig\TwigFunction('get_news', [$this, 'get_news']));
    $twig->addFunction(new \Twig\TwigFunction('get_team', [$this, 'get_team']));
    $twig->addFunction(new \Twig\TwigFunction('get_case_studies', [$this, 'get_case_studies']));
		return $twig;
	}

	function update_twig_environment_options($options)
	{
		// $options['autoescape'] = true;
		return $options;
	}
  
}