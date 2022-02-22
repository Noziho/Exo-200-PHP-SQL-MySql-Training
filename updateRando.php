<?php
require __DIR__ . '/Config.php';
require __DIR__ . '/DB_Connect.php';
function formIsset (...$inputNames): bool {
    foreach ($inputNames as $inputName) {
        if (!isset($_POST[$inputName])) {
            return false;
        }
    }
    return true;
}

if (!formIsset('name', 'difficulty', 'distance', 'duration', 'height_difference', 'validate')) {
    header("Location: /read.php");
    exit();
}

function update_content ($name, $difficulty, $distance, $duration, $height_difference) {
    $id = $_GET['id'];
    $stmt = DB_Connect::dbConnect()->prepare("
        UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference WHERE id = $id
    ");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':distance', $distance);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':height_difference', $height_difference);

    $stmt->execute();
}

update_content($_POST['name'], $_POST['difficulty'], $_POST['distance'], $_POST['duration'], $_POST['height_difference']);

header("Location: /read.php?f=0");