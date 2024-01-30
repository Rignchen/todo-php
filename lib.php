<?php

// data
function update_task_in_db($value): void {
    $_SESSION["task"] = $value;
}
function get_task_from_db(): array {
    if (!isset($_SESSION["task"])) return [];
    return $_SESSION["task"];
}
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
    global $content;
    update_task_in_db($content);
    header("Location: index.php");
}

// array
function swapIndex($array, $index1, $index2) {
    $temp = $array[$index1];
    $array[$index1] = $array[$index2];
    $array[$index2] = $temp;
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
