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

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
            font-family: mainFont;
        }

        #wrapper {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
            text-align: center;
        }

        #header {
            background-color: gray;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            font-size: 30px;
            font-family: headFont;
            color: white;
        }

        form {
            margin-top: 20px;
        }

        input[type=text], input[type=password], input[type=submit], button {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: solid 1px grey;
            font-size: 14px;
        }

        input[type=submit], button {
            cursor: pointer;
            background-color: #535d68;
            color: whitesmoke;
            border: none;
            font-size: 16px;
        }

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-container input[type=password] {
            width: 100%;
            padding-right: 40px;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            color: #888;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            Anonymously Chat
        </div>
        <form id="loginForm" method="post" action="log.in.php">
            <input type="text" name="username" placeholder="Username" id="loginUsername" required>
            <div class="password-container">
                <input type="password" name="password" placeholder="Password" id="loginPassword" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('loginPassword')">👁</span>
            </div>
            <input type="submit" value="Login" id="login">
        </form>
        <div class="center">
            <button id="signupButton" onclick="location.href='signup.php'">Sign Up</button>
        </div>
    </div>

    <script type="text/javascript">
        function togglePasswordVisibility(id) {
            var passwordField = document.getElementById(id);
            var passwordType = passwordField.getAttribute("type");
            if (passwordType === "password") {
                passwordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
            }
        }

        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var username = document.getElementById("loginUsername").value.trim();
            var password = document.getElementById("loginPassword").value.trim();

            if (username === "") {
                alert("Username is required!");
                return;
            }

            if (password === "") {
                alert("Password is required!");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "log.in.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Check if login was successful
                        if (xhr.responseText.trim() === "success") {
                            // Redirect to index.php
                            window.location.href = "index.php";
                        } else {
                            // Display error message if login failed
                            alert("Username or Password is incorrect");
                        }
                    } else {
                        // Display error message if there was a problem with the request
                        alert("Error: " + xhr.statusText);
                    }
                }
            };

            // Send the request with the login credentials
            xhr.send("username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password));
        });
    </script>
</body>
</html>

