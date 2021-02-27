<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage XploreTV_SmartHome
 * @since XploreTV Smart Home 1.0
 */

?>
    	<!--
    	<footer>
    		Footer content goes here
    	</footer>
    	-->

		<?php wp_footer(); ?>
        <script>
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            var playerInfoList = [];
            var players = [];

            var item = $('.js-yt-video-frame');
            $(item).each(function(i, obj){
                var player = $(this).attr('id');
                var num = $(this).attr('data-num');
                var videoId = $(this).attr('data-src');

                playerInfoList.push({id:player, videoId:videoId, num:num});
            });

            function onYouTubeIframeAPIReady() {
                if (typeof playerInfoList === 'undefined') { return };

                for (var i = 0; i < playerInfoList.length; i++) {
                    var curplayer = createPlayer(playerInfoList[i]);
                    players[i] = curplayer;
                }
            }

            function createPlayer(playerInfoList) {
                return new YT.Player(playerInfoList.id, {
                    videoId: playerInfoList.videoId,
                    playerVars: {
                       mute: 0,
                       autoplay: 0,
                       controls: 0,
                       autohide: 1,
                       wmode: "opaque",
                       showinfo: 0,
                       loop: 0,
                       rel: 0,
                       //origin: 'http://xploretv-smarthome.apptank.at'
                       origin: '<?php echo WP_HOME ?>'
                     }
                });
             }

            // Functions
            setTimeout(function(){
                for (var i = 0; i < playerInfoList.length; i++) {
                    var functionPlay = "playVideoYT"+playerInfoList[i].num;
                    window[functionPlay] = function(e) {
                        $(players).each(function (i) {
                            if(this.h.id == $(e).attr('data-id')){

                                if(e.classList.contains('js-video-slider-btn')){
                                    if(e.classList.contains('slider-video-play')){
                                        this.pauseVideo();
                                        e.classList.remove('slider-video-play');
                                        e.classList.remove('a1xploretv-d-pause');
                                        e.classList.add('a1xploretv-d-play');
                                        $('.yt-poster[data-id="'+this.h.id+'"]').fadeTo("fast", 1);
                                    } else {
                                         this.playVideo();
                                         e.classList.add('slider-video-play');
                                         //e.classList.add('a1xploretv-d-pause');
                                         e.classList.remove('a1xploretv-d-play');
                                         $('.yt-poster[data-id="'+this.h.id+'"]').fadeTo("fast", 0);
                                    }
                                }else {
                                    this.playVideo();
                                }
                            }
                        });
                    };

                    var functionPause = "pauseVideoYT"+playerInfoList[i].num;
                    window[functionPause] = function() {
                        $(players).each(function (i) {
                            if(this.h.id == $(e).attr('data-id')){
                                this.pauseVideo();
                            }
                        });
                    };
                }
            }, 500);
        </script>
	</body>
</html>
