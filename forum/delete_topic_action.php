<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login');
    exit;
}

$accountID = $_SESSION['account']['account_id'];
$topicID = filter_input(INPUT_GET, 'topic_id');
$page = filter_input(INPUT_GET, 'page');

if( !is_numeric($topicID) || $topicID < 1 ){
    header('location: index');
    exit;
}

include 'database.php';

header('location: index?page=' . $page);
$sql = "DELETE FROM topics WHERE topic_id=$topicID AND account_id=$accountID";
$result = mysqli_query($con, $sql);

mysqli_close($con);

if($result == true) {
    header('location: index?page=' . $page);
    exit;
} else {
    header('location: index.php?errorMsg=1');
    exit;
}