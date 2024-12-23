<?php require("header.php") ?>
<div class="register-container">
    <h1>Register</h1>
    <form action="process_register.php" method="POST" class="register-form">
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
<?php require("footer.php") ?>
