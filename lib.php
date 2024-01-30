<?php
function readJSON($file) {
    return json_decode(file_get_contents($file));
}
function writeJSON($file, $contents): void {
    file_put_contents($file, json_encode($contents));
}
function reload(): void {
    debug_to_console("save",99);
    global $content;
    writeJSON("data.json", $content);
    header("Location: index.php");
}
function swapIndex($array, $index1, $index2)
{
    debug_to_console("swap: " . $index1 . " " . $index2, 10);
    debug_to_console($array, 11);
    $temp = $array[$index1];
    $array[$index1] = $array[$index2];
    $array[$index2] = $temp;
    debug_to_console($array, 12);
    return $array;
}
function debug_to_console($data, $position): void {
    /*
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects, pos " . $position . ": " . htmlspecialchars($output) . "' );</script>";
    /**/
}
