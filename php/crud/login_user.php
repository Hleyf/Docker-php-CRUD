<?php
    require_once 'db.php';

    $userName = $password = "";

    //form validation
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        validateForm($userName, $password);

        $query = "SELECT * FROM user WHERE userName = '$userName'";
        $result = mysqli_query($db_connection, $query);
        if(mysqli_num_rows($result) == 1){
            validateUserPassword($result, $password);
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
            $pasword = password_hash($_POST["password"], PASSWORD_DEFAULT);
        }
    }
    
    function validateUserPassword($result, $pasword){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pasword, $row['password'])){
            // Regenerate the session ID after successful login to prevent session fixation attacks.
            session_regenerate_id();
            
            $user = new stdClass(); //TODO: create a user class
            $user->id = $row['id'];
            $user->userName = $row['user_name'];
            
            //user is stored in session after being validated. 
            //TODO: "remmember me" is not implemented since user won't persiste after session ends.
            $_SESSION["user"] = $user; 

            header("Location: ../../pages/task/task_main.php");
        }else{
            $_SESSION["passwordErrMessage"] = "Password is incorrect";
            backToLogin();
        }
    }

    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // Just an easy way to redirect to the login page in case of error. Error messages must be stored in the session before calling it.
    function backToLogin(){
        header("Location: ../../pages/auth/login.php");
    }

?>