<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login.php');
    exit;
}

include 'database.php';
$topicID = filter_input(INPUT_GET, 'topic_id');
$sql = "SELECT * FROM topics WHERE topic_id=$topicID";
$result = mysqli_query($con, $sql);
$topic = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM topics WHERE topic_id = $topicID";
$result = mysqli_query($con, $sql);
$numberOfTopics = mysqli_num_rows($result);

if( !is_numeric($topicID) || $topicID <= 0 || $numberOfTopics != 1 ){
    $topicID = 1;
    header('location: topic?topic_id=1');
}

?>

<!DOCTYPE HTML>

<html>
    <head>
        <title> Коментари за Тема </title>
        <link rel="stylesheet" href="css/forum.css"/>
    </head>
    
    <body>
        <div class="left-margin right-margin">
            <div class="big-text"><b><a href="index"> ⬅ Вратисе назад </a></b></div><br>
            <div class="big-text"> 📜 Тема: <b> <?php echo $topic['topic_name']; ?> </b></div><br>
            <div class="big-text"> <?php echo '<b><a href="add_post?topic_id=' . $topicID . '"> ✎ Додај нов Коментар </a></b>'; ?> </div>
            <br>

            <div class="centered-text">
                <table>
                    <tr>
                        <th><div style="width: 1000px"> ✎ Содржина </div></th>
                        <th><div style="width: 300px"> 👨 Објавено од </div></th>
                    </tr>
                    <tr>
                        <?php
                        $sql = "SELECT * FROM posts LEFT JOIN accounts ON posts.account_id=accounts.account_id WHERE topic_id=$topicID ORDER BY post_content";
                        $result = mysqli_query($con, $sql);
                        while($post = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                                echo '<td>' . $post['post_content'] . '</td>';
                                echo '<td>' . $post['username'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>