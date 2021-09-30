<!DOCTYPE html>

<html>
    <head>
        <title>Адресар - најава</title>
        <meta charset="UTF-8" >
        
        <link type="text/css" rel="stylesheet" href="css/adresar.css" />
    </head>
    <body>
        <div class="login-container">
            <form action="login_action.php" method="POST">
                <input class="horizontal-center login-input" type="text" name="username" value="" placeholder="Корисничко име" /> <br/>
                <input class="horizontal-center login-input" type="password" name="password" value="" placeholder="Лозинка" /> <br/>
                <input class="horizontal-center" type="submit" value="Најава" />
            </form>
            <div>
                <?php 
                    $errorMsg = filter_input(INPUT_GET, 'errorMsg');
                    if ( $errorMsg != null ) {
                        if ( $errorMsg == 1 ) {
                            echo '<p class="login-error-message">полето корисничко име или лозинка не смее да биде празно</p>';
                        } else if ( $errorMsg == 2 ) {
                            echo '<p class="login-error-message">Непостои ваков корисник</p>';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
