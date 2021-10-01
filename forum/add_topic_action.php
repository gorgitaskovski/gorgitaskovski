<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login');
    exit;
}

$accountID = $_SESSION['account']['account_id'];
$topic = filter_input(INPUT_POST, 'topic_name');

if( empty($topic) ){
    header('location: add_topic?errorMsg=1');
    exit;
}

include 'database.php';
$sql = "INSERT INTO topics(topic_name, account_id) VALUES('$topic',$accountID)";
$result = mysqli_query($con, $sql);

mysqli_close($con);

if ($result == true) {
    header('location: index');
    exit;
} else {
    header('location: add_contact?errorMsg=2');
    exit;
}