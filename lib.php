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
