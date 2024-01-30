<?php
function put_to_session($identifier, $value): void {
    $_SESSION[$identifier] = $value;
}
function add_to_session($identifier, $value): void {
    if (!isset($_SESSION[$identifier])) $_SESSION[$identifier] = [];
    $_SESSION[$identifier][] = $value;
}
function get_from_session($identifier): array {
    if (!isset($_SESSION[$identifier])) return [];
    return $_SESSION[$identifier];
}
function reload(): void {
    global $content;
    put_to_session("task", $content);
    header("Location: index.php");
}
function swapIndex($array, $index1, $index2) {
    $temp = $array[$index1];
    $array[$index1] = $array[$index2];
    $array[$index2] = $temp;
    return $array;
}
function sendError($message): void {
    add_to_session("errors", $message);
}
function len($value): int {
    if (is_array($value)) return count($value);
    elseif (is_string($value)) return mb_strlen($value);
    else return 0;
}
function debug_to_console($data, $position) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects, pos " . $position . ": " . htmlspecialchars($output) . "' );</script>";
}
