<!DOCTYPE HTML>

<html>
    <head>
        <title> Најавување </title>
        <link rel="stylesheet" href="css/forum.css" />
    </head>
    
    <body>
        <div class="login-container">
            <form action="login_action.php" method="POST">
                <input class="centered-text centered-margin login-input starting-margin" type="text" name="username" placeholder="username"/>
                <input class="centered-text centered-margin login-input" type="password" name="password" placeholder="password"/>
                <input class="centered-text centered-margin login-input login-input-submit" type="submit" value="Login" />
            </form>
            
            <?php
                $errorMsg = filter_input(INPUT_GET, 'errorMsg');
                if( $errorMsg != NULL ){
                    if( $errorMsg == 1 ){
                        echo "<p class='red-text centered-text'> Наполнете ги полинјата </p>";
                    } else if( $errorMsg == 2 ){
                        echo "<p class='red-text centered-text'> Непостои таков акаунт </p>";
                    }
                }
            ?>
        </div>
    </body>
</html>