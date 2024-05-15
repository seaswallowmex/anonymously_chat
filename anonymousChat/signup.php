<!DOCTYPE html>
<html>
<head>
    <title>Anonymously Chat - Sign Up</title>
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

        input[type=text], input[type=password], input[type=submit] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: solid 1px grey;
            font-size: 14px;
        }

        input[type=submit] {
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

        </style>
</head>
<body>
    <div id="wrapper">
        <div id="header">
            Anonymously Chat
        </div>
        <form id="signupForm" action="register.php" method="post">
            <input type="text" name="username" placeholder="Username" id="username" required><br>
            <div class="password-container">
                <input type="password" name="password" placeholder="Password" id="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('password')">👁</span>
            </div>
            <div class="password-container">
                <input type="password" name="password2" placeholder="Confirm Password" id="password2" required>
                <span class="toggle-password" onclick="togglePasswordVisibility('password2')">👁</span>
            </div>
            <input type="submit" value="Sign Up" id="signup">
        </form>
    </div>

    <script type="text/javascript">
        // Your JavaScript code here
    </script>
</body>
</html>