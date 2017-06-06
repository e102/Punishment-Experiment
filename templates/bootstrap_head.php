<?php
function echo_head($title_name) {
    echo("
    <head>
    <title>$title_name</title>
    <!-- Latest compiled and minified CSS -->
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
          integrity = 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin = 'anonymous' >

    <link rel = 'stylesheet' type = 'text/css' href = 'styles/custom.css' >
    
    <script type='text/javascript' src='js/load_page.js'></script>


    <meta name = 'viewport' content = 'width = device-width, initial-scale = 1.0' >
    </head>
        ");
}