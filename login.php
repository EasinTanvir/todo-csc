<?php 
require("db.php");
require("header.php");

$error = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "<script>alert('Login successful! Redirecting to your profile.');</script>";
            echo "<script>window.location.href = 'profile.php';</script>";
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<div class="login-container">
    <h1>Login</h1>
    <form method="POST" class="login-form">
        <?php if (!empty($error)) { ?>
            <p style="color: red; font-size: 14px;"><?= $error ?></p>
        <?php } ?>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
    <p class="form-footer">
        Don't have an account? <a href="register.php">Sign Up</a>
    </p>
</div>
<?php require("footer.php"); ?>
