<?php
require_once 'DB_connection.php'; ?>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Document</title>
</head>
<body>



<style> <?php include 'style.css'; ?></style>
<?php
if (isset($_POST['submit'])){

    $stmtNameEvent = $pdo->prepare(
            'INSERT INTO Events (id_event, name, description, start_time, end_time)
                VALUES (:id_event, :name, :description, :start_time, :end_time)');

    $stmtNameEvent->execute([
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'start_time' => $_POST['start_time'],
        'end_time' => $_POST['end_time'],

    ]);
}

?>


<div id="goto">
    <p><a href="index.php">Create user</a></p>

    <p><a href="users-list.php">User list</a></p>
</div>
<!-- Formulaire 2 ----------------------------------------------------------------------------------------------------->
    <h1 class="title">Evénements</h1>
    <form action="events.php" method="POST">
        <div class="grid-container-2">

            <input type="text" id="name" name="name" aria-label="" placeholder="Nom de l'événement">

            <textarea style="resize: none;" id="description" name="description" placeholder="Description de l'événement" aria-label=""></textarea>

            <input type="datetime-local" id="start_time" name="start_time" aria-label="">

            <input type="datetime-local" id="end_time" name="end_time" aria-label="">

            <input id="submit" name="submit" type="submit" value="Envoyer"/>
        </div>
    </form>

</body>
</html>