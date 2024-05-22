<?php
include "db_connection.php";

    if (isset($_GET['user_id']))
    {
        $user_id = $_GET['user_id'];

        $sql = "DELETE FROM users WHERE 'user_id'='$user_id'";

        $result = $conn->query($sql);

        if ($result == TRUE)
        {
            echo "Record Deleted Successfully";
            header("Location: view.php");
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }

?>