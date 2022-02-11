<?php
require_once 'DB_connection.php';?>
<style> <?php include 'style.css';?> </style>
<?php

$stmtUserAndAdress = $pdo->prepare(
        'SELECT * FROM Users'
)


?>