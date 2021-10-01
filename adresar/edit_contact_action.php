<?php

include './session.php';

if ( !isset($_SESSION['account']) ) {
    header('location: login.php');
    exit;
}

$contactId = filter_input(INPUT_GET, 'contact_id');
if ( !is_numeric($contactId) || $contactId < 1 ) {
    header('location: index.php');
    exit;
}

$firstName = filter_input(INPUT_POST, 'first_name');
$lastName = filter_input(INPUT_POST, 'last_name');
$phoneNumber = filter_input(INPUT_POST, 'phone_number');
$accountId = $_SESSION['account']['account_id'];

if ( empty($firstName) || empty($lastName) || empty($phoneNumber) ) {
    header('location: error_contact.php?errorMsg=1');
    exit;
}

include 'db.php';
$firstName = mysqli_escape_string($con, $firstName);

$sql = "UPDATE contacts SET contact_first_name='$firstName', "
        . "contact_last_name='$lastName', contact_number='$phoneNumber' "
        . "WHERE contact_id=$contactId";
$result = mysqli_query($con, $sql);

mysqli_close($con);

if ($result == true) {
    header('location: index.php');
    exit;
} else {
    header('location: edit_contact.php?errorMsg=2&contact_id=' . $contactId);
    exit;
}