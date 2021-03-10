<?php
// Section L - Nuki Debugger
function content_element_section_l($all_data, $section_index) {
    ?>
    <!-- section_l -->
    <section id="section_<?= $section_index ?>" class="xploretv-l">
        <h3>NUKI API</h3>
        <p>Showing response from <a href="https://api.nuki.io/discover/bridges" class="focusable">https://api.nuki.io/discover/bridges</a></p>
        <textarea style="width: 100%; height: 50vh; font-size: 13px; background-color: white; color: black !important;" class="focusable" id="debug_nuki"></textarea>

        <script>
            window.addEventListener('load', function() {

                const detection_url = 'https://api.nuki.io/discover/bridges';
                var request = $.ajax({
                    url: detection_url,
                    method: "GET"
                });

                request.done(function( msg ) {
                    $('#debug_nuki').val(JSON.stringify(msg));
                });

                request.fail(function( jqXHR, textStatus ) {
                    $('#debug_nuki').val( "Request failed: " + textStatus );
                });

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
