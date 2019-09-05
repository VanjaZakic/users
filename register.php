<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    require_once 'connection.php';

    $checkEmail = "*";
    $checkName = "*";
    $checkPassword = "*";
    $checkRepeatPassword = "*";

    if(!empty($_POST)) {
        $email = $conn->real_escape_string($_POST['email']);
        $name =  $conn->real_escape_string($_POST['name']);
        $password =  $conn->real_escape_string($_POST['password']);
        $repeatPassword =  $conn->real_escape_string($_POST['repeatPassword']);

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(empty($email) == TRUE) {
            $checkEmail = "You did not enter a email.";
        }
        elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
            $checkEmail = "Email not entered correctly.";
        }

        if(empty($name) == TRUE) {
            $checkName = "You did not enter a name.";
        }
        elseif(preg_match('/^[a-z]*$/i', $name) == FALSE) {
            $checkName = "The name can only contain letters.";
        }

        if(empty($password) == TRUE ) {
            $checkPassword = "You did not enter a password.";
        }
        elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $checkPassword = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
        }

        elseif(empty($repeatPassword) == TRUE ) {
            $checkRepeatPassword = "You did not enter a repeat password.";
        }
        elseif($password != $repeatPassword) {
            $checkRepeatPassword = "No password match occurred.";
        }

        elseif($checkEmail = "*" && $checkName = "*" && $checkPassword = "*" && $checkRepeatPassword = "*") {
            $hashPassword = md5($password);
            $sql = "INSERT INTO users(email, username, pass)
                    VALUE ('$email', '$name', '$hashPassword')";
            $result = $conn->query($sql);

            $sql2 = "SELECT * FROM users
            WHERE email = '$email'";
            $result2 = $conn->query($sql2);
            $obj = $result2->fetch_assoc();
            $_SESSION['id'] = $obj['id'];
            header('Location: welcome.php');
        }

    }

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    </head>
    
    <body>

        <form action="register.php" method="POST">
            <fieldset>
                <legend>Register</legend>
    
                <div class="form_center">
                <div>
                    <div>
                        <label>Email:</label>
                        <input type="email" name="email" >
                        <span style="color:red"><?php echo $checkEmail ?></span>
                    </div>

                    <div>
                        <label>Name:</label>
                        <input type="text" name="name">
                        <span style="color:red"><?php echo $checkName ?></span>
                    </div>

                    <div>
                        <label>Password:</label>
                        <input type="password" name="password">
                        <span style="color:red"><?php echo $checkPassword ?></span>
                    </div>

                    <div>
                        <label>Repeat password:</label>
                        <input type="password" name="repeatPassword">
                        <span style="color:red"><?php echo $checkRepeatPassword ?></span>
                    </div>

                    <div>
                        <input type="submit" value="Register">
                    </div>
                </div>
                </div>
            </fieldset>            
        </form>

    </body>
</html>