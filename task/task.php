<li>
    <!-- Remove task -->
    <form action="index.php" method="post">
        <input type="hidden" name="removeTask" value="<?= $index ?>">
        <button type="submit">X</button>
    </form>
    <!-- Task -->
    <form action="index.php" method="post">
        <input type="hidden" name="modifyTask" value="<?= $index ?>">
        <input type="text" name="modifyTaskValue" value="<?= htmlspecialchars($task) ?>">
    </form>
    <!-- Move task position -->
    <form action="index.php" method="post">
        <input type="hidden" name="moveTask" value="<?= $index ?>">
        <button type="submit" name="moveTaskUp">↑</button>
        <button type="submit" name="moveTaskDown">↓</button>
    </form>
</li>