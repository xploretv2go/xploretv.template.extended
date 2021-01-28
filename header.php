<?php
/**
 * Header file for the A1 Xplore TV Smart Home WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage XploreTV_SmartHome
 * @since XploreTV Smart Home 1.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
        <script src="https://player.vimeo.com/api/player.js"></script>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		?>


		</header><!-- #site-header -->
            <header class="a1xploretv-homepage">
                <div class="d-flex justify-content-between align-items-center">
                    <div class=""><?=get_the_title()?></div>
                    <div id="js-a1xploretv-date-time" class="a1xploretv-date-time"><span class="js-a1xploretv-date"></span><span class="a1xploretv-line mx-1"> | </span><span class="js-a1xploretv-time"></span></div>
                </div>
            </header>
