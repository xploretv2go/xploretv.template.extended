<?php
// Section D - Full width video
function content_element_section_d($all_data, $section_index) {
    $rand = rand(10, 99);
    ?>
    <!-- section_d -->
    <section id="section_<?= $section_index ?>" class="xploretv-d xploretv-video-section <?php if ($all_data['video-provider'] == 'youtube' || $all_data['video-provider'] == 'vimeo') : ?> you-vim-video <?php endif;  ?>">
        <?php
          if ($all_data['video-provider'] == 'local-video') {
        ?>
          <video class="js-xploretv-d-video loc-video" playsinline  poster="<?= $all_data['video-poster']['url'] ?>" id="bgvid">
            <source src="<?= $all_data['video-source'] ?>" type="video/mp4">
          </video>
        <?php
          } else if ($all_data['video-provider'] == 'stream') {
        ?>
          <video class="js-xploretv-d-video loc-video" playsinline  poster="<?= $all_data['video-poster']['url'] ?>" id="bgvid">
            <source src="<?= $all_data['video-stream'] ?>" type="video/mp4">
          </video>
        <?php
    }?>

        <div class="js-xploretv-d-content position-relative d-flex flex-column justify-content-center align-items-center text-center h-100 ">

            <div class="mt-1">

                <?php if ($all_data['video-provider'] == 'youtube') { ?>
                    <div class="xploretv-main-wrapper-inner">
                        <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                        <h3 class="mb-5">
                            <?= nl2br($all_data['copytext']) ?>
                        </h3>
                    </div>
                    <div class="video-container mx-auto">

                        <div class="yt-poster" data-id="player<?= $rand ?>" style="background-image: url('https://img.youtube.com/vi/<?= $all_data['video-id'] ?>/hqdefault.jpg')"></div>
                        <div id="player<?= $rand; ?>" id="player<?= $rand; ?>" data-num="<?= $rand; ?>" data-src="<?= $all_data['video-id'] ?>" class="js-yt-video-frame xploretv-video-frame-yt mt-1"></div>

                        <a data-id="player<?= $rand ?>" id="player<?= $rand ?>" href="javascript:void(0)" onclick="playVideoYT<?= $rand ?>(this);" class="js-video-global-pause js-video-slider-btn xploretv-d-play mx-auto focusable js-xploretv-d-start single-video"></a>
                    </div>

                <?php } else if ($all_data['video-provider'] == 'vimeo') { ?>
                    <?php
                        $imgid = $all_data['video-id'];
                        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
                        $thumb = $hash[0]['thumbnail_medium'];
                    ?>
                    <div class="xploretv-main-wrapper-inner">
                        <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                        <h3 class="mb-5">
                            <?= nl2br($all_data['copytext']) ?>
                        </h3>
                    </div>
                    <div class="video-container mx-auto">

                        <div class="vimeo-poster" data-player-id="<?= $rand; ?>" style="background-image: url('<?= $thumb; ?>')"></div>
                        <iframe id="player-vimeo<?= $rand; ?>" src="https://player.vimeo.com/video/<?= $all_data['video-id'] ?>" class="xploretv-video-frame-yt mt-1 js-vimeo-player" allow="autoplay" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

                        <a href="javascript:void(0)" data-player-id="<?= $rand; ?>" onclick="playVideoVimeo<?= $rand ?>(this);" class="js-video-global-pause xploretv-d-play mx-auto focusable js-xploretv-d-start-vimeo single-video"></a>
                    </div>

                    <script>
                            var iframe_vimeo = document.getElementById("player-vimeo<?= $rand; ?>");
                            var player_vimeo<?= $rand ?> = new Vimeo.Player(iframe_vimeo);

                            function playVideoVimeo<?= $rand ?>(e) {
                                if(e.classList.contains('vimeo-video-play')){
                                    player_vimeo<?= $rand ?>.pause();
                                    e.classList.remove('vimeo-video-play');
                                    e.classList.remove('xploretv-d-pause');
                                    e.classList.add('xploretv-d-play');
                                    $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 1);
                                } else {
                                     player_vimeo<?= $rand ?>.play();
                                     e.classList.add('vimeo-video-play');
                                     //e.classList.add('xploretv-d-pause');
                                     e.classList.remove('xploretv-d-play');
                                     $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 0);
                                }

                            }

                            player_vimeo<?= $rand ?>.on('ended', function (e) {
                               $('.js-xploretv-d-start-vimeo[data-player-id="<?= $rand; ?>"]').removeClass('slider-video-play');
                               $('.js-xploretv-d-start-vimeo[data-player-id="<?= $rand; ?>"]').removeClass('xploretv-d-pause');
                               $('.js-xploretv-d-start-vimeo[data-player-id="<?= $rand; ?>"]').addClass('xploretv-d-play');
                               $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 1);
                           });


                    </script>
                <?php } else { ?>
                    <div class="xploretv-main-wrapper-inner">
                        <div class="h1 text-white h-bold"><?= $all_data['headline'] ?></div>
                        <h3 class="text-white mb-5">
                            <?= nl2br($all_data['copytext']) ?>
                        </h3>
                        <a href="javascript:void(0)"  id="js-xploretv-d-start" data-player-id="<?= $rand; ?>" class="xploretv-d-play mx-auto focusable js-xploretv-d-start loc-video single-video"></a>
                    </div>
                <?php } ?>

            </div>
        </div>

        <?php if ($all_data['video-provider'] === 'local-video' && $all_data['scroll_indicator'] && $all_data['scroll_indicator'] === true) { ?>
            <img src="<?php echo get_theme_file_uri() ?>/images/arrow.png" alt="" class="scroll-indicator jump" />
        <?php } ?>

        <script>
            window.addEventListener('load', function() {
                // Add section to SN
                SpatialNavigation.add('section_<?= $section_index ?>', {
                    selector: '#section_<?= $section_index ?> .focusable',
                    leaveFor: {
                        up: '@section_<?= $section_index - 1 ?>',
                        down: '@section_<?= $section_index + 1 ?>',
                        left: '',
                        right: ''
                    }
                });
            });
        </script>
    </section>

    <?php
}
