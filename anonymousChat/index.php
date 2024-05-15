<!DOCTYPE html>
<html>
<head>
    <title>Anonymously Chat</title>
    <style type="text/css">
        @font-face {
            font-family: headFont;
            src: url(ui/fonts/airstrike.ttf);
        }

        @font-face {
            font-family: mainFont;
            src: url(ui/fonts/Arial.ttf);
        }

        #wrapper {
            max-width: 900px;
            min-height: 500px;
            display: flex;
            margin: auto;
            color: black;
            font-size: 13px;
            font-family: mainFont;
        }

        #left_panel {
            min-height: 500px;
            background-color: lightgray;
            flex: 1;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        #profile_image {
            width: 150px; /* Fixed width for the profile image */
            height: 150px; /* Adjust height accordingly to maintain aspect ratio */
            border: solid thin white;
            border-radius: 50%;
            margin: 10px;
        }

        .panel_label {
            width: 100%;
            height: 40px; /* Fixed height for the labels */
            display: block;
            background-color: #ffffff55;
            border-bottom: solid thin white;
            cursor: pointer;
            padding: 5px;
            transition: all 0.5s ease;
        }

        .panel_label:hover {
            background-color: #ffffff;
        }

        .panel_label img {
            float: right;
            width: 30px;
            height: auto;
        }

        #right_panel {
            display: flex;
            flex-direction: column;
            min-height: 500px;
            background-color: whitesmoke;
            flex: 4;
            text-align: center;
        }

        #header {
            background-color: gray;
            height: 70px;
            font-size: 40px;
            text-align: center;
            font-family: headFont;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        #container {
            display: flex;
            position: relative;
            flex: 1;
        }

        #inner_left_panel {
            background-color: whitesmoke;
            flex: 1;
            min-height: 430px;
        }

        #inner_right_panel {
            flex: 1;
            min-height: 430px;
        }

        #inner_right_panel {
            background-color: whitesmoke;
            flex: 0; /* Initially set to 0 */
            display: none; /* Initially hidden */
        }

        #radio_chat,
        #radio_contacts,
        #radio_signout {
            display: none; /* Hide radio buttons */
        }

        #radio_chat:checked ~ #container #inner_right_panel {
            display: block; /* Show when radio_chat is checked */
            flex: 10;
        }

        #radio_contacts:checked ~ #container #inner_left_panel {
            display: block; /* Show when radio_contacts is checked */
            flex: 10;
        }

    </style>
</head>
<body>
    <div id="wrapper">
        <div id="left_panel">
            <div id="user_info" style="padding: 10px;">
                <img id="profile_image" src="ui/images/catt.png">
                <br>
                <span id="username"> Username </span>
                <br>
                <span id="id" style="font-size: 12px; opacity: 0.5;">id</span>
                <br>
                <br>
                <div>
                    <label class="panel_label" id="label_chat" for="radio_chat">Chat <img src="ui/icons/chats.png"></label>
                    <label class="panel_label" id="label_contacts" for="radio_contacts">Contacts <img src="ui/icons/contacts.png"></label>
                    <label class="panel_label" id="label_signout" for="radio_signout">Sign Out <img src="ui/icons/signout.png"></label>
                </div>
            </div>
        </div>
        <div id="right_panel">
            <div id="header">Anonymously Chat...</div>
            <div id="container">
                <div id="inner_left_panel" style="display: none;"></div>
                <div id="inner_right_panel" style="display: none;"></div>
                <input type="radio" id="radio_chat" name="main_radio">
                <input type="radio" id="radio_contacts" name="main_radio">
                <input type="radio" id="radio_signout" name="main_radio">
            </div>
        </div>
    </div>

    <script>
        var obj = {}; // Define obj globally

        document.getElementById("label_chat").addEventListener("click", function() {
            document.getElementById("header").textContent = "Chat";
            document.getElementById("inner_right_panel").style.display = "none"; // Hide settings panel
            document.getElementById("inner_left_panel").style.display = "block"; // Show chat panel
        });

        document.getElementById("label_contacts").addEventListener("click", function() {
            document.getElementById("header").textContent = "Contacts";
            document.getElementById("inner_right_panel").style.display = "none"; // Hide settings panel
            document.getElementById("inner_left_panel").style.display = "block"; // Show contact list panel
        });

        document.getElementById("label_signout").addEventListener("click", function() {
            document.getElementById("header").textContent = "Signing Out...";
            window.location.href = 'logout.php'; // Redirect to logout.php
        });

        function handle_result(result, type) {
            if (result.trim() != "") {
                var result = JSON.parse(result);
                obj.logged_in = result.logged_in; // Set the value of obj.logged_in
                if (!obj.logged_in) {
                    window.location = "login.php";
                } else {
                    // Your code for handling logged in user
                    // For now, let's just log the result
                    alert(result);
                }
            }
        }

        function get_data(find, type) {
            var xml = new XMLHttpRequest();
            xml.onload = function() {
                if (xml.readyState == 4 || xml.status == 200) {
                    handle_result(xml.responseText, type);
                }
            }

            var data = {};
            data.find = find;
            data.data_type = type;
            var data = JSON.stringify(data);

            xml.open("POST", "api.php", true);
            xml.send(data);
        }

        get_data({}, "user_info");
    </script>