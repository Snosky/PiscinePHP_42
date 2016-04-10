<?php
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('WEBROOT', $_SERVER['HTTP_HOST']);

include (ROOT.DS.'conf/conf.php');

// Connexion sql
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);

if (!$db) {
    die('Erreur de connexion à la base de donnée: ' . mysqli_connect_error());
}