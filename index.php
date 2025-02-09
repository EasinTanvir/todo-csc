<?php
require("db.php");
require("header.php");

// Fetch all todos
$todos = $conn->query("SELECT * FROM todos");
?>

<div >
    <h1>All Todos</h1>

    <div class="todo-list">
    <?php while ($todo = $todos->fetch_assoc()): ?>
        <div class="todo-card">
            <h3><?= htmlspecialchars($todo['title']) ?></h3>
            <p><?= htmlspecialchars($todo['description']) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($todo['status']) ?></p>
            <a href="todo-details.php?id=<?= $todo['id'] ?>">View Todo</a>
        </div>
    <?php endwhile; ?>
    </div>

    


</div>

<?php require("footer.php"); ?>
