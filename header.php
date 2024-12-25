<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/register.css">  
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<header>
    <nav>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="createtodo.php">Create Todo</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="register.php">SignUp</a></li>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
