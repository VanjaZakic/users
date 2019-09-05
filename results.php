<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once 'connection.php';
    $search = $_SESSION['search'];
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    </head>

    <body>

        <?php
            if(!isset($_SESSION['id'])) {
                echo "<h2>Please login</h2>";
                require_once 'login.php';
            }
            else {
                // $id = $_SESSION['id'];
                $search = $_SESSION['search'];

                $sql = "SELECT * FROM users
                        WHERE username OR email LIKE '%$search%'";
                $result = $conn->query($sql);
                if(!$result) {
                    echo "The query is not good.";
                }
                else {
                    if($result->num_rows == 0) {
                        echo "<h2>Does not exist similar name or an email address.</h2>";
                    }
                    else {
                        echo "<ul class='results_list'>";
                        while($obj = $result->fetch_object()) {
                            echo "<li>";
                            echo "<div class='list-part'>";
                            echo "Name: ";
                            echo $obj->username;
                            echo "</div>";
                            echo "<div class='list-part'>";
                            echo "Email address: ";
                            echo $obj->email;
                            echo "</div>";
                            echo "</li>";
                        }
                        echo "</ul>";
                    }
                }
            }
        ?>
        
    </body>
</html>