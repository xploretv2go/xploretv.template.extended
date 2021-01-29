<?php
require_once(explode("wp-content", __FILE__)[0] . "wp-load.php");

/**
 * Search for a pattern in a string and replace it with the home URL of the website.
 *
 * @param string  $url
 * @param string  $search_pattern   Defaults is '#homeurl#'
 * @return string
 */
function parseLink($url, $search_pattern = '#homeurl#') {
  $replace = get_home_url();
  if (strpos($url, $search_pattern) !== false) {
    $url = str_replace($search_pattern, $replace, $url);
  }
  return $url;
}

// Section A - Full width card with optional background image
function content_element_section_a($all_data) {
    $class = $all_data['full-height'] ? 'a1xploretv-c' : 'a1xploretv-a';
    ?>
    <section id="a1xploretv-c" class="<?= $class ?> " style="background-image:url('<?= $all_data['background-image']['url'] ?>');">
        <div class="w-50 mx-auto d-flex flex-column justify-content-center align-items-center text-center h-100 pt-5 pb-2">
            <div class="h1 <?= (!empty($all_data['background-image']['url'])) ? 'text-white' : '' ?> h-bold"><?= $all_data['headline'] ?></div>
            <div class="mt-1">
                <h3 class="<?= (!empty($all_data['background-image']['url'])) ? 'text-white' : '' ?> mb-5">
                    <?= nl2br($all_data['copytext']) ?>
                </h3>
                <?php if ($all_data['button-label']) { ?>
                  <a id="a1xploretv-c-btn1" href="<?= parseLink($all_data['button-href']) ?>" class="button a1xploretv-icon arrowright focusable"><?= $all_data['button-label'] ?></a>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php
}

// Section B - Slider Big
function content_element_section_b($all_data) {
    ?>
    <section class="a1xploretv-k px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
            <h3><?= nl2br($all_data['copytext']) ?></h3>
        </div>
        <div id="js-a1xploretv-k-slider" class="a1xploretv-k-slider js-a1xploretv-k-slider">
          <?php foreach ($all_data['cards'] as $card) { ?>
            <a href="<?= parseLink($card['card-href']) ?>" class="focusable">
                <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
                <?= $card['copytext'] ?>
            </a>
          <?php } ?>
        </div>
    </section>
    <?php
}

// Section C - 2 Column Text an Image
function content_element_section_c($all_data) {
    ?>
    <section id="a1xploretv-g" class="a1xploretv-g bg-white">
        <div class="a1xploretv-g-container h-100">
            <div class="d-flex align-items-center text-center h-100 ">
                <div id="a1xploretv-g-btn1" class="a1xploretv-g-left focusable">
                    <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                    <?= $all_data['copy'] ?>

                    <?php
                      if ($all_data['button-label']) {
                    ?>
                    <p>
                      <a href="<?= parseLink($all_data['button-href']) ?>" class="button a1xploretv-icon arrowright focusable"><?= $all_data['button-label'] ?></a>
                    </p>
                    <?php
                      }
                    ?>
                    <?php
                      if ($all_data['mobile_app'] == 'yes') {
                    ?>
                    <p class="mt-5 mb-4">Finden Sie unsere App </p>
                    <div class="d-flex justify-content-center">
                        <a id="a1xploretv-g-btn1" href="https://play.google.com/" class="mr-3">
                            <img src="/wp-content/themes/<?php echo get_template(); ?>/images/google-play-smarthome.png" alt="Google Play" />
                        </a>
                        <a id="a1xploretv-g-btn2" href="https://www.apple.com/app-store/"  class="">
                            <img src="/wp-content/themes/<?php echo get_template(); ?>/images/apple-app-smarthome.png" alt="Apple Store" />
                        </a>
                    </div>
                    <?php
                      }
                    ?>
                </div>
                <div class="a1xploretv-g-right">
                    <img src="<?= $all_data['image']['url'] ?>" alt="<?= $all_data['image']['alt'] ?>">
                </div>
            </div>
        </div>
    </section>

    <?php
}

// Section D - Full width video
function content_element_section_d($all_data) {
    $rand = rand(10, 99);
    ?>
    <section class="a1xploretv-d a1xploretv-video-section">
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

            <div class="h1 <?php if ($all_data['video-provider'] == 'local-video' || $all_data['video-provider'] == 'stream') { ?> text-white <?php } ?>h-bold"><?= $all_data['headline'] ?></div>

            <div class="mt-1">

                <?php if ($all_data['video-provider'] == 'youtube') { ?>
                    <h3 class="mb-5">
                        <?= nl2br($all_data['copytext']) ?>
                    </h3>
                    <div class="video-container">
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
                    <div class="video-container focusable">
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
                    <h3 class="text-white mb-5">
                        <?= nl2br($all_data['copytext']) ?>
                    </h3>
                    <a href="javascript:void(0)"  id="js-a1xploretv-d-start" data-player-id="<?= $rand; ?>" class="a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start loc-video"></a>
                <?php } ?>

            </div>
        </div>
    </section>
    <?php
}

// Section E - Image Slider with Detail Card
function content_element_section_e($all_data) {
    ?>
    <section class="a1xploretv-l px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
        </div>
        <div id="js-a1xploretv-l-slider" class="a1xploretv-l-slider js-a1xploretv-l-slider">
            <?php
              $num = 0;
              foreach ($all_data['cards'] as $card) {
            ?>

            <div class="product" id="<?= $num ?>" >
                <img <?php if ($num === 0) { ?> id="set-first"<?php } ?> class="focusable" src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
            </div>

            <?php
                $num++;
              }
            ?>
        </div>
        <div id="productInfo" class="productInfo">
            <?php
              $num = 0;
              foreach ($all_data['cards'] as $card) {
            ?>
            <div id='<?= $num ?>'>
                <div class="productInfo-title"><?= $card['headline'] ?></div>
                <?= $card['copytext'] ?>
            </div>
            <?php
                $num++;
              }
            ?>
        </div>

    </section>

    <?php
}

// Section F - Selection/Decision Element
function content_element_section_f($all_data) {
    $class_div = $all_data['full-width'] ? '' : 'full-width';
    $class_section = $all_data['full-width'] ? '' : 'h-auto';
    ?>
    <section id="a1xploretv-f" class="a1xploretv-f <?= $class_section ?>">
        <div class="d-flex flex-column justify-content-center align-items-center text-center h-100">
            <?php if ($all_data['headline']) { ?>
              <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
            <?php } ?>
            <?php if ($all_data['copytext']) { ?>
              <h3><?= nl2br($all_data['copytext']) ?></h3>
            <?php } ?>
            <div class="a1xploretv-f-container <?= $class_div ?>">
                <div class="text-center h-100">
                  <?php
                    $center_card = floor(count($all_data['cards']) / 2);
                    $num = 0;
                  ?>
                  <?php foreach ($all_data['cards'] as $card) { ?>
                    <?php
                      $my_id = '';
                      if ($num == $center_card) $my_id = 'a1xploretv-f-f-first';
                    ?>

                    <a id="<?= $my_id ?>" href="<?= parseLink($card['href']) ?>" class="a1xploretv-f-box focusable h-100">
                      <span>
                        <?php if (isset($card['image'])) { ?>
                          <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['url'] ?>">
                        <?php } ?>
                        <span class="a1xploretv-f-title h3"><?= $card['headline'] ?></span>
                        <p><?= $card['copytext'] ?></p>
                      </span>
                    </a>
                    <?php $num++; ?>
                  <?php } ?>
                </div>
            </div>
        </div>
    </section>
  <?php
}

// Section G - Form
function content_element_section_g($all_data) {
?>
<section class="a1xploretv-e">
  <div class="a1xploretv-e-textblock text-center w-75">
    <?php if ($all_data['headline']) { ?>
      <h2 class="h1 h-bold"><?= $all_data['headline'] ?></h2>
    <?php } ?>
    <?php if ($all_data['copytext']) { ?>
      <h3><?= nl2br($all_data['copytext']) ?></h3>
    <?php } ?>
  </div>
  <form name="a1xploretv-e-form" method="POST" action="<?= get_template_directory_uri(); ?>/ajax_form_contact.php" autocomplete="off" class="myForm">
    <input name="status_message_success" type="hidden" value="<?= $all_data['status_message_success'] ?>">
    <input name="status_message_receiver" type="hidden" value="<?= seso_encrypt($all_data['receiver']) ?>">
    <input name="status_message_receiver_message" type="hidden" value="<?= $all_data['receiver_message'] ?>">
    <?php
      $receiver_subject = (!empty($all_data['receiver_subject'])) ? $all_data['receiver_subject'] : $all_data['headline'];
    ?>
    <input name="status_message_receiver_subject" type="hidden" value="<?= $receiver_subject ?>">
    <div class="a1xploretv-e-inner mx-auto">
      <div class="a1xploretv-e-form">
        <?php
          foreach ($all_data['form_elements'] as  $form_element){
            if ($form_element['type'] == 'input') {
              ?>
              <div class="form-group">
                <input type="text" name="<?= $form_element['name'] ?>" class="js-a1xploretv-e-form-field form-control focusable" placeholder="<?= $form_element['label'] ?><?= ($form_element['required']) ? ' *' : ''?>" autocomplete="off" <?= ($form_element['required']) ? 'required' : ''?>>
              </div>
              <?php
            } else if ($form_element['type'] == 'radio') {
              ?>
              <div class="a1xploretv-e-radio-group">
                <p class="a1xploretv-e-radio-label"><?= $form_element['label'] ?></p>
                <div class="a1xploretv-e-checkboxes radio">
                  <?php
                    $num = 0;
                    foreach ($form_element['values'] as $element_value) {
                      ?>
                      <label class="a1xploretv-e-checkbox js-a1xploretv-e-form-field focusable" tabindex="-1">
                        <input type="checkbox" value="<?= $element_value['value'] ?>" name="<?= $form_element['name'] ?>" <?= ($num == 0) ? 'checked' : '' ?>>
                        <span class="a1xploretv-e-checkbox-ui-bg" ></span>
                        <span class="a1xploretv-e-checkbox-ui" ></span>
                        <span class="a1xploretv-e-checkbox-text"><?= $element_value['value'] ?></span>
                      </label>
                      <?php
                      $num++;
                    }
                  ?>
                </div>
              </div>
              <?php
            } else if ($form_element['type'] == 'checkbox') {
              ?>
              <div class="a1xploretv-e-checkbox-group">
                <p class="a1xploretv-e-radio-label"><?= $form_element['label'] ?></p>
                <div class="a1xploretv-e-checkboxes">
                  <?php
                    foreach ($form_element['values'] as $element_value) {
                      ?>
                      <label class="a1xploretv-e-checkbox js-a1xploretv-e-form-field focusable" tabindex="-1">
                        <input type="checkbox" value="<?= $element_value['value'] ?>" name="<?= $form_element['name'] ?>[]">
                        <span class="a1xploretv-e-checkbox-ui-bg" ></span>
                        <span class="a1xploretv-e-checkbox-ui" ></span>
                        <span class="a1xploretv-e-checkbox-text"><?= $element_value['value'] ?></span>
                      </label>
                      <?php
                    }
                  ?>
                </div>
              </div>
              <?php
            }
          }
        ?>
      </div>
      <div class="a1xploretv-e-form-btns ">
        <button type="submit" class="btn btn-block btn-outline-primary js-a1xploretv-e-form-field focusable">
          <span><?= $all_data['submit_button_title'] ?></span>
          <span class="a1xploretv-icon arrow-right"></span>
        </button>
      </div>
    </div>
  </form>
  <div class="a1xploretv-e-textblock text-center response">

  </div>
</section>

<?php
}

// Section H - Survey
function content_element_section_h($all_data) {
?>
  <section class="a1xploretv-e">
    <div class="a1xploretv-e-textblock text-center mb-60px w-75">
      <?php if ($all_data['headline']) { ?>
        <h2 class="h1 h-bold"><?= $all_data['headline'] ?></h2>
      <?php } ?>
      <?php if ($all_data['copytext']) { ?>
        <h3><?= nl2br($all_data['copytext']) ?></h3>
      <?php } ?>
    </div>
    <form name="a1xploretv-e-form" method="POST" action="<?= get_template_directory_uri(); ?>/ajax_form_survey.php" autocomplete="off" class="myForm">
      <input name="status_message_success" type="hidden" value="<?= $all_data['status_message_success'] ?>">
      <input name="status_message_receiver" type="hidden" value="<?= seso_encrypt($all_data['receiver']) ?>">
      <input name="status_message_receiver_message" type="hidden" value="<?= $all_data['receiver_message'] ?>">
      <?php
        $receiver_subject = (!empty($all_data['receiver_subject'])) ? $all_data['receiver_subject'] : $all_data['headline'];
      ?>
      <input name="status_message_receiver_subject" type="hidden" value="<?= $receiver_subject ?>">
      <div class="a1xploretv-e-inner mx-auto">
        <div class="a1xploretv-e-form">
          <?php
            foreach ($all_data['form_elements'] as  $form_element){
              if ($form_element['type'] == 'input') {
                ?>
                <div class="form-group">
                  <input type="text" name="<?= $form_element['name'] ?>" class="form-control focusable" placeholder="<?= $form_element['label'] ?><?= ($form_element['required']) ? ' *' : ''?>" autocomplete="off" <?= ($form_element['required']) ? 'required' : ''?>>
                </div>
                <?php
              } else if ($form_element['type'] == 'radio') {
                ?>
                <div class="a1xploretv-e-radio-group">
                  <p class="a1xploretv-e-radio-label"><?= $form_element['label'] ?></p>
                  <div class="a1xploretv-e-checkboxes radio">
                    <?php
                      $num = 0;
                      foreach ($form_element['values'] as $element_value) {
                        ?>
                        <label class="a1xploretv-e-checkbox js-a1xploretv-e-form-field focusable" tabindex="-1">
                          <input type="checkbox" value="<?= $element_value['value'] ?>" name="<?= $form_element['name'] ?>" <?= ($num == 0) ? 'checked' : '' ?>>
                          <span class="a1xploretv-e-checkbox-ui-bg" ></span>
                          <span class="a1xploretv-e-checkbox-ui" ></span>
                          <span class="a1xploretv-e-checkbox-text"><?= $element_value['value'] ?></span>
                        </label>
                        <?php
                        $num++;
                      }
                    ?>
                  </div>
                </div>
                <?php
              } else if ($form_element['type'] == 'checkbox') {
                ?>
                <div class="a1xploretv-e-checkbox-group">
                  <p class="a1xploretv-e-radio-label"><?= $form_element['label'] ?></p>
                  <div class="a1xploretv-e-checkboxes">
                    <?php
                      foreach ($form_element['values'] as $element_value) {
                        ?>
                        <label class="a1xploretv-e-checkbox js-a1xploretv-e-form-field focusable" tabindex="-1">
                          <input type="checkbox" value="<?= $element_value['value'] ?>" name="<?= $form_element['name'] ?>[]">
                          <span class="a1xploretv-e-checkbox-ui-bg" ></span>
                          <span class="a1xploretv-e-checkbox-ui" ></span>
                          <span class="a1xploretv-e-checkbox-text"><?= $element_value['value'] ?></span>
                        </label>
                        <?php
                      }
                    ?>
                  </div>
                </div>
                <?php
              }
            }
          ?>
        </div>
        <div class="a1xploretv-e-form-btns">
          <button type="submit" class="btn a1xploretv-icon arrowright btn-block btn-outline-primary js-a1xploretv-e-form-field focusable">
            <span><?= $all_data['submit_button_title'] ?></span>
            <span class="a1xploretv-icon arrow-right"></span>
          </button>
        </div>
      </div>
    </form>
    <div class="a1xploretv-e-textblock text-center response">

    </div>
  </section>
<?php
}

// Section I - Streaming element
function content_element_section_i($all_data) {
?>
  TODO
<?php
}

// Section J - Cheat Codes
function content_element_section_j($all_data) {
?>
  <script>
    var urls = {};
    <?php
      foreach($all_data['repeater'] as $mapping) {
        echo "urls[" . $mapping['key'] . "] = '" . $mapping['url'] . "';\n";
      }
    ?>
    const action_keys = {48:"0", 49:"1", 50:"2", 51:"3", 52:"4", 53:"5", 54:"6", 55:"7", 56:"8", 57:"9"};
    window.onkeydown = function(my_key) {
      // Prevent redirect if active element is an input field or a text area
      if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
        return false;
      }
      if (action_keys[my_key.keyCode]) {
        if (urls[action_keys[my_key.keyCode]]) {
          location.href = urls[action_keys[my_key.keyCode]];
        } else {
          console.log('No URL found for key ' + action_keys[my_key.keyCode] + '.');
          return false;
        }
      } else {
        return false;
      }
    }
  </script>
<?php
}


