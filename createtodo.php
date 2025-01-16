<?php 
require("db.php");
require("header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);
    $due_date = $conn->real_escape_string($_POST['due_date']);
    $priority = $conn->real_escape_string($_POST['priority']);
    $userId = $_SESSION['user_id'];

    $query = "INSERT INTO todos (user_id, title, description, status, due_date, priority) VALUES ('$userId', '$title', '$description', '$status', '$due_date', '$priority')";
    if ($conn->query($query)) {
        echo "<p>Todo created successfully.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<link rel="stylesheet" href="css/createtodo.css">
<div class="todo-container">
    <h1>Create Todo</h1>
    <form method="POST">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>

        <label for="due_date">Due Date</label>
        <input type="date" id="due_date" name="due_date" required>

        <label for="priority">Priority</label>
        <select id="priority" name="priority">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <button type="submit">Create</button>
    </form>
</div>
<?php require("footer.php") ?>
