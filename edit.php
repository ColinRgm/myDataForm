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



/* -- TRY ------------------------------------------------------------------------------------------------------------*/
if (isset($_POST['update'])) {




/* -- Users ----------------------------------------------------------------------------------------------------------*/
    $stmtUpdateUsers = $pdo->prepare(
        'UPDATE Users SET first_name=:first_name, Last_name=:Last_name, birthdate=:birthdate, email=:email, phone=:phone, civility=:civility, sex=:sex WHERE id_user=:id_user'
    );

    $stmtUpdateUsers->execute([
            'first_name' => $_POST['first_name'],
            'Last_name' => $_POST['Last_name'],
            'birthdate' => $_POST['birthdate'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'civility' => $_POST['civility'],
            'sex' => $_POST['sex'],
            'id_user' => $_GET['id']
        ]
    );

    $stmtTry = $stmtUpdateUsers->fetch();



/* -- Country --------------------------------------------------------------------------------------------------- */
    $country = $_POST['country'];

    $stmt_countryIfExistOrNot = $pdo->prepare(
        'SELECT * FROM Countries WHERE country_name = :countryName'
    );

    $stmt_countryIfExistOrNot->execute([
        'countryName' => $country
    ]);

    $existantCountry = $stmt_countryIfExistOrNot->fetch();

    if ($existantCountry) {
        $id_country = $existantCountry['id_country'];
    } else {
        $stmt_country = $pdo->prepare(
            'INSERT INTO Countries (country_name)
                        VALUE(:country_name)');
        $stmt_country->execute([
            'country_name' => $country
        ]);
        $id_country = $pdo->lastInsertId();
    }


/* -- Adresses ------------------------------------------------------------------------------------------------------ */
    $stmtUpdateAdress = $pdo->prepare(
        'UPDATE Adresses SET street=:street, postal_code=:postal_code, city=:city, Countries_id_country=:Countries_id_country WHERE id_adress=:id_adress'
    );

    $stmtUpdateAdress->execute([
            'street' => $_POST['street'],
            'postal_code' => $_POST['postal_code'],
            'city' => $_POST['city'],
            'id_adress' => $stmtData['id_adress'],
            'Countries_id_country' => $id_country
        ]
    );

    $stmtTryAdress = $stmtUpdateAdress->fetch();





/* -- Afficher modification ----------------------------------------------------------------------------------------- */

    $stmtUsers = $pdo->prepare(
    'SELECT * FROM Users
                
                   JOIN Adresses_has_Users AhU on Users.id_user = AhU.Users_id_user
                   JOIN Adresses A on A.id_adress = AhU.Adresses_id_adress
                   JOIN Countries C on C.id_country = A.Countries_id_country
                        WHERE id_user = :id_user'
    );

    $stmtUsers -> execute(['id_user' => $_GET['id']]);


    $stmtData = $stmtUsers->fetch();

}
?>



<!-- TRY -------------------------------------------------------------------------------------------------------------->
<!-- Formulaire Edit -------------------------------------------------------------------------------------------------->
    <style> <?php include 'style.css';?> </style>

    <div id="goto">
        <p><a href="index.php">Create user</a></p>

        <p><a href="users-list.php">User list</a></p>
    </div>

    <h1 class="title">Modifier donn??es personnelles</h1>
    <form action="edit.php?id=<?= $_GET['id'] ?>" method="POST">
        <div class="grid-container">

            <select name="sex" id="sex" aria-label="">
                <option value="0" <?= ($stmtData ['sex'] == "0") ? "selected" : "" ?>>Monsieur</option>
                <option value="1" <?= ($stmtData ['sex'] == "1") ? "selected" : "" ?>>Madame</option>
            </select>

            <select name="civility" id="civility" aria-label="">
                <option value="0" <?= ($stmtData ['civility'] == "0") ? "selected" : "" ?>>C??libataire</option>
                <option value="1" <?= ($stmtData ['civility'] == "1") ? "selected" : "" ?>>Mari??(e)</option>
                <option value="2" <?= ($stmtData ['civility'] == "2") ? "selected" : "" ?>>Divorc??</option>
            </select>

            <input type="text" id="first_name" name="first_name" aria-label="" placeholder="Pr??nom" value="<?= $stmtData ['first_name']?>">

            <input type="text" id="Last_name" name="Last_name" aria-label="" placeholder="Nom" value="<?= $stmtData ['Last_name']?>">

            <input type="date" id="birthdate" name="birthdate" aria-label="" value="<?= $stmtData ['birthdate']?>">

            <input type="email" id="email" name="email" aria-label="" placeholder="E-Mail" value="<?= $stmtData ['email']?>">

            <input type="tel" id="phone" name="phone" aria-label="" placeholder="N?? t??l" value="<?= $stmtData ['phone']?>">

            <input type="text" id="street" name="street" placeholder="Rue et N??" aria-label="" value="<?= $stmtData ['street']?>">

            <input type="text" id="postal_code" name="postal_code" placeholder="Code postal" aria-label="" value="<?= $stmtData ['postal_code']?>">

            <input type="text" id="city" name="city" placeholder="Ville" aria-label="" value="<?= $stmtData ['city']?>">

            <input type="text" id="country" name="country" placeholder="Pays" aria-label="" value="<?= $stmtData ['country_name']?>">

            <input id="button" name="update" type="submit" value="Modifier"/>
        </div>
    </form>
</body>
</html>
