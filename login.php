<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once 'connection.php';

    $checkEmail = "*";
    $checkPassword = "*";

    if(!empty($_POST)) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        $sql = "SELECT * FROM users
                WHERE email = '$email'";
        $result = $conn->query($sql);
        if(!$result) {
            echo "The query is not good.";
        }
        else {
            if($result->num_rows == 0) {
                $checkEmail = "This user does not exist.";
            }
            else {
                $obj = $result->fetch_assoc();
                if(md5($password) != $obj['pass']) {
                    $checkPassword = "Error logging you in.";
                }
                else {
                    $_SESSION['id'] = $obj['id'];
                    header('Location:welcome.php');
                }
            }
        }
    }

?>

<html>
<head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    </head>

    <body>

        <form action="login.php" method="POST">
            <fieldset>
                <legend>Login</legend>

                <div class="form_center">
                <div>
                    <div>
                        <label>Email:</label>
                        <input type="email" name="email">
                        <span style="color:red"><?php echo $checkEmail ?></span>
                    </div>

                    <div>
                        <label>Password:</label>
                        <input type="password" name="password">
                        <span style="color:red"><?php echo $checkPassword ?></span>
                    </div>

                    <div>
                        <input type="submit" value="Log in">
                    </div>
                </div>
                </div>
            </fieldset>
        </form>
    </body>
</html>