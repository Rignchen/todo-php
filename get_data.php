<?php
require_once "lib.php";

function getTaskData(): void {
    global $content;
    if (isset($_POST["index"])) {
        $index = $_POST["index"];

        if (isset($_POST["modifyTaskValue"], $_POST["modifyTask"])) {
            if (len($_POST["modifyTaskValue"]) < 3 || len($_POST["modifyTaskValue"]) > 100) {
                sendError("Task is too short or too long, 3-100 characters per tasks are required!");
            }
            elseif ($content[$index] == $_POST["modifyTaskValue"] ) {
                return;
            }
            else {
                $content[$index] = $_POST["modifyTaskValue"];
            }
        }

        if (isset($_POST["removeTask"])) {
            array_splice($content, $index, 1);
        }

        if (isset($_POST["moveTaskUp"]) && $index > 0) {
            $content = swapIndex($content, $index, $index - 1);
        } elseif (isset($_POST["moveTaskDown"]) && $index < len($content) - 1) {
            $content = swapIndex($content, $index, $index + 1);
        }

        reload();
    }
}
getTaskData();

if (isset($_POST["addTask"])) {
    if (len($_POST["modifyTaskValue"]) < 3) {
        sendError("Task is too short, 3 characters minimum per tasks are required!");
    }
    else {
        $content[] = $_POST["addTask"];
    }
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
