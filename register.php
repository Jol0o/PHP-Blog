<?php

#getting the database

include("config/config.php");

#checking if the submit button is clicked
if (isset($_POST['submit'])) {

    #getting the inputs value
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpass']);

    #checking if username and email are being used
    $sel = "SELECT * FROM user WHERE username = '$username' AND email = '$email'";

    #setting the $sel variable in result with the database
    $result = mysqli_query($conn, $sel);

    #checking if user is exist
    if (mysqli_num_rows($result) > 0) {

        $error[] = 'User already exists!';

    } else {
        #checking if password and cpassword are match
        if ($password !== $cpassword) {
            $error[] = 'Passwords do not match!';
        } else {
            #inserting the username , email and password values into the database
            $insert = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($conn, $insert);

            header("Location: index.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css">
    <title>Blog</title>
</head>

<body>

    <!-- main container  in register page  -->
    <div class="container">
        <!-- this form handle the registration -->
        <form action="register.php" method="POST">
            <div class="form-header">
                <h1>Register</h1>
                <p>Welcome aboard with us!</p>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error">' . $error . '</span>';
                    }
                    ;
                }
                ;
                ?>
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required placeholder="Enter your Username">
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your Email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your Password">
            </div>
            <div>
                <label for="cpass">Confirm your password</label>
                <input type="password" name="cpass" id="cpassword" required placeholder="Confirm Password">
            </div>
            <div class="con-btn">
                <input class="btn" type="submit" name="submit" value="Submit">
                <a href="index.php">Have an account? <span>Login</span> here</a>
            </div>
            <div class="icon">
                <button type="button">
                    <img src="assets/icon/pngegg6.png" alt="icon">
                </button>
                <button type="button">
                    <img src="assets/icon/pngegg7.png" alt="icon">
                </button>
                <button type="button">
                    <img src="assets/icon/pngegg8.png" alt="icon">
                </button>
            </div>
        </form>
        <!-- this video is for the background -->
        <video src="assets/forest.mp4" class="video-background" autoplay muted loop></video>
    </div>
</body>

</html>