<?php

$mode = "prod.";

if ($mode === 'prod') {
    $db_name = 'mysql:host=localhost;dbname=movegolf_db';
    $user_name = 'movegolf_db';
    $user_password = 'Y5PPd2DwsqVWky8YR2TN';
    $conn = new PDO($db_name, $user_name, $user_password);
} else {

    $db_name = 'mysql:host=localhost;dbname=movegolf_db';
    $user_name = 'root';
    $user_password = '';
    $conn = new PDO($db_name, $user_name, $user_password);
}
