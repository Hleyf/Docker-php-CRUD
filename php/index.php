<?php require_once 'db.php'; ?>
<?php
    if(!isset($_SESSION['user_id'])){
        header("Location: ./pages/auth/login.php");
    }else{
        header("Location: ../../pages/task/task_main.php");
    }
?>