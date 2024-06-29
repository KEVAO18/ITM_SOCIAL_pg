<?php

try {
    require_once '../serve.php';
} catch (Exception $e) {
    echo 'An error occurred';
    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php

    require_once __DIR__.'/../web/welcome.php';

    ?>
</body>
</html>