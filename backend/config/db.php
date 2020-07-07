<?php
// Dit zijn de MYSQL inloggegevens.
// Zorg dat deze gegevens overeenkomen met de gegevens van de MYSQL server.
define('SERVER', '127.0.0.1');
define('USERNAME', 'root');
define('PASSWORD', '');
define('NAME', 'rensmlj378_back');

$link = mysqli_connect(SERVER, USERNAME, PASSWORD, NAME);

if ($link === false) die('ERROR: Could not connect. ' . mysqli_connect_error());

?>