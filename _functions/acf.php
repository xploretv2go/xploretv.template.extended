<?php
/*
 * Save Custom Fields in Json
 **/
function my_acf_json_save_point($path)
{
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

/*
 * Load Custom Fields in Json
 **/
function my_acf_json_load_point($paths)
{

    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
}

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
add_filter('acf/settings/load_json', 'my_acf_json_load_point');


/**
* add_acf_menu_pages.
*
* Add custom option pages to the WordPRess admin with Acf
*
* @see  https://since1979.dev/snippet-002-adding-option-pages-with-acf/
*
* @uses acf https://www.advancedcustomfields.com/
* @uses acf_add_options_page https://www.advancedcustomfields.com/resources/acf_add_options_page/
* @uses acf_add_options_sub_page https://www.advancedcustomfields.com/resources/acf_add_options_sub_page/
*/
 function add_acf_menu_pages()
 {
     acf_add_options_page(array(
         'page_title' => 'Theme Options',
         'menu_title' => 'Theme Options',
         'menu_slug' => 'theme-options',
         'capability' => 'manage_options',
         'position' => 61.1,
         'redirect' => true,
         'icon_url' => 'dashicons-admin-customizer',
         'update_button' => 'Save options',
         'updated_message' => 'Options saved',
     ));

     acf_add_options_sub_page(array(
         'page_title' => 'Theme Options',
         'menu_title' => 'Theme Options',
         'parent_slug' => 'theme-options',
     ));
}

/**
* Hook: acf/init.
*
* @uses add_action() https://developer.wordpress.org/reference/functions/add_action/
* @uses acf/init https://www.advancedcustomfields.com/resources/acf-init/
*/
add_action('acf/init', 'add_acf_menu_pages');
