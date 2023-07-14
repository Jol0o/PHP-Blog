<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/main.css">
    <script src="https://kit.fontawesome.com/7f58f482ae.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>
        Blog
    </title>
</head>

<body>
    <!-- Page navbar with logo and list of navigation buttons and Search bar along side with Create post button -->
    <div class="navbar">
        <nav>
            <div class="list">
                <div class="logo">
                    <img src="assets/OIG-removebg-preview-removebg-preview.png" alt="">
                </div>

                <ul class="nav-ul">
                    <li> <a href="#">Home</a> </li>
                    <li> <a href="#about"> About</a></li>
                    <li>
                        <a href="#post">
                            Post</a>
                    </li>
                </ul>
                <div class="btn">
                    <form action="search.php" class="group">
                        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                            <g>
                                <path
                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                </path>
                            </g>
                        </svg>
                        <input placeholder="Search" type="search" name="search" class="input">
                    </form>
                    <a href="create.php" class="create">Create Post</a>
                </div>
            </div>
            <button class="menu"><i class="fa fa-bars"></i></button>
        </nav>
    </div>

    <!-- This is the main container in the main page -->
    <div class="container">
        <!-- This component display the header -->
        <div class="header" data-aos="fade-in" data-aos-duration="3500">
            <h3>Take a minute to discover</h3>
            <h1> Exploring the Wonders of Nature</h1>
            <button>Read more</button>
        </div>
    </div>
    <div class="main">
        <div class="container-section" data-aos="zoom-out" data-aos-duration="3500">
            <h1>The magic of wild nature</h1>
            <p>Photography Experiences</p>
            <button>Explore Trips</button>
        </div>
    </div>

    <div class="animals" data-aos="fade-out" data-aos-duration="3500">
        <div style="background:
            url('https://images.pexels.com/photos/4577791/pexels-photo-4577791.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size:cover; background-position: center; filter: grayscale(50%);
            " class="card">
            <h1>Big Elephants</h1>
        </div>
        <div style="background:
            url('https://images.pexels.com/photos/4577837/pexels-photo-4577837.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size:cover;  background-position: center; filter: grayscale(50%);
            " class="card">
            <h1>Lion Reserve</h1>
        </div>
        <div style="background:
            url('https://images.pexels.com/photos/5810713/pexels-photo-5810713.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size:cover;  background-position: center; filter: grayscale(50%);
            " class="card">
            <h1>White Tiger</h1>
        </div>
        <div style="background:
            url('https://images.pexels.com/photos/5587955/pexels-photo-5587955.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size:cover; background-position: center; filter: grayscale(50%);" class="card">
            <h1>Eagle Eyes
            </h1>
        </div>
    </div>

    <!-- This component displays the blog post -->
    <div class="post">
        <div class="post-header" data-aos="zoom-out" data-aos-duration="3500">
            <h1>Latest blog posts & adventures</h1>
            <p>See them though my photos lens</p>
        </div>

        <div id='post' class="post-card">
            <?php

            include("config/config.php");

            $view = mysqli_query($conn, "SELECT * FROM post ");

            while ($row = mysqli_fetch_array($view)) {

                $title = $row['title'];
                $description = $row['description'];
                $content = $row['content'];
                $author = $row['author'];
                $image = $row['image_url'];
                $post_id = $row['id'];

                $limitedDescription = (strlen($description) > 100) ? substr($description, 0, 155) . "..." : $description;

                echo "
    <div class='post-info' data-aos='zoom-in-left' data-aos-duration='3500'>
    <a href='post.php?id=$post_id' class='link'>
    <img src='$image' alt='image'/>
    </a>
    <div class='post-right'>
    <h1>$title</h1>
    <div class='info'>
    <p class='blog'>Blog</p>
    <p class='author'>$author</p>
    </div>
    <p class='description'>$limitedDescription</p>
    </div>
    </div>
    ";
            }
            ?>
        </div>
    </div>

    <!-- and the footer component -->
    <footer>
        <div class='foot'>
            <div class='logo'>
                <a href="#">
                    <img src="assets/OIG-removebg-preview.png" alt="logo">
                </a>
            </div>
            <p>&copy; 2023 John Loyd. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        // Add an event listener to the menu button
        var menuButton = document.querySelector('.menu');
        menuButton.addEventListener('click', function () {
            var btnElement = document.querySelector('.create');
            var ulElement = document.querySelector('.nav-ul');

            // Toggle the display property of the btn and ul elements
            if (btnElement.style.display === 'none') {
                btnElement.style.display = 'block';
                ulElement.style.display = 'block';
            } else {
                btnElement.style.display = 'none';
                ulElement.style.display = 'none';
            }
        });
    </script>
</body>

</html>