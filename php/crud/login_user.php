<?php
    require_once 'db.php';

    $email = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (empty($_GET["email"])) {
            $_SESSION["emailErrMessage"] = "Em2ail is required";
            backToLogin();
        } 
        $email = test_input($_GET["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["emailErrMessage"] = "Invalid email format";
            backToLogin();        
        }
        
        if (empty($_GET["password"])) {
            $_SESSION["passErrMessage"] = "Password is required";
            backToLogin();
        } else {
            $password = test_input($_GET["password"]);
        }
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function backToLogin(){
        header("Location: ../../pages/auth/login.php");
    }

?>