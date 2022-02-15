<?php
require_once 'DB_connection.php'; ?>
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



<!-- Formulaire 2 ----------------------------------------------------------------------------------------------------->
        <h1>Evénements</h1>
        <form action="events.php" method="POST">
            <div class="grid-container-2">

                <input type="text" id="name" name="name" aria-label="" placeholder="Nom de l'événement">

                <textarea style="resize: none;" id="description" name="description" placeholder="Description de l'événement" aria-label=""></textarea>

                <input type="datetime-local" id="start_time" name="start_time" aria-label="">

                <input type="datetime-local" id="end_time" name="end_time" aria-label="">

                <input id="submit" name="submit" type="submit" value="Envoyer"/>
            </div>
        </form>
        <div id="goto">
            <p><a href="index.php"><< Go back to users</a></p>

            <p><a href="users-list.php">Go to users >></a></p>
        </div>