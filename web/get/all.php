<?php

use App\Model\usuarios as usuarios;

$usuarios = new usuarios();

foreach ($usuarios->getAll() as $usuario) {
    echo $usuario->toJson();
}
?>