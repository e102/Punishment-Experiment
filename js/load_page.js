function load_page(minDelayInSeconds, maxDelayInSeconds) {
    var random_delay_in_milliseconds = Math.floor((Math.random() * maxDelayInSeconds) + minDelayInSeconds);
    setTimeout(load_page_now, random_delay_in_milliseconds * 1000);

    function load_page_now() {
        change_element_style("display_before_load", "none");
        change_element_style("display_after_load", "inline");

        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining:" + player_starting_ECU;


        function change_element_style(className, style) {
            var elements_array = document.getElementsByClassName(className);
            for (var i = 0; i < elements_array.length; i++) {
                elements_array[i].style.display = style;
            }
        }
    }
}