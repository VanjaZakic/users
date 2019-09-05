<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    if(!empty($_POST)) {
        $search = $conn->real_escape_string($_POST['search']);
        $_SESSION['search'] = $search;
    }
    
?>

<form action="home.php" method="POST">
    <div class="search">
        <div class="search_image">
            <img src="images/search.png">
        </div>
        <div class="search_input">
            <input type="text" placeholder="Search..." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
