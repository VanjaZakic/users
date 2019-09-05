<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once 'connection.php';

    if(!isset($_SESSION['id'])) {
        header('Location: home.php');
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users
            WHERE id = $id";
    $result = $conn->query($sql);
    $obj = $result->fetch_object();
    $name = $obj->username;

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
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>

        <div>
            <h2>Welcome: <?php echo $name?></h2>
        </div>

        <?php
            require_once 'search.php';
        ?>

    </body>
</html>