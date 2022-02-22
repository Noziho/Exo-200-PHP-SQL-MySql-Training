<?php

require __DIR__ . '/Config.php';
require __DIR__ . '/DB_Connect.php';

function delete_content() {
    $id = $_GET['id'];
    $stmt = DB_Connect::dbConnect()->prepare("
        DELETE FROM hiking WHERE id = $id
    ");


    $stmt->execute();

    header("Location: /read.php");
}

delete_content();