// Section K - Youtube/Vimeo video slider
function content_element_section_k($all_data) {
    ?>
    <section class="a1xploretv-k px-0 a1xploretv-k-video-slider">

        <div id="js-a1xploretv-k-slider" class="a1xploretv-k-slider js-a1xploretv-k-slider">
           <?php
           foreach ($all_data['videos'] as $item) {
                $rand = rand(10,99);
                   $imgid = $item['video_id'];
               ?>
               <?php if($item['video_provider'] == 'Vimeo'):?>
               <div class="video-container focusable">
                   <div class="h1 h-bold"><?= $item['video_headline']; ?></div>
                   <h4><?= $item['video_content']; ?></h4>
                   <div class="position-relative mb-3 ">
                       <div class="vimeo-poster" data-player-id="<?= $rand; ?>" style="background-image:url('<?= $item['video_poster']['url']; ?>')"></div>
                       <iframe id="player-vimeo<?= $rand; ?>" src="https://player.vimeo.com/video/<?= $imgid; ?>" class="a1xploretv-video-frame-yt mt-1 js-vimeo-player" allow="autoplay" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                   </div>
                   <a href="javascript:void(0)" data-player-id="<?= $rand; ?>" onclick="playVideoVimeo<?= $rand ?>(this);" class="js-video-global-pause a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start-vimeo"></a>
                   <!-- <a href="javascript:void(0)" data-player-id="<?= $rand; ?>" onclick="pauseVideoVimeo<?= $rand ?>();" class="a1xploretv-d-pause focusable js-a1xploretv-d-pause-vimeo"></a> -->

                   <script>
                       var iframe_vimeo = document.getElementById("player-vimeo<?= $rand; ?>");
                       var player_vimeo<?= $rand ?> = new Vimeo.Player(iframe_vimeo);
                         function playVideoVimeo<?= $rand ?>(e) {

                             if(e.classList.contains('slider-video-play')){
                                 player_vimeo<?= $rand ?>.pause();
                                 e.classList.remove('slider-video-play');
                                 e.classList.remove('a1xploretv-d-pause');
                                 e.classList.add('a1xploretv-d-play');
                                 $('.vimeo-poster[data-player-id="<?= $rand; ?>"]').fadeTo("fast", 1);

                             } else {
                                  player_vimeo<?= $rand ?>.play();
                                  e.classList.add('slider-video-play');
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
               </div>
           <?php else :?>
               <div class="video-container focusable">
                   <div class="h1 h-bold"><?= $item['video_headline']; ?></div>
                   <h4><?= $item['video_content']; ?></h4>
                   <div class="position-relative mb-3 ">
                       <div class="yt-poster" data-id="player<?= $rand ?>" style="background-image: url('<?= $item['video_poster']['url']; ?>')"></div>
                       <div id="player<?= $rand; ?>" data-num="<?= $rand; ?>" data-src="<?= $imgid; ?>" class="js-yt-video-frame a1xploretv-video-frame-yt mt-1"></div>
                   </div>
                   <a data-id="player<?= $rand ?>" href="javascript:void(0)" onclick="playVideoYT<?= $rand ?>(this);" class="js-video-global-pause js-video-slider-btn a1xploretv-d-play mx-auto focusable js-a1xploretv-d-start"></a>
               </div>
           <?php endif;?>
           <?php } ?>
           <?php // for each ?>
        </div>
    </section>
    <?php
}
