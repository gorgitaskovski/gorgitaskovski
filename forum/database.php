<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$database = 'forum';

$con = mysqli_connect($dbHost, $dbUser, $dbPassword, $database);

if( mysqli_errno($con) ){
    die('neuspesna konekcijata do baza ') . mysqli_error($con);
}