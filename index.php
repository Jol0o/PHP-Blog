<?php

session_start();

// include the database configuration in the config file
include("config/config.php");

// check if submit button is clicked with the method of post
if (isset($_POST['submit'])) {
    //get the data from the form inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    // sql query that will select if the email and password are match
    $select = " SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $select);

    // fetch the result
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);
        $_SESSION['id'] = $row['id'];
        header("Location: main.php");
        exit();
    } else {
        // if the user input did not match it will throw a error
        $error[] = 'Incorrect email or password';
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
    <!-- main container in index page which is login page -->
    <div class="container">
        <form action="index.php" method="POST">
            <div class="form-header">
                <h1>Login</h1>
                <p>Welcome onboard with us!</p>
                <!-- render the error if there is a error -->
                <?php
                if (!empty($error)) {
                    foreach ($error as $errorMsg) {
                        echo '<span class="error-msg text-capitalize fw-bold text-danger">' . $errorMsg . '</span>';
                    }
                }
                ?>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your Email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="pass" name="password" required placeholder="Enter your Password">
            </div>
            <div class="con-btn">
                <input class="btn" type="submit" name="submit" value="Submit">
                <a href="register.php">Are you new? <span>Register</span> here</a>
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
        <video src="assets/forest.mp4" class="video-background" autoplay muted loop></video>
    </div>
</body>

</html>