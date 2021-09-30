<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login');
    exit;
}

include 'database.php';
$topicID = filter_input(INPUT_GET, 'topic_id');

?>
<!DOCTYPE HTML>

<html>
    <head>
        <title> Додај Нов Коментар </title>
        <link rel="stylesheet" href="css/forum.css">
    </head>
    
    <body>
        <div class="add-container">
            <form action="add_post_action?topic_id=<?php echo $topicID?>" method="POST">
                <input class="centered-text centered-margin add-input starting-margin" type="text" name="post_content" placeholder="Содржина"/>
                <input class="centered-text centered-margin add-input add-input-submit" type="submit" value="Додај Коментар"/>
            </form>
            <?php
            $errorMsg = filter_input(INPUT_GET, 'errorMsg');
                if ( $errorMsg != null ) {
                    if ( $errorMsg == 1 ) {
                        echo '<p class="red-text centered-text">Задолжителни полиња</p>';
                    } else if ( $errorMsg == 2 ) {
                        echo '<p class="red-text centered-text">Се појави грешка при додавање</p>';
                    }
                }
            ?>
        </div>
    </body>
</html>