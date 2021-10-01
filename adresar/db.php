<?php

$host = 'localhost';
$dbUser = 'root';
$dbPassowrd = '';
$database = 'adresar2020';
$con = mysqli_connect($host, $dbUser, $dbPassowrd, $database);

if ( mysqli_connect_errno() ) {
    die("neuspesna konekcija" . mysqli_connect_error());
}