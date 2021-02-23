<?php
// Section J - Cheat Codes
function content_element_section_j($all_data, $section_index) {
?>
    <!-- section_j -->
  <script>
    var urls = {};
    <?php
      foreach($all_data['repeater'] as $mapping) {
        echo "urls[" . $mapping['key'] . "] = '" . $mapping['url'] . "';\n";
      }
    ?>
    const action_keys = {48:"0", 49:"1", 50:"2", 51:"3", 52:"4", 53:"5", 54:"6", 55:"7", 56:"8", 57:"9"};
    window.onkeydown = function(my_key) {
      // Prevent redirect if active element is an input field or a text area
      if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
        return false;
      }
      if (action_keys[my_key.keyCode]) {
        if (urls[action_keys[my_key.keyCode]]) {
          location.href = urls[action_keys[my_key.keyCode]];
        } else {
          console.log('No URL found for key ' + action_keys[my_key.keyCode] + '.');
          return false;
        }
      } else {
        return false;
      }
    }
  </script>
<?php
}
