<?php
// Section H - Zerconf Debugger
function content_element_section_h($all_data, $section_index) {
    ?>
    <!-- section_h -->
    <section id="section_<?= $section_index ?>" class="a1xploretv-h">
        <h3>Zerconf API</h3>
        <p>Showing response from <a href="https://localhost/a1/xploretv/v1/zeroconf" class="focusable">https://localhost/a1/xploretv/v1/zeroconf</a></p>
        <textarea style="width: 100%; height: 50vh; font-size: 13px; background-color: white; color: black !important;" class="focusable"><?php
            $zeroconf_data = @file_get_contents('https://localhost/a1/xploretv/v1/zeroconf');
            /*
            $zeroconf_data = json_decode('[
              {
                "addresses": {
                  "ipv6": "fe80::c27:d753:2693:c39d",
                  "ipv4": "192.168.178.24"
                },
                "name": "resolved-service-name",
                "domainName": "domain",
                "hostName": "service-originator",
                "service": {
                  "type": "_http._tcp.",
                  "subtype": "_universal._sub._ipp._http._tcp.",
                  "port": 631,
                  "txtRecord": {
                    "path": "/getAccess",
                    "product": "(GPL Ghostscript)",
                    "provider": "provider",
                    "version": "1.0"
                  }
                }
              }
            ]');
            */
            var_dump($zeroconf_data);
        ?></textarea>

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
