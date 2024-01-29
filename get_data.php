<?php
require_once "lib.php";

if (isset($_POST["addTask"])) {
    $content[] = $_POST["addTask"];
    reload();
}
elseif (isset($_POST["removeTask"])) {
    array_splice($content, $_POST["removeTask"], 1);
    reload();
}
elseif (isset($_POST["modifyTask"], $_POST["modifyTaskValue"])) {
    $content[$_POST["modifyTask"]] = $_POST["modifyTaskValue"]; // I'm happy cause it worked on the first try
    reload();
}
elseif (isset($_GET["sort"])) {
    if ($_GET["sort"] === "alpha") {
        natcasesort($content);
    }
    elseif ($_GET["sort"] === "reverse") {
        natcasesort($content);
        $content = array_reverse($content);
    }
}
elseif (isset($_GET["search"])) {
    $search = $_GET["search"];
    $content = array_filter($content, function ($task) use ($search) {
        if ($search === "") {
            return true;
        }
        return stripos($task, $search) !== false;
    });
}