<?php

// llamar a serve.php con un try catch para evitar multiples llamados 

try {
    require_once '../serve.php';
} catch (Exception $e) {
    echo 'An error occurred';
    error_log($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>