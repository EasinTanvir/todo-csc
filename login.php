<?php require("header.php") ?>
<div class="login-container">
    <h1>Login</h1>
    <form action="process_login.php" method="POST" class="login-form">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
    <p class="form-footer">
        Don't have an account? <a href="register.php">SignUp</a>
    </p>
</div>
<?php require("footer.php") ?>
