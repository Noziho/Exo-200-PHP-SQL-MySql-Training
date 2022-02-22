<?php
require __DIR__ . '/Config.php';
require __DIR__ . '/DB_Connect.php';
require __DIR__ . '/checkForm.php';

if (!formIsset('name', 'difficulty', 'distance', 'duration', 'height_difference', 'validate')) {
    header("Location: /index.php");
    exit();
}

$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$difficulty = filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING);
$distance = filter_var($_POST['distance'], FILTER_SANITIZE_NUMBER_INT);
$duration = filter_var($_POST['duration'], FILTER_SANITIZE_NUMBER_INT);
$height_difference = filter_var($_POST['height_difference'], FILTER_SANITIZE_NUMBER_INT);
$available = filter_var($_POST['available'], FILTER_SANITIZE_STRING);


checkFilter($name);
checkFilter($difficulty);
checkFilter($distance);
checkFilter($duration);
checkFilter($height_difference);
checkFilter($available);


checkRange($name, 5, 80, '/index.php');
checkRange($distance, 0, 2000, '/index.php');
checkRange($duration, 0, 6000, '/index.php');
checkRange($height_difference, 0, 2000, '/index.php');

function add_content ($name, $difficulty, $distance, $duration, $height_difference, $available) {
    $stmt = DB_Connect::dbConnect()->prepare("
        INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available)
        VALUES (:name, :difficulty, :distance, :duration, :height_difference, :available)
    ");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':difficulty', $difficulty);
    $stmt->bindParam(':distance', $distance);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':height_difference', $height_difference);
    $stmt->bindParam(':available', $available);

    $stmt->execute();
}

function update_content ($name, $difficulty, $distance, $duration, $height_difference, $available) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = DB_Connect::dbConnect()->prepare("
        UPDATE hiking SET name = :name,
                          difficulty = :difficulty,
                          distance = :distance,
                          duration = :duration,
                          height_difference = :height_difference,
                          available = :available WHERE id = $id
    ");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':difficulty', $difficulty);
        $stmt->bindParam(':distance', $distance);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':height_difference', $height_difference);
        $stmt->bindParam(':available', $available);

        $stmt->execute();

        header("Location: /read.php");
    }




}

if (isset($_GET['d'])) {
    add_content($name, $difficulty, $distance, $duration, $height_difference, $available);
    header("Location: /create.php?f=0");
}

if (isset($_GET['e'])) {
    update_content($name, $difficulty, $distance, $duration, $height_difference, $available);
    header("Location: /read.php");
}



