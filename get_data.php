<?php
require_once "lib.php";

function getTaskData(): void {
    global $content;
    debug_to_console($content, 2);
    if (isset($_POST["index"])) {
        $index = $_POST["index"];

        if (isset($_POST["modifyTaskValue"], $_POST["modifyTask"])) {
            debug_to_console("modifyTaskValue: " . $index, 3);
            if ($content[$index] == $_POST["modifyTaskValue"] || $_POST["modifyTaskValue"] === "") {
                debug_to_console("content not modified", 3);
                debug_to_console($content[$index], 4);
                debug_to_console($content, 4);
                debug_to_console("index" . $index, 4);
                debug_to_console($_POST["modifyTaskValue"], 4);

                return;
            }
            $content[$index] = $_POST["modifyTaskValue"];
        }

        if (isset($_POST["removeTask"])) {
            debug_to_console("removeTask: " . $index, 3);
            array_splice($content, $index, 1);
        }

        if (isset($_POST["moveTaskUp"]) && $index > 0) {
            debug_to_console("moveTaskUp: " . $index, 3);
            debug_to_console($content,4);
            $content = swapIndex($content, $index, $index - 1);
        } elseif (isset($_POST["moveTaskDown"]) && $index < count($content) - 1) {
            debug_to_console("moveTaskDown: " . $index, 3);
            $content = swapIndex($content, $index, $index + 1);
        }

        reload();
    }
}
debug_to_console($content, 1);
getTaskData();

if (isset($_POST["addTask"])) {
    $content[] = $_POST["addTask"];
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
