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
        <header id="section_header" class="xploretv-homepage">
          <div class="d-flex justify-content-between align-items-center">
              <h1><?=get_the_title()?></h1>
              <div id="device_container" class="d-flex align-items-center">
                  <?php
                    $devices = array();
                    if (isset($_COOKIE['devices'])) {
                        $devices = json_decode(stripslashes($_COOKIE['devices']));
                    }
                    if (count($devices) === 0) {
                  ?>
                    <a href="<?php echo home_url('/devices/no-device/'); ?>" class="focusable">Keine Smart Home Devices gefunden</a>
                  <?php
                    } else {
                        echo 'Erkannte Geräte: ';
                        foreach ($devices as $device) {
                  ?>
                        <a class="button focusable ml-2 mb-0" href="<?= $device->href ?>"><?= $device->name ?></a>
                  <?php
                        }
                    }
                  ?>
              </div>

                <script>
                    window.addEventListener('load', function() {
                        const detection_url = 'https://api.nuki.io/discover/bridges';
                        const detection_url_zeroconf = 'http://localzeroconf:15051/a1/xploretv/v1/zeroconf';

                        var request = $.ajax({
                            url: detection_url,
                            contenttype: "application/json"
                            method: "GET"
                        });

                        var request_zeroconf = $.ajax({
                            url: detection_url_zeroconf,
                            contenttype: "application/json"
                            method: "GET"
                        });

                        request.done(function( msg ) {
                            var devices_cookie = getCookie('devices');
                            if (devices_cookie === null) {
                                var now = new Date();
                                var time = now.getTime();
                                var expireTime = time + 5 * 60 * 1000; // Expire in 5 minutes.
                                now.setTime(expireTime);
                                var cookie_content = [];
                                if (msg.bridges.length !== 0) {
                                    cookie_content = [{name: 'Nuki', href: '<?php echo home_url('/devices/nuki/'); ?>'}];
                                }
                                document.cookie = 'devices=' + JSON.stringify(cookie_content) + ';expires=' + now.toUTCString() + ';path=/';
                            }

                            devices_cookie = getCookie('devices');
                            devices = JSON.parse(devices_cookie);
                            var device_container_content = '';
                            if (devices.length !== 0) {
                                device_container_content += 'Erkannte Geräte: ';
                                $.each(devices, function(key, device) {
                                    device_container_content += '<a class="button focusable ml-2 mb-0" href="' + device.href + '">' + device.name + '</a>';
                                });
                            } else {
                                device_container_content = '<a href="<?php echo home_url('/devices/no-device/'); ?>" class="focusable">Keine Smart Home Devices gefunden</a>';
                            }
                            $('#device_container').html(device_container_content);
                        });

                        request_zeroconf.done(function( msg ) {
                            var devices_cookie = getCookie('devices');
                            if (devices_cookie === null) {
                                var now = new Date();
                                var time = now.getTime();
                                var expireTime = time + 5 * 60 * 1000; // Expire in 5 minutes.
                                now.setTime(expireTime);
                                var cookie_content = [];
                                if (msg.services.length !== 0) {
                                    cookie_content = [{name: 'Zeroconf', href: '<?php echo home_url('/devices/zeroconf/'); ?>'}];
                                }
                                document.cookie = 'devices=' + JSON.stringify(cookie_content) + ';expires=' + now.toUTCString() + ';path=/';
                            }

                            devices_cookie = getCookie('devices');
                            devices = JSON.parse(devices_cookie);
                            var device_container_content = '';
                            if (devices.length !== 0) {
                                device_container_content += 'Erkannte Geräte: ';
                                $.each(devices, function(key, device) {
                                    device_container_content += '<a class="button focusable ml-2 mb-0" href="' + device.href + '">' + device.name + '</a>';
                                });
                            } else {
                                device_container_content = '<a href="<?php echo home_url('/devices/no-device/'); ?>" class="focusable">Keine Smart Home Devices gefunden</a>';
                            }
                            $('#device_container').html(device_container_content);
                        });

                        request.fail(function( jqXHR, textStatus ) {
                            console.log( "Device detection failed: " + textStatus );
                        });

                        request_zeroconf.fail(function( jqXHR, textStatus ) {
                            console.log( "Device detection failed: " + textStatus );
                        });

                        // Add section to SN
                        SpatialNavigation.add('section_header', {
                            selector: '#section_header .focusable',
                            leaveFor: {
                                up: '',
                                down: '@section_0',
                                left: '',
                                right: ''
                            }
                        });
                    });
                </script>

              <div id="js-xploretv-date-time" class="xploretv-date-time">
                  <span class="js-xploretv-date"></span>
                  <span class="xploretv-line mx-1">|</span>
                  <span class="js-xploretv-time"></span>
              </div>
          </div>
        </header>
