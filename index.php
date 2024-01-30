<?php
require_once "lib.php";
$content = readJSON("data.json");
require_once "get_data.php";

debug_to_console($content,0);
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
    <!-- Search bar -->
    <?php require "form/search.php"; ?>
    <!-- Sort tasks -->
    <?php require "form/sort.php"; ?>
    <!-- Add task form -->
    <?php require "form/add.php"; ?>
    <!-- Tasks list -->
    <?php require "task/list.php"; ?>
</body>
</html>
