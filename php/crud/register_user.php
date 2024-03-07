<?php
    require_once 'db.php';

    $email = $userName = $pasword = "";

    //form validation
    validateForm($db_connection, $email, $userName, $pasword);

    // Insert the user into the database
    $query = "INSERT INTO user (email, username, password) VALUES ('$email', '$userName', '$pasword')";
    if(mysqli_query($db_connection, $query)){
        $_SESSION["successMessage"] = "User registered successfully";
        header("Location: ../../pages/auth/login.php");
    } else{
        $_SESSION["errorMessage"] = "Error: " . $query . "<br>" . mysqli_error($db_connection);
        backToLogin();
    }

function validateForm(&$db_connection, &$email, &$userName, &$pasword){
    if (empty($_POST["email"])) {
        $_SESSION["emailErrMessage"] = "Email is required";
        backToLogin();
    } else{
        $email = test_input($_POST["email"]);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["emailErrMessage"] = "Invalid email format";
        backToLogin();        
    }
    // Checks if the user exists in the database.
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($db_connection, $query);
    if(mysqli_num_rows($result) > 0){
        $_SESSION["emailErrMessage"] = "Email already in use";
        backToLogin();
    }
    
    if (empty($_POST["userName"])) {
        $_SESSION["userNameErrMessage"] = "User Name is required";
        backToLogin();
    } else {
        $userName = test_input($_POST["userName"]);
    }

    //Checks if user has special characters
    if (!preg_match("/^[a-zA-Z0-9]*$/",$userName)) {
        $_SESSION["userNameErrMessage"] = "Only letters and numbers allowed";
        backToLogin();
    }

    $query = "SELECT * FROM user WHERE username = '$userName'";
    $result = mysqli_query($db_connection, $query);
    if(mysqli_num_rows($result) > 0){
        $_SESSION["userNameErrMessage"] = "User Name already in use";
        backToLogin();
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

    // Just an easy way to redirect to the login page in case of error. 
    // Error messages must be stored in the session before calling it.1
    function backToLogin(){
        header("Location: ../../pages/auth/login.php");
    }

?>