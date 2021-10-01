<?php
    include './session.php';

    if ( !isset($_SESSION['account']) ) {
        header('location: login.php');
        exit;
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Адресар - додај нов контакт</title>
        <meta charset="UTF-8" >
        
        <link type="text/css" rel="stylesheet" href="css/adresar.css" />
    </head>
    <body>
        <div class="add-contact-container">
            <form action="add_contact_action.php" method="POST">
                <input class="horizontal-center login-input" type="text" name="first_name" value="" placeholder="Име" /> <br/>
                <input class="horizontal-center login-input" type="text" name="last_name" value="" placeholder="Презиме" /> <br/>
                <input class="horizontal-center login-input" type="text" name="phone_number" value="" placeholder="Телефонски број" /> <br/>
                <input class="horizontal-center" type="submit" value="Додај" />
            </form>
            <div>
                <?php 
                    $errorMsg = filter_input(INPUT_GET, 'errorMsg');
                    if ( $errorMsg != null ) {
                        if ( $errorMsg == 1 ) {
                            echo '<p class="login-error-message">Задолжителни полина</p>';
                        } else if ( $errorMsg == 2 ) {
                            echo '<p class="login-error-message">Се појави грешка при додавање</p>';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
