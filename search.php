<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/search.css">
    <title>Search</title>
</head>

<body>
    <div class="container">
        <?php

        include("config/config.php");

        // This will check if the button search is clicked
        if (isset($_GET['search'])) {
            // Get the search value in the url
            $search = $_GET['search'];

            // this will check if the search variable is empty or null
            if (empty($search)) {
                echo "No search";
            } else {
                //if the search variable is not empty then it will find the search value in the post data
                $terms = explode(" ", $search);
                $q = "SELECT * FROM post WHERE ";
                $i = 0;

                // it will loop through the post title
                foreach ($terms as $each) {
                    $i++;
                    if ($i == 1) {
                        $q .= "title LIKE '%$each%' ";
                    } else {
                        $q .= "OR title LIKE '%$each%' ";
                    }
                }
                // this will be the sql query 
                $query = mysqli_query($conn, $q);
                $c_q = mysqli_num_rows($query);

                // this will fetch the result if the search value is match with the post titles
                if ($c_q > 0 && $search != "") {
                    echo " RESULT:" . "<br>" . "<br>";
                    while ($row = mysqli_fetch_assoc($query)) {
                        $title = $row["title"];
                        $description = $row["description"];
                        $img = $row["image_url"];
                        $author = $row["author"];
                        $content = $row["content"];
                        $id = $row["id"];

                        echo "
                        <a href='post.php?id=$id'>
                        <img src=$img alt='img'/>
                        <div>
                        <h2>$title</h2>
                        <h3>$author</h3>
                        <p>$description</p>
                        </div>
                        </a>
                        ";
                    }
                } else {
                    echo "No result.";
                }
            }
        }

        ?>
    </div>
</body>


</html>