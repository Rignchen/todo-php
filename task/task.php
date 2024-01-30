<li style="display:flex;">
    <form action="index.php" method="post">
        <input type="hidden" name="index" value="<?= $index ?>">
        <button type="submit" name="modifyTask" hidden="hidden"></button> <!-- This hidden button is triggered when the user modifies a task -->

        <!-- Remove task -->
        <button type="submit" name="removeTask">X</button>

        <!-- Task -->
        <input type="text" style="width: 50vw;" name="modifyTaskValue" value="<?= htmlspecialchars($task) ?>">

        <!-- Move task position -->
        <button type="submit" name="moveTaskUp">↑</button>
        <button type="submit" name="moveTaskDown">↓</button>
    </form>
</li>
