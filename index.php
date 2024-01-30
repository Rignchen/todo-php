<?php
session_start();
require_once "lib.php";
$errors = get_from_session("errors");
$content = get_from_session("task");
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
    <!-- Errors -->
    <?php require "errors.php"; ?>
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
