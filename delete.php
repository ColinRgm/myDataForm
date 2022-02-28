<?php

    require_once 'DB_connection.php';

    $stmtUserAndAdress = $pdo->prepare(
        'SELECT * FROM Users
                           INNER JOIN Adresses_has_Users AhU on Users.id_user = AhU.Users_id_user
                           INNER JOIN Adresses A on AhU.Adresses_id_adress = A.id_adress
                           INNER JOIN Countries C on A.Countries_id_country = C.id_country
                           WHERE id_user = :id_user'
    );
    $stmtUserAndAdress ->execute(['id_user' => $_GET['id']]);

    $stmtDelete = $stmtUserAndAdress->fetch();

/* -- Delete Adresses has users --------------------------------------------------------------------------------------*/

    $stmtDelete = $pdo->prepare(
        'DELETE FROM Adresses_has_Users
            WHERE Users_id_user = :Users_id_user'
    );

    $stmtDelete->execute(['Users_id_user' => $_GET['id']]);

/* -- Delete Users ---------------------------------------------------------------------------------------------------*/

    $stmtDelete = $pdo->prepare(
        'DELETE FROM Users
            WHERE id_user = :id_user'
    );

    $stmtDelete->execute(['id_user' => $_GET['id']]);

/* -- Delete Adresses ------------------------------------------------------------------------------------------------*/

    $stmtDelete = $pdo->prepare(
        'DELETE FROM Adresses
            WHERE id_adress = :id_adress'
    );

    $stmtDelete->execute(['id_adress' => $_POST['id_adress']]);

/* -- Retour à la liste ----------------------------------------------------------------------------------------------*/

    header('location: users-list.php');

    var_dump($stmtDelete);