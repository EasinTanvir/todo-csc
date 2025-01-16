<?php 
require("db.php");
require("header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch todos
$todos = $conn->query("SELECT * FROM todos WHERE user_id = '$userId'");

// Handle delete
if (isset($_GET['delete'])) {
    $todoId = $conn->real_escape_string($_GET['delete']);
    $conn->query("DELETE FROM todos WHERE id = '$todoId'");
    header("Location: profile.php");
    exit();
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $updateId = $conn->real_escape_string($_POST['update_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);
    $dueDate = $conn->real_escape_string($_POST['due_date']);
    $priority = $conn->real_escape_string($_POST['priority']);

    $conn->query("UPDATE todos SET 
        title = '$title', 
        description = '$description', 
        status = '$status', 
        due_date = '$dueDate', 
        priority = '$priority' 
        WHERE id = '$updateId' AND user_id = '$userId'");
    header("Location: profile.php");
    exit();
}

// Handle fetch for editing
$editTodo = null;
if (isset($_GET['edit'])) {
    $editTodoId = $conn->real_escape_string($_GET['edit']);
    $editTodoResult = $conn->query("SELECT * FROM todos WHERE id = '$editTodoId' AND user_id = '$userId'");
    if ($editTodoResult->num_rows > 0) {
        $editTodo = $editTodoResult->fetch_assoc();
    }
}
?>
<link rel="stylesheet" href="css/profile.css">
<link rel="stylesheet" href="css/createtodo.css">
<div class="profile-container">
    <h1>Your Todos</h1>
    <ul class="todo-list">
        <?php while ($todo = $todos->fetch_assoc()): ?>
            <li class="todo-item">
                <strong><?= $todo['title'] ?></strong> (<?= $todo['status'] ?>)
                <a href="profile.php?edit=<?= $todo['id'] ?>" class="edit-link">Edit</a>
                <a href="profile.php?delete=<?= $todo['id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this todo?');">Delete</a>
            </li>
        <?php endwhile; ?>
    </ul>

    <?php if ($editTodo): ?>
        <div class="todo-container">
            <h2>Edit Todo</h2>
            <form method="POST" class="todo-form">
                <input type="hidden" name="update_id" value="<?= $editTodo['id'] ?>">
                
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= $editTodo['title'] ?>" required>
                
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?= $editTodo['description'] ?></textarea>
                
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="pending" <?= $editTodo['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="completed" <?= $editTodo['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
                
                <label for="due_date">Due Date</label>
                <input type="date" id="due_date" name="due_date" value="<?= $editTodo['due_date'] ?>" required>
                
                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <option value="low" <?= $editTodo['priority'] === 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= $editTodo['priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= $editTodo['priority'] === 'high' ? 'selected' : '' ?>>High</option>
                </select>
                
                <button type="submit">Update</button>
            </form>
        </div>
    <?php endif; ?>
</div>

<?php require("footer.php") ?>
