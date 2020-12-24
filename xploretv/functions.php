<?php

// Include settings
require_once('_functions/acf.php');
require_once('_functions/acf_content_elements.php');

/**
 * Register and Enqueue Styles.
 */
function seso_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

  wp_register_style('a1xploretv-css-bootstrap', get_template_directory_uri() . '/lib/css/bootstrap.min.css', array(), $theme_version);
  wp_register_style('a1xploretv-css-slick', get_template_directory_uri() . '/lib/css/slick.css', array(), $theme_version);
  wp_register_style('a1xploretv-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), $theme_version);

  wp_enqueue_style( 'a1xploretv-css-bootstrap');
  wp_enqueue_style( 'a1xploretv-css-slick');
  wp_enqueue_style( 'a1xploretv-style');
}

add_action( 'wp_enqueue_scripts', 'seso_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function seso_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

  wp_register_script('a1xploretv-js-jquery', get_template_directory_uri() . '/lib/js/jquery-3.5.1.min.js', array(), $theme_version, true);
  wp_register_script('a1xploretv-js-bootstrap', get_template_directory_uri() . '/lib/js/bootstrap.min.js', array(), $theme_version, true);
  wp_register_script('a1xploretv-js-slick', get_template_directory_uri() . '/lib/js/slick.min.js', array(), $theme_version, true);
  wp_register_script('a1xploretv-js-validate', get_template_directory_uri() . '/lib/js/jquery.validate.min.js', array(), $theme_version, true);
  wp_register_script('a1xploretv-js-spatial-navigation', get_template_directory_uri() . '/lib/js/spatial_navigation.js', array(), $theme_version, true);
  wp_register_script('a1xploretv-js', get_template_directory_uri() . '/assets/js/script.min.js', array(), $theme_version, true);

  wp_enqueue_script( 'a1xploretv-js-jquery');
  wp_enqueue_script( 'a1xploretv-js-bootstrap');
  wp_enqueue_script( 'a1xploretv-js-slick');
  wp_enqueue_script( 'a1xploretv-js-validate');
  wp_enqueue_script( 'a1xploretv-js-spatial-navigation');
  wp_enqueue_script( 'a1xploretv-js');

  wp_script_add_data( 'a1xploretv-js', 'async', true );
}

add_action( 'wp_enqueue_scripts', 'seso_register_scripts' );
