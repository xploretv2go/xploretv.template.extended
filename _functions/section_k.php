<?php
// Section K - Youtube/Vimeo video slider
function content_element_section_k($all_data, $section_index) {
    ?>
    <!-- section_k -->
    <section id="section_<?= $section_index ?>" class="xploretv-k px-0 xploretv-k-video-slider">

        <div class="xploretv-k-slider js-xploretv-k-slider">
           <?php
           foreach ($all_data['videos'] as $item) {
                $rand = rand(10,99);
                   $imgid = $item['video_id'];
               ?>
               <?php if($item['video_provider'] == 'Vimeo'):?>
                   <a href="javascript:void(0)" data-player-id="<?= $rand; ?>" onclick="playVideoVimeo<?= $rand ?>(this);" class="js-video-global-pause xploretv-d-play mx-auto focusable js-xploretv-d-start-vimeo">
                       <div class="video-container">
                           <div class="h1 h-bold"><?= $item['video_headline']; ?></div>
                           <h4><?= $item['video_content']; ?></h4>
                           <div class="position-relative mb-3 ">
                               <div class="vimeo-poster" data-player-id="<?= $rand; ?>" style="background-image:url('<?= $item['video_poster']['url']; ?>')"></div>
                               <iframe id="player-vimeo<?= $rand; ?>" src="https://player.vimeo.com/video/<?= $imgid; ?>" class="xploretv-video-frame-yt mt-1 js-vimeo-player" allow="autoplay" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                           </div>

                           <script>
                               var iframe_vimeo = document.getElementById("player-vimeo<?= $rand; ?>");
                               var player_vimeo<?= $rand ?> = new Vimeo.Player(iframe_vimeo);
                                 function playVideoVimeo<?= $rand ?>(e) {

                                     if(e.classList.contains('slider-video-play')){
                                         player_vimeo<?= $rand ?>.pause();
                                         e.classList.remove('slider-video-play');
                                         e.classList.remove('xploretv-d-pause');
                                         e.classList.add('xploretv-d-play');
                                         $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 1);

                                     } else {
                                          player_vimeo<?= $rand ?>.play();
                                          e.classList.add('slider-video-play');
                                         // e.classList.add('xploretv-d-pause');
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
                       </div>
                   </a>
               <?php else :?>
                   <a data-id="player<?= $rand ?>" href="javascript:void(0)" onclick="playVideoYT<?= $rand ?>(this);" class="js-video-global-pause js-video-slider-btn xploretv-d-play mx-auto focusable js-xploretv-d-start">
                        <div class="video-container">
                            <div class="h1 h-bold"><?= $item['video_headline']; ?></div>
                            <h4><?= $item['video_content']; ?></h4>
                            <div class="position-relative mb-3 ">
                                <div class="yt-poster" data-id="player<?= $rand ?>" style="background-image: url('<?= $item['video_poster']['url']; ?>')"></div>
                                <div id="player<?= $rand; ?>" data-num="<?= $rand; ?>" data-src="<?= $imgid; ?>" class="js-yt-video-frame xploretv-video-frame-yt mt-1"></div>
                            </div>
                        </div>
                   </a>
               <?php endif;?>
           <?php } ?>
           <?php // for each ?>
        </div>
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
