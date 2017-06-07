function generate_reward_dropdowns(form, player_count, game_number) {
    for (var i = 2; i <= player_count; i++) {
        var player_colour = get_player_colour(i, game_number);

        var player_name_text = document.createElement("p");
        player_name_text.innerHTML = player_colour;
        player_name_text.className = "noEmptyLine";
        player_name_text.style.color = player_colour;
        form.appendChild(player_name_text);

        var punish_or_reward_dropdown = document.createElement("select");
        punish_or_reward_dropdown.id = "punish_or_reward_dropdown_player_" + i;
        punish_or_reward_dropdown.name = "punish_or_reward_dropdown_player_" + i;
        punish_or_reward_dropdown.className = "form-control";
        form.appendChild(punish_or_reward_dropdown);

        var option_no = document.createElement("option");
        option_no.value = "no";
        option_no.innerHTML = "Do nothing";
        punish_or_reward_dropdown.appendChild(option_no);

        var option_reward = document.createElement("option");
        option_reward.value = "reward";
        option_reward.innerHTML = "Reward";
        punish_or_reward_dropdown.appendChild(option_reward);

        var option_punish = document.createElement("option");
        option_punish.value = "punish";
        option_punish.innerHTML = "Punish";
        punish_or_reward_dropdown.appendChild(option_punish);

        var amount_dropdown = document.createElement("select");
        amount_dropdown.id = "amount_dropdown_player_" + i;
        amount_dropdown.name = "amount_dropdown_player_" + i;
        amount_dropdown.className = "form-control";
        form.appendChild(amount_dropdown);

        for (var a = 0; a <= (player_starting_ECU * 2); a += 2) {
            var option = document.createElement("option");
            if (a === 0) {
                option.selected = 'selected';
            }
            option.text = a;
            option.value = a;
            amount_dropdown.add(option);
        }

        show_punish_options(i);
        var x = (function (a) {
            punish_or_reward_dropdown.onchange = function () {
                show_punish_options(a);
                update_ECU_Count(player_count, player_starting_ECU);
            };
        })(i);

        var x = (function (a) {
            amount_dropdown.onchange = function () {
                update_ECU_Count(player_count, player_starting_ECU);
            };
        })(i);

        var br = document.createElement("br");
        form.appendChild(br);
    }

    function show_punish_options(current_player) {
        var punish_or_reward_dropdown = document.getElementById("punish_or_reward_dropdown_player_" + current_player);
        var amount_dropdown = document.getElementById("amount_dropdown_player_" + current_player);

        var selection = punish_or_reward_dropdown.options[punish_or_reward_dropdown.selectedIndex].value;
        if (selection === "punish" || selection === "reward") {
            amount_dropdown.style.display = "inline";
        }
        else {
            amount_dropdown.style.display = "none";
            amount_dropdown.selectedIndex = 0;
        }
    }

    function get_player_colour(player_number, game_number) {
        if (game_number === 1) {
            if (player_number === 1) {
                return "you";
            }
            else if (player_number === 2) {
                return "Green";
            }
            else if (player_number === 3) {
                return "Blue";
            }
            else if (player_number === 4) {
                return "Red";
            }
            else {
                throw "Player number not recognized";
            }
        }

        else if (game_number === 2) {
            if (player_number === 1) {
                return "you";
            }
            else if (player_number === 2) {
                return "Orange";
            }
            else if (player_number === 3) {
                return "Black";
            }
            else if (player_number === 4) {
                return "Purple";
            }
            else {
                throw "Player number not recognized";
            }
        }

        else if (game_number === 3) {
            if (player_number === 1) {
                return "you";
            }
            else if (player_number === 2) {
                return "Brown";
            }
            else if (player_number === 3) {
                return "Grey";
            }
            else if (player_number === 4) {
                return "Pink";
            }
            else {
                throw "Player number not recognized";
            }
        }

        else {
            throw "Game number not recognized!";
        }
    }
}
