<?php
    require_once 'db.php';

    $userName = $password = "";

    global $loggedUser;

    //form validation
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        validateForm($userName, $password);

        $query = "SELECT * FROM user WHERE userName = '$userName'";
        $result = mysqli_query($db_connection, $query);
        if(mysqli_num_rows($result) == 1){
            validateUserPassword($result, $userName, $password);
        }else {
            $_SESSION["userNameErrMessage"] = "User Name does not exist";
            backToLogin();
        }
    }

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
    
    function validateUserPassword($result, &$userName, $pasword){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pasword, $row['password'])){
            $user = new stdClass(); //TODO: create a user class
            $user->userName = $row['user_name'];
            $user->id = $row['id'];
            
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

    function backToLogin(){
        header("Location: ../../pages/auth/login.php");
    }

?>