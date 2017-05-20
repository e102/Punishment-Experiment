<?php
function check_referring_page($expected_reffering_page_url) {
    $refering_page_url = $_SERVER['HTTP_REFERER'];

    if ($refering_page_url != $expected_reffering_page_url) {
        echo ("
        <script>
        alert('Illegal page access!');
        window.open('index.php','_self')
        </script>
        ");
        die();
    }
}