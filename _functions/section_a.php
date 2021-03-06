<?php
// Section A - Full width card with optional background image
function content_element_section_a($all_data, $section_index) {
    $class = $all_data['full-height'] ? 'full-height' : '';
    ?>
    <!-- section_a -->
    <section id="section_<?= $section_index ?>" class="xploretv-a <?= $class ?>" style="background-image:url('<?= $all_data['background-image']['url'] ?>');">
        <div class="mx-auto d-flex flex-column justify-content-center align-items-center text-center h-100">
            <div class="xploretv-main-wrapper-inner">
                <div class="h1 <?= (!empty($all_data['background-image']['url'])) ? 'text-white' : '' ?> h-bold"><?= $all_data['headline'] ?></div>
                <div class="mt-1">
                    <h3 class="<?= (!empty($all_data['background-image']['url'])) ? 'text-white' : '' ?> mb-5">
                        <?php if (empty($all_data['button-label'])) { ?> <a href="" class="focusable" style="opacity: 0;">.</a> <?php } ?>
                        <?= $all_data['copytext'] ?>
                    </h3>
                    <?php if ($all_data['button-label']) { ?>
                      <a
                        href="<?= parseLink($all_data['button-href']) ?>"
                        class="button xploretv-icon arrowright focusable"><?= $all_data['button-label'] ?></a>
                    <?php } ?>
                    <?php if ($all_data['scroll_indicator'] && $all_data['full-height'] === true) { ?>
                        <img src="<?php echo get_theme_file_uri() ?>/images/arrow.png" alt="" class="scroll-indicator jump" />
                    <?php } ?>
                </div>
            </div>
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
?>
