<?php 
include "db_connection.php"; 

// Retrieve user_id from the URL
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    echo "User ID is not provided in the URL";
    exit; // Stop further execution if user_id is not provided
}

// Initialize variables
$first_name = "";
$last_name = "";
$email = "";
$password = "";
$level = "";

// Retrieve existing user data from the database
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name']; 
    $last_name = $row['last_name']; 
    $email = $row['email']; 
    $password = $row['password']; 
    $level = $row['level']; 
} else {
    echo "No user found with ID: $user_id";
    exit; // Stop further execution if no user found
}

// Process form submission
if (isset($_POST['update'])) { 
    // Retrieve form data
    $first_name = $_POST['first_name']; 
    $last_name = $_POST['last_name']; 
    $email = $_POST['email']; 
    $password = md5($_POST['password']); 
    $level = $_POST['level']; 
    
    // Update user data in the database
    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password', level = '$level' WHERE user_id = '$user_id'"; 
    $result = $conn->query($sql); 
        
    if ($result === TRUE) { 
        // Redirect back to view.php after successful update
        header("Location: view.php");
        exit; // Stop further execution after redirect
    } else { 
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Update Form</title>
</head>
<body>
    <h2>User Update Form</h2>
    <form action="" method="post">
        <fieldset>
            <legend>Personal information:</legend>
            
            First name: <br>
            <input type="text" name="first_name" value="<?php echo $first_name; ?>">
            <br>
            
            Last name: <br>
            <input type="text" name="last_name" value="<?php echo $last_name; ?>">
            <br>
            
            Email: <br>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <br>
            
            Password: <br>
            <!-- Change the input type to "password" to hide the password -->
            <input type="password" name="password" value="<?php echo $password; ?>"> 
            <br>
            
            Level: <br>
            <input type="radio" name="level" value="1" <?php if($level == 1){ echo "checked"; } ?>> Admin
            <input type="radio" name="level" value="2" <?php if($level == 2){ echo "checked"; } ?>> User
            <br><br>
            
            <input type="submit" value="Update" name="update">
        </fieldset>
    </form>
</body>
</html>
