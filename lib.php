<?php
function readJSON($file) {
    return json_decode(file_get_contents($file));
}
function writeJSON($file, $contents): void {
    file_put_contents($file, json_encode($contents));
}
function reload(): void {
    global $content;
    writeJSON("data.json", $content);
    header("Location: index.php");
}
function swapIndex($array, $index1, $index2) {
    $temp = $array[$index1];
    $array[$index1] = $array[$index2];
    $array[$index2] = $temp;
    return $array;
}
function sendError($message) {
    $_SESSION["errors"][] = $message;
}
function len($value): int {
    if (is_array($value)) return count($value);
    elseif (is_string($value)) return strlen($value);
    else return 0;
}
function debug_to_console($data, $position) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects, pos " . $position . ": " . htmlspecialchars($output) . "' );</script>";
}
