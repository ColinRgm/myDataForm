<?php
$idUser = $_GET['id_user'];
?>

<style> <?php include 'style.css';?> </style>


<h1>Modifier données personnelles</h1>
<form action="edit.php" method="POST">
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

<div id="goto">
    <p><a href="index.php"><< Go back to Sign In</a></p>

    <p><a href="events.php">Go to events >></a></p>
</div>