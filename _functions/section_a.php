<?php
// Section A - Full width card with optional background image
function content_element_section_a($all_data, $section_index) {
    $class = $all_data['full-height'] ? 'a1xploretv-c' : 'a1xploretv-a';
    ?>
    <!-- section_a -->
    <section id="section_<?= $section_index ?>" class="<?= $class ?>" style="background-image:url('<?= $all_data['background-image']['url'] ?>');">
        <div class="mx-auto d-flex flex-column justify-content-center align-items-center text-center h-100 pt-5 pb-2 <?php if (empty($all_data['button-href'])) { ?>focusable<?php } ?>">
            <div class="a1xploretv-main-wrapper-inner">
                <div class="h1 <?= (!empty($all_data['background-image']['url'])) ? 'text-white' : '' ?> h-bold"><?= $all_data['headline'] ?></div>
                <div class="mt-1">
                    <h3 class="<?= (!empty($all_data['background-image']['url'])) ? 'text-white' : '' ?> mb-5">
                        <?= $all_data['copytext'] ?>
                    </h3>
                    <?php if ($all_data['button-label']) { ?>
                      <a
                        href="<?= parseLink($all_data['button-href']) ?>"
                        class="button a1xploretv-icon arrowright focusable"><?= $all_data['button-label'] ?></a>
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
