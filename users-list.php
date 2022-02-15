<?php
require_once 'DB_connection.php';?>
<style> <?php include 'style.css';?> </style>
<?php



/* -- Afficher les infos des utilisateurs --------------------------------------------------------------------------- */
        $stmtUserAndAdress = $pdo->prepare(
                'SELECT * FROM Adresses_has_Users
                    JOIN Adresses A on A.id_adress = Adresses_has_Users.Adresses_id_adress
                    JOIN Countries C on C.id_country = A.Countries_id_country
                    JOIN Users U on Adresses_has_Users.Users_id_user = U.id_user'
                );
        $stmtUserAndAdress -> execute();
        $user = $stmtUserAndAdress ->fetchAll();

        foreach ($user as $row){
            echo "{$row['first_name']} - {$row['Last_name']} - {$row['street']} - {$row['postal_code']} - {$row['city']} - {$row['country_name']} - {$row['birthdate']} - {$row['email']} - {$row['phone']} - {$row['sex']} - {$row['civility']}<br> ";
        }
?>


<!-- Boutons ---------------------------------------------------------------------------------------------------------->
        <div>
            <p><a href="index.php"><< Go back to sign in</a></p>
        </div>
        <div>
            <p><a href="events.php">Go to events >></a></p>
        </div>
