<?php

/**
 * 
 * @KEVAO18
 * 
 */

session_start();

require('vendor/autoload.php');

use Dotenv\Dotenv as de;

$dotenv = de::createImmutable(__DIR__);

$dotenv->load();

include_once(
    $_ENV['FILE_ROUTE']
);

use config\routesController as r;

$ruta = new r();

include_once(
    cargarDatos("FOLDER_MODEL","/usuarios")
);

include_once(
    cargarDatos("FOLDER_MODEL","/tipos_de_credenciales")
);

include_once(
    cargarDatos("FOLDER_MODEL","/credenciales")
);

include_once(
    cargarDatos("FOLDER_MODEL","/comunidades")
);

include_once(
    cargarDatos("FOLDER_MODEL","/eventos")
);

include_once(
    cargarDatos("FOLDER_MODEL","/mensajes")
);

include_once(
    cargarDatos("FOLDER_MODEL","/chats")
);

include_once(
    cargarDatos("FOLDER_MODEL","/usuarios_en_chat")
);

include_once(
    cargarDatos("FOLDER_MODEL","/post")
);

include_once(
    cargarDatos("FOLDER_MODEL","/comentarios")
);

function cargarDatos(string $carpeta, string $clase) : string {
    
    return $_ENV[$carpeta].$clase.".php";
}

?>