<?php
require_once "lib.php";

function getTaskData(): void {
    global $content;
    if (isset($_POST["index"])) {
        $index = $_POST["index"];

        if (isset($_POST["modifyTaskValue"], $_POST["modifyTask"]) && validSize($_POST["modifyTaskValue"])) {
            if (get_index_title($content,$index) == $_POST["modifyTaskValue"] ) {
                return;
            }
            else {
                $content = set_index_title($content,$index,$_POST["modifyTaskValue"]);
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

        update_tasks_in_db($content);
        reload();
    }
}
getTaskData();

if (isset($_POST["addTask"])) {
    if (validSize($_POST["addTask"])) {
        add_task_to_db($_POST["addTask"]);
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
