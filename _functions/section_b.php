<?php
// Section B - Slider Big
function content_element_section_b($all_data, $section_index) {
    ?>
    <!-- section_b -->
    <section id="section_<?= $section_index ?>" class="a1xploretv-k px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="a1xploretv-main-wrapper-inner text-center">
                <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
                <h3><?= $all_data['copytext'] ?></h3>
            </div>
        </div>
        <div id="js-a1xploretv-k-slider" class="a1xploretv-k-slider js-a1xploretv-k-slider">
          <?php foreach ($all_data['cards'] as $card) { ?>
            <a href="<?= parseLink($card['card-href']) ?>" class="focusable">
                <img src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
                <h3><?= $card['subheadline'] ?></h3>
                <div><?= $card['copytext'] ?></div>
            </a>
          <?php } ?>
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
