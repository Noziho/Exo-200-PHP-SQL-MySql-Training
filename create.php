
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Randonnées, ajout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if (isset($_GET['f'])) {?>
    <div class="absolute">La randonnée à été ajouter avec succès.</div><?php
}
?>
    <form action="/addOrUpdateRando.php?d=0" method="post">
        <input type="text" name="name" placeholder="Nom de la randonnée" required minlength="5" maxlength="80">
        <select name="difficulty" id="difficulty" required >
            <option value="très facile">Très facile</option>
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
            <option value="très difficile">Très difficile</option>
        </select>
        <input type="number" name="distance" placeholder="Distance" required>
        <!-- Ajoutez un / des champs pour gérer la donnée de type time à insérer via PHP -->
        <input type="time" name="duration" required>
        <input type="number" name="height_difference" placeholder="Dénivelée" required>

        <input type="submit" name="validate">
    </form>
<a href="/index.php">Home</a>
</body>
</html>