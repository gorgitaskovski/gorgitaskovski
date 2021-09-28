<?php

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

if( empty($username) || empty($password) ){
    header('location: login?errorMsg=1');
    exit;
}

include 'database.php';

$sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($con, $sql);
$account = mysqli_fetch_assoc($result);
$numberOfAccounts = mysqli_num_rows($result);

mysqli_close($con);

if( $numberOfAccounts >= 1 ){
    include 'session.php';
    $_SESSION['account'] = $account;
    header('location: index');
    exit;
} else{
    header('location: login?errorMsg=2');
    exit;
}