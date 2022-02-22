<?php
require __DIR__ . '/Config.php';
require __DIR__ . '/DB_Connect.php';
$id = $_GET['id'];

$stmt = DB_Connect::dbConnect()->prepare("
    SELECT * FROM hiking WHERE id = $id
");

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/addOrUpdateRando.php?id=<?= $_GET['id'] ?>&e=0" method="post"><?php
    if ($stmt->execute()) {
    foreach ($stmt->fetchAll() as $value) { ?>
    <input type="text" name="name" placeholder="Nom de la randonnée" value="<?= $value['name'] ?>" required minlength="5" maxlength="80">
    <select name="difficulty" id="difficulty" required>
        <option value="<?= $value['difficulty'] ?>"><?= $value['difficulty'] ?></option>
        <option value="très facile">Très facile</option>
        <option value="facile">Facile</option>
        <option value="moyen">Moyen</option>
        <option value="difficile">Difficile</option>
        <option value="très difficile">Très difficile</option>
    </select>
    <input type="number" name="distance" placeholder="Distance" value="<?= $value['distance'] ?>" required>
    <!-- Ajoutez un / des champs pour gérer la donnée de type time à insérer via PHP -->
    <input type="time" name="duration" value="<?= $value['duration'] ?>" required>
    <input type="number" name="height_difference" placeholder="Dénivelée" value="<?= $value['height_difference'] ?>" required>

    <select name="available" id="available" required>
        <option value="<?= $value['available']?>"><?= $value['available']?></option>
        <option value="Oui">Oui</option>
        <option value="Non">Non</option>
    </select>

    <input type="submit" name="validate" value="Modifiez">
</form><?php

}

}?>


<a href="/read.php">Retour arrière</a>
</body>
</html>