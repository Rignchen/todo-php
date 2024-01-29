<?php
require_once "lib.php";

if (isset($_POST["addTask"])) {
    $content[] = $_POST["addTask"];
    reload();
}
if (isset($_POST["removeTask"])) {
    array_splice($content, $_POST["removeTask"], 1);
    reload();
}
if (isset($_POST["modifyTask"], $_POST["modifyTaskValue"])) {
    $content[$_POST["modifyTask"]] = $_POST["modifyTaskValue"]; // I'm happy cause it worked on the first try
    reload();
}
if (isset($_GET["sort"])) {
    if ($_GET["sort"] === "alpha") {
        natcasesort($content);
    }
    elseif ($_GET["sort"] === "reverse") {
        natcasesort($content);
        $content = array_reverse($content);
    }
}
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $content = array_filter($content, function ($task) use ($search) {
        if ($search === "") {
            return true;
        }
        return stripos($task, $search) !== false;
    });
}
if (isset($_POST["moveTask"])) {
    $index = $_POST["moveTask"];
    if (isset($_POST["moveTaskUp"]) && $index > 0) {
        $content = swapIndex($content, $index, $index - 1);
    }
    elseif (isset($_POST["moveTaskDown"]) && $index < count($content) - 1) {
        $content = swapIndex($content, $index, $index + 1);
    }
    reload();
}
