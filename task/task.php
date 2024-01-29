<li>
    <form action="index.php" method="post">
        <input type="hidden" name="removeTask" value="<?= $index ?>">
        <button type="submit">X</button>
    </form>
    <form action="index.php" method="post">
        <input type="hidden" name="modifyTask" value="<?= $index ?>">
        <input type="text" name="modifyTaskValue" value="<?= htmlspecialchars($task) ?>">
    </form>
</li>