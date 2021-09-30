<?php

include './session.php';

if ( !isset($_SESSION['account']) ) {
    header('location: login.php');
    exit;
}

$firstName = filter_input(INPUT_POST, 'first_name');
$lastName = filter_input(INPUT_POST, 'last_name');
$phoneNumber = filter_input(INPUT_POST, 'phone_number');
$accountId = $_SESSION['account']['account_id'];

if ( empty($firstName) || empty($lastName) || empty($phoneNumber) ) {
    header('location: add_contact.php?errorMsg=1');
    exit;
}

include 'db.php';
$sql = "INSERT INTO contacts (contact_first_name, contact_last_name, contact_number, account_id) "
        . "VALUES ('$firstName', '$lastName', '$phoneNumber', $accountId)";
$result = mysqli_query($con, $sql);

mysqli_close($con);

if ($result == true) {
    header('location: index.php');
    exit;
} else {
    header('location: add_contact.php?errorMsg=2');
    exit;
}