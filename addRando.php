<?php
require __DIR__ . '/Config.php';
require __DIR__ . '/DB_Connect.php';
require __DIR__ . '/checkForm.php';

if (!formIsset('name', 'difficulty', 'distance', 'duration', 'height_difference', 'validate')) {
    header("Location: /index.php");
    exit();
}



function add_content ($name, $difficulty, $distance, $duration, $height_difference) {
    $stmt = DB_Connect::dbConnect()->prepare("
        INSERT INTO hiking (name, difficulty, distance, duration, height_difference)
        VALUES (:name, :difficulty, :distance, :duration, :height_difference)
    ");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':distance', $distance);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':height_difference', $height_difference);

    $stmt->execute();
}

add_content($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference']);

header("Location: /create.php?f=0");