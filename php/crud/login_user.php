<?php
    require_once 'db.php';

    $email = $userName = $pasword = "";

    //form validation
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (empty($_GET["email"])) {
            $_SESSION["emailErrMessage"] = "Email is required";
            backToLogin();
        } 
        $email = test_input($_GET["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["emailErrMessage"] = "Invalid email format";
            backToLogin();        
        }
        
        if (empty($_GET["userName"])) {
            $_SESSION["userNameErrMessage"] = "User Name is required";
            backToLogin();
        } else {
            $userName = test_input($_GET["userName"]);
        }

        if (empty($_GET["password"])) {
            $_SESSION["passwordErrMessage"] = "Password is required";
            backToLogin();
        } else {
            $pasword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }

        $query = "SELECT * FROM user WHERE userName = '$userName'";
        $result = mysqli_query($db_connection, $query);
        if(mysqli_num_rows($result) == 1){
            
        }else {
            $_SESSION["userNameErrMessage"] = "User Name does not exist";
            backToLogin();
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