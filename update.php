<?php

require_once 'DB_connection.php';

/*
$stmtUpdate = $pdo->prepare(
    'UPDATE Users
                SET first_name = :firstname
                WHERE id_user = :id_user'
);

$stmtUpdate -> execute(
    first_name = $_POST['first_name']
);
*/


$stmtUpdate = "UPDATE Users SET first_name=:first_name WHERE id_user=:id_user";