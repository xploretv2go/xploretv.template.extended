<?php
// Section E - Image Slider with Detail Card
function content_element_section_e($all_data, $section_index) {
    ?>
    <!-- section_e -->
    <section  id="section_<?= $section_index ?>" class="a1xploretv-l px-0">
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
