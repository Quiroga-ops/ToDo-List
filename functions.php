<?php
function get_pending_tasks($conn) {
    $tasks = array();
    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE status='pending'");
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }
    return $tasks;
}

function get_completed_tasks($conn) {
    $tasks = array();
    $result = mysqli_query($conn, "SELECT * FROM tasks WHERE status='completed'");
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }
    return $tasks;
}

function add_task($conn, $task) {
    mysqli_query($conn, "INSERT INTO tasks (task, status) VALUES ('$task', 'pending')");
}

function complete_task($conn, $id) {
    mysqli_query($conn, "UPDATE tasks SET status='completed' WHERE id=$id");
}

function delete_task($conn, $id) {
    mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
}