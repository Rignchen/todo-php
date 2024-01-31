<?php

// database
function connect_db(): PDO {
    return new PDO('sqlite:data.db');
}
function get_task_from_db(): array {
    global $pdo;
    $sql = $pdo->prepare("SELECT * FROM task");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function add_task_to_db($task): void {
    global $pdo;
    $sql = $pdo->prepare("INSERT INTO `task` (title) VALUES (?)");
    $sql->execute([$task]);
}
function update_tasks_in_db($contents): void {
    global $pdo;
    foreach ($contents as $data) {
        $sql = $pdo->prepare("UPDATE `task` SET title = ? WHERE id = ?");
        $sql->execute([$data["task"], $data["id"]]);
    }
}

// errors
function get_errors(): array {
    if (!isset($_SESSION["errors"])) return [];
    return $_SESSION["errors"];
}
function sendError($message): void {
    if (!isset($_SESSION["errors"])) $_SESSION["errors"] = [];
    $_SESSION["errors"][] = $message;
}

// web page
function reload(): void {
    header("Location: index.php");
}

// array
function swapIndex($array, $index1, $index2) {
    $temp = $array[$index1];
    $array[$index1] = $array[$index2];
    $array[$index2] = $temp;
    return $array;
}
function get_index_title($array,$index): mixed {
    return $array[$index];
}
function set_index_title($array,$index,$value): array {
    $array[$index] = $value;
    return $array;
}

// size
function len($value): int {
    if (is_array($value)) return count($value);
    elseif (is_string($value)) return mb_strlen($value);
    else return 0;
}
function validSize($task, $min = 3, $max = 100): bool {
    if (len($task) < $min || len($task) > $max) {
        sendError(
            ((len($task) < $min) ? "Size is too short" : "Size is too long") . ", " .
            ((($min === $max) ? "size must be " . $min . " characters long" : "size must be between " . $min . " and " . $max . " characters long"))
        );
        return false;
    }
    return true;
}

// debug
function debug_to_console($data, $position): void {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects, pos " . $position . ": " . htmlspecialchars($output) . "' );</script>";
}
