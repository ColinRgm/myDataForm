<?php
    require_once 'DB_connection.php';

    $stmtUsers = $pdo->prepare(
        'SELECT * FROM Users
                    
                   JOIN Adresses_has_Users AhU on Users.id_user = AhU.Users_id_user
                   JOIN Adresses A on A.id_adress = AhU.Adresses_id_adress
                   JOIN Countries C on C.id_country = A.Countries_id_country
                        WHERE id_user = :id_user'
    );

    $stmtUsers -> execute(['id_user' => $_GET['id']]);

    $stmtData = $stmtUsers->fetch();
?>

<style> <?php include 'style.css';?> </style>

<!-- Formulaire Edit -------------------------------------------------------------------------------------------------->
<h1 class="title">Modifier données personnelles</h1>
<form action="edit.php" method="POST">
    <div class="grid-container">

        <select name="sex" id="sex" aria-label="">
            <option value="0" <?= ($stmtData ['sex'] == "0") ? "selected" : "" ?>>Monsieur</option>
            <option value="1" <?= ($stmtData ['sex'] == "1") ? "selected" : "" ?>>Madame</option>
        </select>

        <select name="civility" id="civility" aria-label="">
            <option value="0" <?= ($stmtData ['civility'] == "1") ? "selected" : "" ?>>Célibataire</option>
            <option value="1" <?= ($stmtData ['civility'] == "1") ? "selected" : ""?>>Marié(e)</option>
            <option value="2" <?= ($stmtData ['civility'] == "2") ? "selected" : "" ?>>Divorcé</option>
        </select>

        <input type="text" id="first_name" name="first_name" aria-label="" placeholder="Prénom" value="<?= $stmtData ['first_name']?>">

        <input type="text" id="Last_name" name="Last_name" aria-label="" placeholder="Nom" value="<?= $stmtData ['Last_name']?>">

        <input type="date" id="birthdate" name="birthdate" aria-label="" value="<?= $stmtData ['birthdate']?>">

        <input type="email" id="email" name="email" aria-label="" placeholder="E-Mail" value="<?= $stmtData ['email']?>">

        <input type="tel" id="phone" name="phone" aria-label="" placeholder="N° tél" value="<?= $stmtData ['phone']?>">

        <input type="text" id="adress" name="adress" placeholder="Rue et N°" aria-label="" value="<?= $stmtData ['street']?>">

        <input type="text" id="npa" name="npa" placeholder="Code postal" aria-label="" value="<?= $stmtData ['postal_code']?>">

        <input type="text" id="city" name="city" placeholder="Ville" aria-label="" value="<?= $stmtData ['city']?>">

        <input type="text" id="country" name="country" placeholder="Pays" aria-label="" value="<?= $stmtData ['country_name']?>">

        <input id="button" name="submit" type="submit" value="Envoyer"/>
    </div>
</form>

<div id="goto">
    <p><a href="index.php"><< Go to Sign In</a></p>

    <p><a href="users-list.php"><< Go back to User List</a></p>

    <p><a href="events.php">Go to events >></a></p>
</div>