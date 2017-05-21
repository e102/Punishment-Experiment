<?php
function check_referring_page_is_valid($expected_referring_page_1, $expected_referring_page_2, $actual_referring_page) {
    if (!($actual_referring_page == $expected_referring_page_1 || $actual_referring_page == $expected_referring_page_2)) {
        echo("
                <script>
                alert('Illegal page access! Cannot access this page from $actual_referring_page.');
                window.open('index.php','_self')
                </script>
                ");
        die();
    }
}