<?php
session_start();
require_once "lib.php";
$pdo = connect_db();
$errors = get_errors();
$content = get_task_from_db();
require_once "get_data.php";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    // Errors
    require "errors.php";
    // Search bar
    require "form/search.php";
    // Sort tasks
    require "form/sort.php";
    // Add task form
    require "form/add.php";
    // Tasks list
    require "task/list.php";
    ?>
</body>
</html>
