<?php
require 'database.php';
session_start(); // Start session

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];
    
    // Validate credentials in database
    // Assuming you have a 'users' table with columns for username, password, and role
    $conn = mysqli_connect("localhost", "db_email", "db_wachtwoord", "db_name");
    $sql = "SELECT * FROM Gebruikers WHERE email='$email' AND wachtwoord='$wachtwoord'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($row) { // User found in database
        // Set session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        $_SESSION["rol"] = $row["rol"];
        
        if($row["rol"] == "admin") {
            header("location: admin_page.php"); // Redirect to admin page
        } else {
            header("location: user_page.php"); // Redirect to user page
        }
    } else { // Invalid credentials
        echo "Invalid email or wachtwoord";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>email:</label><br>
        <input type="text" name="email"><br>
        <label>wachtwoord:</label><br>
        <input type="password" name="wachtwoord"><br>
        <input type="submit" value="Log in">
    </form>
</body>
</html>