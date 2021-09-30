<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login');
    exit;
}

$accountID = $_SESSION['account']['account_id'];
$topicID = filter_input(INPUT_GET, 'topic_id');
$post = filter_input(INPUT_POST, 'post_content');

if( empty($post) ){
    header('location: add_post?errorMsg=1');
    exit;
}

include 'database.php';
$sql = "INSERT INTO posts(post_content, account_id, topic_id) VALUES('$post',$accountID,$topicID)";
$result = mysqli_query($con, $sql);

mysqli_close($con);

if($result == true){
    header('location: topic?topic_id=' . $topicID);
    exit;
} else{
    header('location: add_post?errorMsg=2');
    exit;
}