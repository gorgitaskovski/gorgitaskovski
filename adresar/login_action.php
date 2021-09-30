<?php

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

if ( empty($username) || empty($password) ) {
    header('location: login.php?errorMsg=1');
    exit;
}

include './db.php';

$sql = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
$result = mysqli_query($con, $sql);

$numberOfAcconts = mysqli_num_rows($result);
$account = mysqli_fetch_assoc($result);

mysqli_close($con);

if ( $numberOfAcconts >= 1 ) {
    include 'session.php';
    $_SESSION['account'] = $account;
    header('location: index.php');
    exit;
} else {
    header('location: login.php?errorMsg=2');
    exit;
}