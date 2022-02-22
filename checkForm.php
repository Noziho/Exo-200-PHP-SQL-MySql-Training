<?php
function formIsset (...$inputNames): bool {
    foreach ($inputNames as $inputName) {
        if (!isset($_POST[$inputName])) {
            return false;
        }
    }
    return true;
}

function checkRange($inputName, $min, $max, $redirect) {
    if (strlen($_POST[$inputName]) < $min || strlen($_POST[$inputName]) > $max) {
        header("Location: /$redirect");
    }
}