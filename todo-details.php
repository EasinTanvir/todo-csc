<?php
require("db.php");
require("header.php");

if (!isset($_GET['id'])) {
    echo "<p>Todo not found.</p>";
    require("footer.php");
    exit();
}

$todoId = $conn->real_escape_string($_GET['id']);
$result = $conn->query("SELECT * FROM todos WHERE id = '$todoId'");
$todo = $result->fetch_assoc();

if (!$todo) {
    echo "<p>Todo not found.</p>";
    require("footer.php");
    exit();
}

// Handle status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $newStatus = $conn->real_escape_string($_POST['status']);
    $conn->query("UPDATE todos SET status = '$newStatus' WHERE id = '$todoId'");
    header("Location: todo-details.php?id=$todoId");
    exit();
}
?>

<div class="todo-details">
    <h1><?= htmlspecialchars($todo['title']) ?></h1>
    <p><strong>Description:</strong> <?= htmlspecialchars($todo['description']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($todo['status']) ?></p>
    <p><strong>Due Date:</strong> <?= htmlspecialchars($todo['due_date']) ?></p>
    <p><strong>Priority:</strong> <?= htmlspecialchars($todo['priority']) ?></p>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST">
            <label for="status">Update Status</label>
            <select name="status" id="status">
                <option value="pending" <?= $todo['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $todo['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
            <button type="submit">Take Action</button>
        </form>
    <?php endif; ?>
</div>

<?php require("footer.php"); ?>
