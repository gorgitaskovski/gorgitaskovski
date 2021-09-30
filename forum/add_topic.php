<?php

include 'session.php';
if( !isset($_SESSION['account']) ){
    header('location: login.php');
    exit;
}

?>
<!DOCTYPE HTML>

<html>
    <head>
        <title> Додај Нова Тема </title>
        <link rel="stylesheet" href="css/forum.css">
    </head>
    
    <body>
        <div class="add-container">
            <form action="add_topic_action.php" method="POST">
                <input class="centered-text centered-margin add-input starting-margin" type="text" name="topic_name" placeholder="Име на Тема"/>
                <input class="centered-text centered-margin add-input add-input-submit" type="submit" value="Додај Тема"/>
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