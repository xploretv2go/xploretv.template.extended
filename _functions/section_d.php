<?php
// Section D - Full width video
function content_element_section_d($all_data, $section_index) {
    $rand = rand(10, 99);
    ?>
    <!-- section_d -->
    <section id="section_<?= $section_index ?>" class="a1xploretv-d a1xploretv-video-section <?php if ($all_data['video-provider'] == 'youtube' || $all_data['video-provider'] == 'vimeo') : ?> you-vim-video <?php endif;  ?>">
        <?php
          if ($all_data['video-provider'] == 'local-video') {
        ?>
          <video class="js-a1xploretv-d-video loc-video" playsinline  poster="<?= $all_data['video-poster']['url'] ?>" id="bgvid">
            <source src="<?= $all_data['video-source'] ?>" type="video/mp4">
          </video>
        <?php
          } else if ($all_data['video-provider'] == 'stream') {
        ?>
          <video class="js-a1xploretv-d-video loc-video" playsinline  poster="<?= $all_data['video-poster']['url'] ?>" id="bgvid">
            <source src="<?= $all_data['video-stream'] ?>" type="video/mp4">
          </video>
        <?php
    }?>

        <div class="js-a1xploretv-d-content position-relative d-flex flex-column justify-content-center align-items-center text-center h-100 ">


            <div class="mt-1">

                <?php if ($all_data['video-provider'] == 'youtube') { ?>
                    <div class="a1xploretv-main-wrapper-inner">
                        <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                        <h3 class="mb-5">
                            <?= nl2br($all_data['copytext']) ?>
                        </h3>
                    </div>
                    <div class="video-container mx-auto focusable">

                        <div class="yt-poster" data-id="player<?= $rand ?>" style="background-image: url('https://img.youtube.com/vi/<?= $all_data['video-id'] ?>/hqdefault.jpg')"></div>
                        <div id="player<?= $rand; ?>" id="player<?= $rand; ?>" data-num="<?= $rand; ?>" data-src="<?= $all_data['video-id'] ?>" class="js-yt-video-frame a1xploretv-video-frame-yt mt-1"></div>
                    </div>
                    <br/>
                    <a data-id="player<?= $rand ?>" id="player<?= $rand ?>" href="javascript:void(0)" onclick="playVideoYT<?= $rand ?>(this);" class="js-video-global-pause js-video-slider-btn a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start"></a>


                <?php } else if ($all_data['video-provider'] == 'vimeo') { ?>
                    <?php
                        $imgid = $all_data['video-id'];
                        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
                        $thumb = $hash[0]['thumbnail_medium'];
                    ?>
                    <div class="a1xploretv-main-wrapper-inner">
                        <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                        <h3 class="mb-5">
                            <?= nl2br($all_data['copytext']) ?>
                        </h3>
                    </div>
                    <div class="video-container mx-auto">

                        <div class="vimeo-poster" data-player-id="<?= $rand; ?>" style="background-image: url('<?= $thumb; ?>')"></div>
                        <iframe id="player-vimeo<?= $rand; ?>" src="https://player.vimeo.com/video/<?= $all_data['video-id'] ?>" class="a1xploretv-video-frame-yt mt-1 js-vimeo-player" allow="autoplay" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    </div>
                    <a href="javascript:void(0)" data-player-id="<?= $rand; ?>" onclick="playVideoVimeo<?= $rand ?>(this);" class="js-video-global-pause a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start-vimeo"></a>
                    <script>
                            var iframe_vimeo = document.getElementById("player-vimeo<?= $rand; ?>");
                            var player_vimeo<?= $rand ?> = new Vimeo.Player(iframe_vimeo);

                            function playVideoVimeo<?= $rand ?>(e) {
                                if(e.classList.contains('vimeo-video-play')){
                                    player_vimeo<?= $rand ?>.pause();
                                    e.classList.remove('vimeo-video-play');
                                    e.classList.remove('a1xploretv-d-pause');
                                    e.classList.add('a1xploretv-d-play');
                                    $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 1);
                                } else {
                                     player_vimeo<?= $rand ?>.play();
                                     e.classList.add('vimeo-video-play');
                                     e.classList.add('a1xploretv-d-pause');
                                     e.classList.remove('a1xploretv-d-play');
                                     $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 0);
                                }

                            }

                            player_vimeo<?= $rand ?>.on('ended', function (e) {
                               $('.js-a1xploretv-d-start-vimeo[data-player-id="<?= $rand; ?>"]').removeClass('slider-video-play');
                               $('.js-a1xploretv-d-start-vimeo[data-player-id="<?= $rand; ?>"]').removeClass('a1xploretv-d-pause');
                               $('.js-a1xploretv-d-start-vimeo[data-player-id="<?= $rand; ?>"]').addClass('a1xploretv-d-play');
                               $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 1);
                           });


                    </script>
                <?php } else { ?>
                    <div class="a1xploretv-main-wrapper-inner">
                        <div class="h1 text-white h-bold"><?= $all_data['headline'] ?></div>
                        <h3 class="text-white mb-5">
                            <?= nl2br($all_data['copytext']) ?>
                        </h3>
                        <a href="javascript:void(0)"  id="js-a1xploretv-d-start" data-player-id="<?= $rand; ?>" class="a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start loc-video"></a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>

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
    <?php
}
