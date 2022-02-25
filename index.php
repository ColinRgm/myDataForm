<?php
require_once 'DB_connection.php'; ?>

<style> <?php include 'style.css'; ?> </style>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>MyData_Form</title>
</head>
<body>



<?php
if (isset($_POST['submit'])) {



    /* -- Country --------------------------------------------------------------------------------------------------- */
    $country = $_POST['country'];

    $stmt_countryIfExistOrNot = $pdo->prepare(
        'SELECT * FROM Countries WHERE country_name = :countryName'
    );

    $stmt_countryIfExistOrNot->execute([
        'countryName' => $country
    ]);

    $existantCountry = $stmt_countryIfExistOrNot->fetchAll();

    if ($existantCountry) {
        $id_country = $existantCountry[0]['id_country'];
    } else {
        $stmt_country = $pdo->prepare(
            'INSERT INTO Countries (country_name)
                    VALUE(:country_name)');
        $stmt_country->execute([
            'country_name' => $country
        ]);
        $id_country = $pdo->lastInsertId();
    }



    /* -- Adresses -------------------------------------------------------------------------------------------------- */
    $stmt_adress = $pdo->prepare(
        'INSERT INTO Adresses (street, postal_code, city, Countries_id_country)
                VALUES (:street, :postal_code, :city, :Countries_id_country)');
    $stmt_adress->execute([
        'street' => $_POST['adress'],
        'postal_code' => $_POST['npa'],
        'city' => $_POST['city'],
        'Countries_id_country' => $id_country,
    ]);
    $id_address = $pdo->lastInsertId();



    /* -- Utilisateurs ---------------------------------------------------------------------------------------------- */
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



    /* -- Adresses d'utilisateur ------------------------------------------------------------------------------------ */
    $stmtAdressHasUsers = $pdo->prepare(
        'INSERT INTO Adresses_has_Users (Adresses_id_adress, Users_id_user)
                VALUES (:Adresses_id_adress, :Users_id_user)'
    );
    $stmtAdressHasUsers->execute([
        'Users_id_user' => $id_user,
        'Adresses_id_adress' => $id_address
    ]);
}

?>


<div id="goto">
    <p><a href="users-list.php">User list</a></p>

    <p><a href="events.php">Create events</a></p>
</div>
<!-- Formulaire ------------------------------------------------------------------------------------------------------->
<h1 class="title">Données personnelles</h1>
<form action="index.php" method="POST">
    <div class="grid-container">

        <select name="sex" id="sex" aria-label="">
            <option value="0">Monsieur</option>
            <option value="1">Madame</option>
        </select>

        <select name="civility" id="civility" aria-label="">
            <option value="0">Célibataire</option>
            <option value="1">Marié</option>
            <option value="2">Divorcé</option>
        </select>

        <input type="text" id="first_name" name="first_name" aria-label="" placeholder="Prénom">

        <input type="text" id="Last_name" name="Last_name" aria-label="" placeholder="Nom">

        <input type="date" id="birthdate" name="birthdate" aria-label="">

        <input type="email" id="email" name="email" aria-label="" placeholder="E-Mail">

        <input type="tel" id="phone" name="phone" aria-label="" placeholder="N° tél">

        <input type="text" id="adress" name="adress" placeholder="Rue et N°" aria-label="">

        <input type="text" id="npa" name="npa" placeholder="Code postal" aria-label="">

        <input type="text" id="city" name="city" placeholder="Ville" aria-label="">

        <input type="text" id="country" name="country" placeholder="Pays" aria-label="">

        <input id="button" name="submit" type="submit" value="Envoyer"/>
    </div>
</form>

</body>
</html>