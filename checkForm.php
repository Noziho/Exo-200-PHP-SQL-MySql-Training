<?php
function formIsset (...$inputNames): bool {
    foreach ($inputNames as $inputName) {
        if (!isset($_POST[$inputName])) {
            return false;
        }
    }
    return true;
}

function checkRange (string$value, int$min, int$max, $redirect):void {
    if (strlen($value) < $min || strlen($value) > $max) {
        header("Location: ". $redirect);
        exit();
    }

}

function getSecuredIntPostData(string $name, int $defaultValue = 0): int {
    $data = $_POST[$name] ?? $defaultValue;
    return (int)$data;
}

function checkFilter($var) {
    if (!$var) {
        header("Location: /index.php");
    }
};