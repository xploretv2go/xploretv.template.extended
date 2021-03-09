<?php
// Section G - Form
function content_element_section_g($all_data, $section_index) {
?>
<!-- section_g -->
<section id="section_<?= $section_index ?>" class="a1xploretv-e">
    <div class="a1xploretv-e-textblock text-center w-75">
        <?php if ($all_data['headline']) { ?>
            <h2 class="h1 h-bold"><?= $all_data['headline'] ?></h2>
        <?php } ?>
        <?php if ($all_data['copytext']) { ?>
            <h3><?= nl2br($all_data['copytext']) ?></h3>
        <?php } ?>
    </div>
    <form name="a1xploretv-e-form" method="POST" action="<?= get_template_directory_uri(); ?>/ajax_form.php" autocomplete="off" class="myForm">
        <input name="status_message_receiver" type="hidden" value="<?= seso_encrypt($all_data['receiver']) ?>">
        <input name="status_message_receiver_message" type="hidden" value="<?= $all_data['receiver_message'] ?>">
        <?php
            $receiver_subject = (!empty($all_data['receiver_subject'])) ? $all_data['receiver_subject'] : $all_data['headline'];
        ?>
        <input name="status_message_receiver_subject" type="hidden" value="<?= $receiver_subject ?>">
        <div class="a1xploretv-e-inner mx-auto">
            <div class="a1xploretv-e-form">
                <?php
                $input_index = 0;
                foreach ($all_data['form_elements'] as  $form_element) {
                    if ($form_element['type'] == 'input') {
                ?>
                <div class="form-group">
                    <label><?= $form_element['label'] ?><?= ($form_element['required']) ? ' *' : ''?></label>
                    <a class="input-wrapper focusable" href="#"></a>
                    <input
                        type="text"
                        name="<?= $form_element['name'] ?>"
                        class="js-a1xploretv-e-form-field form-control"
                        placeholder=""
                        autocomplete="off"
                        id="input_<?= $section_index ?>_<?= $input_index ++ ?>"
                        <?= ($form_element['required']) ? 'required' : '' ?>
                        <?= (isset($form_element['placeholder']) && isset($GLOBALS['ASMP'][$form_element['placeholder']])) ? 'value="' . $GLOBALS['ASMP'][$form_element['placeholder']] . '"' : '' ?>
                        >
                </div>
                <?php
                    } else if ($form_element['type'] == 'radio' || $form_element['type'] == 'checkbox') {
                ?>
                <div class="<?= ($form_element['type'] == 'radio') ? 'a1xploretv-e-radio-group': 'a1xploretv-e-checkbox-group' ?> <?= ($form_element['required']) ? 'required' : ''?>">
                    <p class="a1xploretv-e-radio-label"><?= $form_element['label'] ?><?= ($form_element['required']) ? ' *' : ''?></p>
                    <p class="has-error hidden">Dieses Feld ist ein Pflichtfeld.</p>
                    <div class="a1xploretv-e-checkboxes <?= ($form_element['type'] == 'radio') ? 'radio': '' ?>">
                        <?php
                            foreach ($form_element['values'] as $element_value) {
                        ?>
                        <label class="a1xploretv-e-checkbox js-a1xploretv-e-form-field focusable" tabindex="-1">
                            <input type="checkbox" value="<?= $element_value['value'] ?>" name="<?= $form_element['name'] ?><?= $form_element['type'] == 'checkbox' ? '[]' : '' ?>">
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
                <button type="submit" class="btn btn-block btn-outline-primary js-a1xploretv-e-form-field focusable">
                    <span><?= $all_data['submit_button_title'] ?></span>
                    <span class="a1xploretv-icon arrow-right"></span>
                </button>
            </div>
        </div>
    </form>
    <div class="a1xploretv-e-textblock text-center response" style="display: none;">
        <div class="a1xploretv-e-textblock-checkicon py-5">
            <img src="/wp-content/themes/<?php echo get_template(); ?>/images/icon_checksmarthome.png"/>
        </div>
        <h3><?= $all_data['status_message_success'] ?></h3>
        <?php if (!empty($all_data['proceed_button_label'])) { ?>
        <p class="mt-4">
            <a href="<?= $all_data['proceed_button_link'] ?>" class="button a1xploretv-icon arrowright focusable"><?= $all_data['proceed_button_label'] ?></a>
        </p>
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