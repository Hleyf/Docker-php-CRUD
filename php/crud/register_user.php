<?php
    require_once 'db.php';

    $email = $userName = $pasword = "";

    //form validation
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["email"])) {
            $_SESSION["emailErrMessage"] = "Email is required";
            backToLogin();
        } 
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["emailErrMessage"] = "Invalid email format";
            backToLogin();        
        }
        
        if (empty($_POST["userName"])) {
            $_SESSION["userNameErrMessage"] = "User Name is required";
            backToLogin();
        } else {
            $userName = test_input($_POST["userName"]);
        }

        if (empty($_POST["password"])) {
            $_SESSION["passwordErrMessage"] = "Password is required";
            backToLogin();
        } else {
            $pasword = password_hash($_POST["password"], PASSWORD_DEFAULT);
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