<?php
// Section B - Slider Big
function content_element_section_b($all_data, $section_index) {
    ?>
    <!-- section_b -->
    <section id="section_<?= $section_index ?>" class="xploretv-b px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="xploretv-main-wrapper-inner text-center">
                <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                <h3><?= $all_data['copytext'] ?></h3>
            </div>
        </div>
        <div class="xploretv-b-slider js-xploretv-b-slider">
          <?php foreach ($all_data['cards'] as $card) { ?>
            <a href="<?= parseLink($card['card-href']) ?>" class="focusable">
                <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
                <div>
                    <?php if (!empty($card['subheadline'])) { ?><h3 class="h3"><?= $card['subheadline'] ?></h3><?php } ?>
                    <?php if (!empty($card['copytext'])) { ?><?= $card['copytext'] ?><?php } ?>
                </div>
            </a>
          <?php } ?>
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
