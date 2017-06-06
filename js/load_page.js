function load_page(minDelayInSeconds, maxDelayInSeconds) {
    var random_delay_in_milliseconds = Math.floor((Math.random() * maxDelayInSeconds) + minDelayInSeconds);
    setTimeout(load_page_now, random_delay_in_milliseconds * 1000);

    function load_page_now() {
        var before_load_array = document.getElementsByClassName("display_before_load");
        for (var i = 0; i < before_load_array.length; i++) {
            console.log(before_load_array[i].name);
            before_load_array[i].style.display = "none";
        }

        var after_load_array = document.getElementsByClassName("display_after_load");
        for (var j = 0; j < after_load_array.length; j++) {
            after_load_array[i].style.display = "inline";
        }

        document.getElementById("starting_ECUs").innerHTML = "ECUs this round:" + player_starting_ECU;
        document.getElementById("ECUs_kept").innerHTML = "ECUs remaining after your punishments/rewards:" + player_starting_ECU;
    }
}