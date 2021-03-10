<?php
// Section E - Image Slider with Detail Card
function content_element_section_e($all_data, $section_index) {
    ?>
    <!-- section_e -->
    <section  id="section_<?= $section_index ?>" class="xploretv-e px-0">
        <div class="d-flex flex-column justify-content-center align-items-center mb-4">
            <div class="h1 h-bold"><?= $all_data['headline'] ?></div>
        </div>
        <div id="js-xploretv-e-slider" class="xploretv-e-slider js-xploretv-e-slider">
            <?php
              $num = 0;
              foreach ($all_data['cards'] as $card) {
            ?>

            <div class="product" id="<?= $num ?>" >
                <img <?php if ($num === 0) { ?> id="set-first"<?php } ?> class="focusable img-fluid" src="<?= $card['image']['url'] ?>" alt="<?= $card['image']['alt'] ?>">
            </div>

            <?php
                $num++;
              }
            ?>
        </div>
        <div class="product-info">
            <?php
              $num = 0;
              foreach ($all_data['cards'] as $card) {
            ?>
            <div id='<?= $num ?>'>
                <div class="product-info-title"><?= $card['headline'] ?></div>
                <?= $card['copytext'] ?>
            </div>
            <?php
                $num++;
              }
            ?>
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
