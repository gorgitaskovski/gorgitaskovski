<?php 

    var_dump($a);
    include 'session.php';
    
    if ( !isset($_SESSION['account'] ) ) {
        header('location: login.php');
        exit;
    }
    include 'db.php';
    $account = $_SESSION['account'];
    
    $limit = 5;
    $offset = 0;
    $page = filter_input(INPUT_GET, 'page');
    if (!is_numeric($page) || $page <= 0) {
        $page = 1;
    }
    $offset = $limit * $page - $limit;
    
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Адресар - почетна</title>
        <meta charset="UTF-8">
        
        <link type="text/css" rel="stylesheet" href="css/adresar.css" />
    </head>
    <body>
        <div class="index-container">
            <div>
                <span>Добро дојде: <?php echo $account['username']; ?></span>
                <a href="add_contact.php">Нов Контакт</a>
                <a href="logout.php">Одјава</a>
            </div>
            <div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Име</th>
                        <th>Презиме</th>
                        <th>Телефонски број</th>
                        <th>Акции</th>
                    </tr>
                    <?php 
                        $accountId = $account['account_id'];
                        $sql = "SELECT * FROM contacts WHERE account_id=$accountId LIMIT $limit OFFSET $offset";
                        $result = mysqli_query($con, $sql);
                        while ($contact = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                                echo '<td>'. $contact['contact_id'] .'</td>';
                                echo '<td>'. $contact['contact_first_name'] .'</td>';
                                echo '<td>'. $contact['contact_last_name'] .'</td>';
                                echo '<td>'. $contact['contact_number'] .'</td>';
                                echo '<td>';
                                    echo '<a href="edit_contact.php?contact_id='. $contact['contact_id'] .'">Измени</a>, ';
                                    echo '<a href="delete_contact_action.php?contact_id='. $contact['contact_id'] .'">Избриши</a>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
                <div class="pagination-container">
                    <?php
                        $sql = "SELECT COUNT(*) as totalContacts FROM contacts WHERE account_id=$accountId";
                        $result = mysqli_query($con, $sql);
                        $totalContactsArray = mysqli_fetch_assoc($result);
                        $totalContacts = $totalContactsArray['totalContacts'];
                        $totalPages = ceil($totalContacts / $limit);
                        
                        if ( $page == 1 ) {
                            echo "Почетна";
                        } else {
                            echo '<a href="index.php?page=1">Почетна</a>';
                        }
                        echo '&nbsp;';
                        if ( $page == 1 ) {
                            echo "Претходна";
                        } else {
                            $prethodna = $page - 1;
                            echo '<a href="index.php?page='. $prethodna .'">Претходна</a>';
                        }
                        
                        echo '&nbsp;';
                        for ($i = 1; $i <= $totalPages; $i++) {
                            if ($page == $i) {
                                echo $i;
                            } else {
                                echo '<a href="index.php?page='. $i .'">'. $i .'</a> ';
                            }
                        }
                        
                        if ( $page == $totalPages ) {
                            echo 'Следна';
                        } else {
                            $sledna = $page + 1;
                            echo '<a href="index.php?page='. $sledna .'">Следна</a>';
                        }
                        
                        echo '&nbsp;';
                        if ($page == $totalPages) {
                            echo 'Последна';
                        } else {
                            echo '<a href="index.php?page='. $totalPages .'">Последна</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>














