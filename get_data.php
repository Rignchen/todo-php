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
    if ($_GET["sort"] === "alphabetically") {
        natcasesort($content);
    }
    elseif ($_GET["sort"] === "analphabetically") {
        natcasesort($content);
        $content = array_reverse($content);
    }
}
