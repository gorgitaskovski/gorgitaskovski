<?php

include 'session.php';

$account = $_SESSION['account'];
if ( !isset($account) ) {
    header('location: login.php');
    exit;
}

$accountId = $account['account_id'];
$contactId = filter_input(INPUT_GET, 'contact_id');

if ( !is_numeric($contactId) || $contactId < 1 ) {
    header('location: index.php');
    exit;
}

include 'db.php';

$sql = "DELETE FROM contacts WHERE contact_id=$contactId AND account_id=$accountId";

$result = mysqli_query($con, $sql);

mysqli_close($con);

if ($result == true) {
    header('location: index.php');
    exit;
} else {
    header('location: index.php?errorMsg=1');
    exit;
}

