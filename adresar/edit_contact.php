<?php
    include './session.php';

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
    
    $sql = "SELECT * FROM contacts WHERE contact_id=$contactId AND account_id=$accountId";
    $result = mysqli_query($con, $sql);
    $contact = mysqli_fetch_assoc($result);
    
    mysqli_close($con);
    
    if (is_null($contact) ) {
        header('location: index.php');
        exit;
    }
    
    $firstName = $contact['contact_first_name'];
    $lastName = $contact['contact_last_name'];
    $phoneNumber = $contact['contact_number'];
    
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Адресар - ажурирај контакт</title>
        <meta charset="UTF-8" >
        
        <link type="text/css" rel="stylesheet" href="css/adresar.css" />
    </head>
    <body>
        <div class="add-contact-container">
            <form action="edit_contact_action.php?contact_id=<?php echo $contactId?>" method="POST">
                <input class="horizontal-center login-input" type="text" name="first_name" value="<?php echo $firstName; ?>" placeholder="Име" /> <br/>
                <input class="horizontal-center login-input" type="text" name="last_name" value="<?php echo $lastName; ?>" placeholder="Презиме" /> <br/>
                <input class="horizontal-center login-input" type="text" name="phone_number" value="<?php echo $phoneNumber; ?>" placeholder="Телефонски број" /> <br/>
                <input class="horizontal-center" type="submit" value="Промени"/>
            </form>
            <div>
                <?php 
                    $errorMsg = filter_input(INPUT_GET, 'errorMsg');
                    if ( $errorMsg != null ) {
                        if ( $errorMsg == 1 ) {
                            echo '<p class="login-error-message">Задолжителни полина</p>';
                        } else if ( $errorMsg == 2 ) {
                            echo '<p class="login-error-message">Се појави грешка при ажурирање</p>';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>