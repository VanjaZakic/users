<?php
    require_once 'connection.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        header('Location: results.php');
    }
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    </head>

    <body>
        <div>
            <ul class="home">
                <li><a href="login.php">Log in</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>

        <?php
            require_once 'search.php';
        ?>

    </body>
</html>