<?php
require_once 'DB_connection.php'; ?>

<style> <?php include 'style.css'; ?> </style>

<?php
if (isset($_POST['submit'])); {

    $stmt = $pdo->prepare(
            INSERT INTO users (first_name)
    )

}

?>


<h1>Formulaire</h1>
<form action="index.php" method="POST">
    <div class="grid-container">
        <select name="select" id="select" aria-label="">
            <option value="monsieur">Monsieur</option>
            <option value="madame">Madame</option>
        </select>

        <label for="name"></label>
        <input type="text" id="firstname" name="firstname" aria-label="" placeholder="Prénom">

        <label for="name"></label>
        <input type="text" id="name" name="name" placeholder="Nom">

        <label for="bday"></label>
        <input type="date" id="bday" name="bday">

        <label for="name"></label>
        <input type="email" id="email" name="email" aria-label="" placeholder="E-Mail">

        <label for="tel"></label>
        <input type="tel" id="tel" name="tel" aria-label="" placeholder="N° tél">

        <label for="name"></label>
        <input type="text" id="adress" name="adress" placeholder="Rue" aria-label="">

        <label for="name"></label>
        <input type="text" id="num" name="num" placeholder="N°" aria-label="">

        <label for="name"></label>
        <input type="text" id="npa" name="npa" placeholder="Code postal" aria-label="">

        <label for="name"></label>
        <input type="text" id="city" name="city" placeholder="Ville" aria-label="">

        <input id="button" name="submit" type="submit" value="Envoyer"/>
    </div>
</form>
