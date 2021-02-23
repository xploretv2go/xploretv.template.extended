<?php
// Section F - Selection/Decision Element
function content_element_section_f($all_data, $section_index) {
    $class_div = $all_data['full-width'] ? '' : 'full-width';
    $class_section = $all_data['full-width'] ? '' : 'h-auto';
    ?>
    <!-- section_f -->
    <section id="section_<?= $section_index ?>" class="a1xploretv-f <?= $class_section ?>">
        <div class="d-flex flex-column justify-content-center align-items-center text-center w-100 h-100">
            <div class="a1xploretv-main-wrapper-inner">
              <?php if ($all_data['headline']) { ?>
                <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
              <?php } ?>
              <?php if ($all_data['copytext']) { ?>
                <h3><?= $all_data['copytext'] ?></h3>
              <?php } ?>
            </div>
            <div class="a1xploretv-f-container <?= $class_div ?>">
                <div class="text-center">
                  <?php
                    $center_card = floor(count($all_data['cards']) / 2);
                    $num = 1;
                  ?>
                  <?php foreach ($all_data['cards'] as $card) { ?>
                    <a
                      href="<?= parseLink($card['href']) ?>"
                      class="a1xploretv-f-box focusable h-100 <?= ($num == 1) ? 'first' : '' ?>"
                      style="vertical-align: <?= $card['alignment'] ?>">
                      <span>
                        <?php if ($card['image'] !== false) { ?>
                          <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
                        <?php } ?>
                        <div class="a1xploretv-f-title h3"><?= $card['headline'] ?></div>
                        <div><?= $card['copytext'] ?></div>
                      </span>
                    </a>
                    <?php
                    if($num % 4 == 0) {
                        echo '</div><div class="text-center">';
                    }

                    $num++;
                    ?>

                  <?php } ?>

                </div>
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
