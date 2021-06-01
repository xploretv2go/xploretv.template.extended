<?php
// Section J - Cheat Codes
function content_element_section_j($all_data, $section_index) {
?>
    <!-- section_j -->
    <script>
        const action_keys = {48:"0", 49:"1", 50:"2", 51:"3", 52:"4", 53:"5", 54:"6", 55:"7", 56:"8", 57:"9"};
        var urls = {};
        <?php
        foreach($all_data['repeater'] as $mapping) {
            echo "urls[" . $mapping['key'] . "] = '" . $mapping['url'] . "';\n";
        }
        ?>
        window.onkeydown = function(my_key) {
            // Only redirect if active element is not an input field or a text area
            if (action_keys[my_key.keyCode]) {
                if (document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                    if (urls[action_keys[my_key.keyCode]]) {
                        location.href = urls[action_keys[my_key.keyCode]];
                    } else {
                        console.log('No URL found for key ' + action_keys[my_key.keyCode] + '.');
                        return false;
                    }
                }
            }
        }
    </script>
<?php
}
