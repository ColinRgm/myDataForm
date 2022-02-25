<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="is-half, initial-scale=1">
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

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

        ?>
<body>
<div id="goto">
    <p><a href="index.php">Create user</a></p>

    <p><a href="events.php">Create events</a></p>
</div>
<p class="title">Utilisateurs</p>
<!-- Card utilisateur ------------------------------------------------------------------------------------------------->


<?php while ($row = $stmtUserAndAdress->fetch()) { ?>

    <div class="container is-2">
        <div class="carduser">
            <div class="card-content">
                <div class="media">
                    <div class="media-content">

                        <p class="title is-3"><?php echo"{$row['first_name']} {$row['Last_name']}"?></p>
                        <p class="title is-4">Adresse</p>
                        <p class="subtitle"><?php echo "{$row['street']}"?>, <?php echo"{$row['postal_code']} {$row['city']}"?> </p>

                    </div>
                </div>
            </div>
            <div class="card">
                <footer class="card-footer">
                    <a href="edit.php?id=<?php echo $row['id_user'];?>" class="card-footer-item"><b>Edit</b></a>
                    <a href="#" class="card-footer-item"><b>Delete</b></a>
                </footer>
            </div>
        </div>
    </div>

<?php
        }
?>



<!-- Boutons ---------------------------------------------------------------------------------------------------------->


</body>
</html>