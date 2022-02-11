<?php
require_once 'DB_connection.php'; ?>

<style> <?php include 'style.css'; ?> </style>

<?php
if (isset($_POST['submit'])) {

    $stmt = $pdo->prepare(
            'INSERT INTO Users (first_name, Last_name, birthdate, email, phone, civility, sex)
            VALUES(:first_name, :Last_name, :birthdate, :email, :phone, :civility, :sex)'
    );

    $stmt->execute([
         'first_name' => $_POST['first_name'],
         'Last_name' => $_POST['Last_name'],
         'birthdate' => $_POST['birthdate'],
         'email' => $_POST['email'],
         'phone' => $_POST['phone'],
         'civility' => $_POST['civility'],
         'sex' => $_POST['sex']
        ]
    );
    $id_user = $pdo->lastInsertId();
} var_dump($stmt);

?>

























<h1>Formulaire</h1>
<form action="index.php" method="POST">
    <div class="grid-container">

        <label for="sex"></label>
        <select name="sex" id="sex">
            <option value="0">Monsieur</option>
            <option value="1">Madame</option>
        </select>

        <label for="civility"></label>
        <select name="civility" id="civility">
            <option value="0">Célibataire</option>
            <option value="1">Marié</option>
            <option value="2">Divorcé</option>
        </select>

        <label for="first_name"></label>
        <input type="text" id="first_name" name="first_name" aria-label="" placeholder="Prénom">

        <label for="Last_name"></label>
        <input type="text" id="Last_name" name="Last_name" placeholder="Nom">

        <label for="birthdate"></label>
        <input type="date" id="birthdate" name="birthdate">

        <label for="email"></label>
        <input type="email" id="email" name="email" aria-label="" placeholder="E-Mail">

        <label for="phone"></label>
        <input type="tel" id="phone" name="phone" aria-label="" placeholder="N° tél">

        <label for="adress"></label>
        <input type="text" id="adress" name="adress" placeholder="Rue" aria-label="">

        <label for="num"></label>
        <input type="text" id="num" name="num" placeholder="N°" aria-label="">

        <label for="npa"></label>
        <input type="text" id="npa" name="npa" placeholder="Code postal" aria-label="">

        <label for="city"></label>
        <input type="text" id="city" name="city" placeholder="Ville" aria-label="">

        <input id="button" name="submit" type="submit" value="Envoyer"/>
    </div>
</form>
