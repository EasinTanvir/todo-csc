<?php 
require("db.php");
require("header.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        echo "<p>Email already exists. Please try a different one.</p>";
    } else {
        // Insert new user
        $insertQuery = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($insertQuery)) {
            header("Location: login.php");
            exit();
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<div class="register-container">
    <h1>Register</h1>
    <form method="POST" class="register-form">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Register</button>
    </form>
    <p class="form-footer">
        Already have an account? <a href="login.php">Login</a>
    </p>
</div>
<?php require("footer.php"); ?>
