<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login.php');
    exit;
}

include 'database.php';
$account = $_SESSION['account'];
$accountID = $account['account_id'];

$page = filter_input(INPUT_GET, 'page');
$limit = 12;
$offset = $limit * $page - $limit;

$sql = "SELECT COUNT(*) as totalTopics FROM topics";
$result = mysqli_query($con, $sql);
$totalTopicsArray = mysqli_fetch_assoc($result);
$totalTopics = $totalTopicsArray['totalTopics'];
$totalPages = ceil($totalTopics / $limit);

if( !is_numeric($page) || $page <= 0 ){
    $page = 1;
    header('location: index.php?page=1');
} else if( $page > $totalPages ){
    $page = $totalPages;
    header("location: index.php?page=$page");
}

?>
<!DOCTYPE HTML>

<html>
    <head>
        <title> Листа Теми </title>
        <link rel="stylesheet" href="css/forum.css"/>
    </head>
    
    <body>
        Логиран на <b> <?php echo $account['username']; ?> <br>
        <a href="logout.php">Одјависе</a> </b> <br><br>
        Листа на сите теми од сите корисници сортирани по име/дескрипшн <br>
        <b> <a href="add_topic.php">Креирај нова тема</a> </b>
       
        <div class="centered-text">
            <table>
                <tr>
                    <th bgcolor="grey"><div style="width: 1000px"> Тема </div></th>
                    <th bgcolor="grey"><div style="width: 300px"> Објавено од </div></th>
                    <th bgcolor="grey"><div style="width: 100px"> Акции </div></th>
                </tr>
                <?php
                $sql = "SELECT * FROM topics LEFT JOIN accounts ON topics.account_id=accounts.account_id ORDER BY topic_name LIMIT $limit OFFSET $offset";
                $result = mysqli_query($con, $sql);
                while($topic = mysqli_fetch_assoc($result)){
                    echo '<tr>';
                        echo '<td><a href="topic?topic_id=' . $topic['topic_id'] . '">' . $topic['topic_name'] . '</a></td>';
                        echo '<td>' . $topic['username'] . '</td>';
                        $topicCreatorID = $topic['account_id'];
                        if( $topicCreatorID == $accountID ){
                            echo '<td><a href="delete_topic_action?topic_id=' . $topic['topic_id'] . '&page=' . $page . '"> ИЗБРИШИ </a></td>';
                        } else {
                            echo '<td> ИЗБРИШИ </td>';
                        }
                    echo '</tr>';
                }
                ?>
            </table>
            <div class="centered-text">
                <?php
                if($page == 1){
                    echo "Прва Претходна ";
                } else{
                    echo '<a href="index?page=1">Прва</a> ';
                    $predhodna = $page - 1;
                    echo '<a href="index?page=' . $predhodna . '">Претходна</a> ';
                }
                
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($page == $i) {
                        echo $i;
                    } else {
                        echo ' <a href="index?page=' . $i . '">' . $i . '</a> ';
                    }
                }
                
                if($page == $totalPages){
                    echo " Следна Последна";
                } else{
                    $sledna = $page + 1;
                    echo " ";
                    echo '<a href="index?page=' . $sledna . '">Следна</a>';
                    echo " ";
                    echo '<a href="index?page=' . $totalPages . '">Последна</a>';
                }
                ?>
            </div>
        </div>
    </body>
</html>