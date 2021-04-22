<?php
// Section M - ASMP Debugger
function content_element_section_m($all_data, $section_index) {
    ?>
    <!-- section_m -->
    <section id="section_<?= $section_index ?>" class="xploretv-m">
        <h3>ASMP Debugger</h3>
        <p>Available ASMP data as set in $GLOBALS['ASMP'].</p>
        <textarea style="width: 100%; height: 50vh; font-size: 13px; background-color: white; color: black !important;" class="focusable" id="debug_nuki">
            <?php
                var_dump($GLOBALS['ASMP']);
            ?>
        </textarea>
    </section>
    <?php
}
