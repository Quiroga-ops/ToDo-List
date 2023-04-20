<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="cat.png"/>
    <link rel="stylesheet" href="./style.css">
    <title>Nightly | ToDoList App 😁</title>
</head>
<body>

<div>
<h1>ToDoList App</h1>
    <form action="add_task.php" method="post">
        <input type="text" name="task" placeholder="Agregar tarea">
        <button type="submit">Agregar</button>
    </form>
    <br>
    <h2>Tareas Pendientes</h2>
    <ul>
        <?php
        require_once 'config.php';
        require_once 'functions.php';
        $tasks = get_pending_tasks($conn);
        foreach ($tasks as $task) {
            echo '<li>' . $task['task'] . '<a href="complete_task.php?id=' . $task['id'] . '"> Completar</a></li>';
        }
        ?>
    </ul>
    <br>
    <h2>Tareas Completadas</h2>
    <ul>
        <?php
        $tasks = get_completed_tasks($conn);
        foreach ($tasks as $task) {
            echo '<li>' . $task['task'] . '<a href="delete_task.php?id=' . $task['id'] . '"> Eliminar</a></li>';
        }
        ?>
    </ul>

</div>
<div>
    <video id="video" autoplay></video><br>
    <button id="record">Grabar</button>
</div>
    
    <script src="./script.js"></script>
</body>
</html>