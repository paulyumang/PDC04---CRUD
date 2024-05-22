<?php 
include "db_connection.php";

  if (isset($_POST['submit'])) {

    $first_name = $_POST['firstname'];

    $last_name = $_POST['lastname'];

    $email = $_POST['email'];

    $password = md5($_POST['password']);

    $level =  $_POST['level'];

    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, level) VALUES ('$first_name','$last_name','$email','$password', $level)";

    $result = $conn->query($sql);

    if ($result == TRUE) {

        if ($level == 1) {
          header("Location: admin-page.php");
      } elseif ($level == 2) {
          header("Location: user-page.php");
      } else {
          echo "Invalid user level.";
      }

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    $conn->close(); 

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <form action="" method="POST" class="bg-white p-4 rounded shadow">
                    <h2 class="text-center mb-4">Register</h2>
                    <fieldset>
                        <legend class="fw-bold mb-3">Personal information:</legend>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <span class="fw-bold">Level:</span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="admin" value="1">
                                <label class="form-check-label" for="admin">Admin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="user" value="2">
                                <label class="form-check-label" for="user">User</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


