<?php

include("config/config.php");

session_start();
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
} else {
    echo "User ID not found in session.";
}

if (isset($_GET["id"])) {

    $post = $_GET["id"];

    $get_post = mysqli_query($conn, "SELECT * FROM post WHERE id = '$post'");

    while ($row = mysqli_fetch_array($get_post)) {
        $post_id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $content = $row['content'];
        $author = $row['author'];
        $image = $row['image_url'];
    }
}


if (isset($_POST["submit"])) {
    $comment = $_POST['comment'];
    $author = $_POST['author'];

    // Prepare the SQL statement
    $ins = "INSERT INTO comments (comment, author, post_id, id) VALUES (?, ?, ?, ?)";
    $st = mysqli_prepare($conn, $ins);

    if ($st) {
        // Bind the parameters to the prepared statement
        mysqli_stmt_bind_param($st, 'ssii', $comment, $author, $post_id, $userId);

        // Execute the prepared statement
        $success = mysqli_stmt_execute($st);

        // Check if the query was successful
        if ($success) {
            // Redirect to the home page
            echo "<script>alert('Data is Inserted!')</script>";
            header("Location: main.php");
            exit();
        } else {
            echo "<script>alert('There is an error!')</script>";
        }
        // Close the prepared statement
        mysqli_stmt_close($st);
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/post.css">
    <script src="https://kit.fontawesome.com/7f58f482ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>
        <?php echo $title; ?>
    </title>
</head>

<body>
    <div class="navbar">
        <nav>
            <div class="logo">
                <a href="main.php">
                    <img src="assets/OIG-removebg-preview-removebg-preview.png" alt="">
                </a>
            </div>
            <div class="btn">
                <a href="edit.php?id=<?php echo $post_id; ?>" class="create">Edit</a>
                <button onclick="openModal()">Add Comment</button>
            </div>
        </nav>


    </div>
    <div class="main">
        <div class='container'>
            <div class='head'>
                <h1 data-aos='zoom-out' data-aos-duration='3500'>
                    <?php echo $title; ?>.
                </h1>
                <img src="<?php echo $image; ?>" alt="img" data-aos='zoom-out' data-aos-duration='3500'>
            </div>
            <div class="description">
                <p data-aos='fade-up' data-aos-duration='3500'>
                    <?php echo $description; ?>
                </p>
                <p data-aos='fade-up' data-aos-duration='3500'>
                    <?php echo $content; ?>
                </p>
            </div>

        </div>

        <div class="comment-container">
            <?php

            if (isset($_GET["id"])) {

                $post = $_GET["id"];


                $get_post = mysqli_query($conn, "SELECT * FROM comments WHERE post_id = '$post'");

                while ($row = mysqli_fetch_array($get_post)) {
                    $comment = $row['comment'];
                    $date = $row['createdAt'];
                    $author = $row['author'];

                    echo "
                    <div data-aos='fade-left' data-aos-duration='4000' class='card'>
                    <p>$comment</p>
                    <div class='info'>
                    <h3>$author</h3>
                    <h3>$date</h3>
                    </div>
                    </div>
                    ";
                }
            }
            ?>
        </div>

        <footer>
            <div class='foot'>
                <div class='logo'>
                    <a href="#"><img src="assets/OIG-removebg-preview.png" alt=""></a>
                </div>

                <p>&copy; 2023 John Loyd. All rights reserved.</p>
            </div>
        </footer>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Type your comment!</h2>
            <form method="POST" class='delete'>
                <input type="hidden" value="<?php echo $userId; ?>">
                <input type="text" name="comment" placeholder="Comment">
                <input type="text" name="author" placeholder="Enter your name">
                <div>
                    <button type="submit" name="submit">Yes</button>
                    <button onclick="closeModal()">No</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // JavaScript functions to open and close the modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
</body>

</html>