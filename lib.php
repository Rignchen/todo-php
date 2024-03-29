<?php

// database
function connect_db(): PDO {
    return new PDO('sqlite:data.db');
}
function get_task_from_db(): array {
    global $pdo;

    $query = "SELECT * FROM task";

    $is_query_search = (isset($_GET["search"]) and len($_GET["search"]) > 0);
    if ($is_query_search) $query .= stripos($query, "where") === false ? " where title like ?" : " and title like ?";

    if (isset($_GET["sort"])) {
        if ($_GET["sort"] === "alpha") $query .= " ORDER BY title collate nocase";
        elseif ($_GET["sort"] === "reverse") $query .= " ORDER BY title collate nocase DESC";
    }

    $sql = $pdo->prepare($query);

    if ($is_query_search) $sql->execute(["%" . $_GET["search"] . "%"]);
    else $sql->execute();

    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function add_task_to_db($task): void {
    global $pdo;
    $sql = $pdo->prepare("INSERT INTO `task` (title) VALUES (?)");
    $sql->execute([$task]);
}
function update_tasks_in_db($contents): void {
    global $pdo;
    foreach ($contents as $data) {
        $sql = $pdo->prepare("UPDATE `task` SET title = :title WHERE id = :id");
        $sql->execute($data);
    }
}
function delete_task_from_db($id): void {
    global $pdo;
    $sql = $pdo->prepare("DELETE FROM `task` WHERE id = ?");
    $sql->execute([$id]);
}

// errors
function get_errors(): array {
    if (!isset($_SESSION["errors"])) return [];
    return $_SESSION["errors"];
}
function sendError($message): void {
    if (!isset($_SESSION["errors"])) $_SESSION["errors"] = [];
    $_SESSION["errors"][] = $message;
}

// web page
function reload(): void {
    header("Location: " . $_SERVER["PHP_SELF"]);
}

// array
function swapIndex($array, $index1, $index2) {
    $temp = get_index_title($array, $index1);
    $array[$index1]["title"] = get_index_title($array, $index2);
    $array[$index2]["title"] = $temp;
    return $array;
}
function get_title($value): string {
    return $value["title"];
}
function get_id($value): int {
    return $value["id"];
}
function get_index_title($array,$index): string {
    return get_title(($array[$index]));
}
function set_index_title($array,$index,$value): array {
    $array[$index]["title"] = $value;
    return $array;
}
function get_index_from_id(mixed $id) {
    global $content;
    foreach ($content as $index => $data) {
        if (get_id($data) == $id) {
            return $index;
        }
    }
    return -1;
}

// size
function len($value): int {
    if (is_array($value)) return count($value);
    elseif (is_string($value)) return mb_strlen($value);
    else return 0;
}
function validSize($task, $min = 3, $max = 100): bool {
    if (len($task) < $min || len($task) > $max) {
        sendError(
            ((len($task) < $min) ? "Size is too short" : "Size is too long") . ", " .
            ((($min === $max) ? "size must be " . $min . " characters long" : "size must be between " . $min . " and " . $max . " characters long"))
        );
        return false;
    }
    return true;
}

// debug
function get_debug_messages($data, $position): string {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    return "Debug Objects, pos " . $position . ": " . htmlspecialchars($output);
}
function debug_to_console($data, $position): void {
    echo "<script>console.log('" . get_debug_messages($data, $position) . "');</script>";
}
function debug_to_alert($data, $position): void {
    echo "<script>alert('" . get_debug_messages($data, $position) . "');</script>";
}
