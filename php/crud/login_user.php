<?php
    require_once '../db.php';

    $userName = $password = "";
    $user = new stdClass();

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        validateForm($userName, $password);
        $user = checkUserExist($db_connection, $userName);
        if(isset($user->id)){
            validateUserPassword($user, $password);
            //user is stored in session after being validated. 
            //TODO: "remmember me" is not implemented since user won't persist after session ends.
            $_SESSION["user"] = $user; 
            header("Location: ../../pages/task/task_main.php");
        }else {
            $_SESSION["userNameErrMessage"] = "User Name does not exist";
            backToLogin();
        }
    }
    // form validation function. username and password are passed by reference.
    function validateForm(&$userName, &$pasword){
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
            $pasword = password_hash($_GET["password"], PASSWORD_DEFAULT);
        }
    }
    
    function validateUserPassword(&$user, &$pasword){
        if(password_verify($pasword, $user->password)){
            unset($user->password);
            // Regenerate the session ID after successful login to prevent session fixation attacks.
            session_regenerate_id();
        }else{
            $_SESSION["passwordErrMessage"] = "Password is incorrect";
            backToLogin();
        }
    }
    // Check if the user exists in the database.
    function checkUserExist(&$db_connection, &$userName){
        $query = "SELECT * FROM user WHERE user_name = '$userName'";
        $result = mysqli_query($db_connection, $query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $user = new stdClass(); //TODO: create a user class
            $user->id = $row['id'];
            $user->userName = $row['user_name'];
            $user->password = $row['password'];
            return $user;
        }else{
            return false;
        }
    }

    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // Just an easy way to redirect to the login page in case of error. 
    // Error messages must be stored in the session before calling it.
    function backToLogin(){
        header("Location: ../../pages/auth/login.php");
    }

?>