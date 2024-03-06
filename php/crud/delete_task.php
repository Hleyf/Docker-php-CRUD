<?php
    include("../db.php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM task WHERE id = $id";
        $result = mysqli_query($db_connection, $query);
        if(!$result){
            die("Query Failed");
        }

        $_SESSION['message'] = 'Task Removed Successfully';
        $_SESSION['message_type'] = 'danger';
        header("Location: ../index.php");
    }
?>