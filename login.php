<?php

require_once "databases/DatabaseConnection.php";
require_once "lib/auth/auth.php";

$db = new DatabaseControl();
$db_con = $db->getDB();

$user = new Authentication($db_con);

if ($user->isLoggedIn()) {
    header("location: index.php"); //redirect ke index 

}


if (isset($_POST['just_do_it'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_con = $user->login($email, $password);

    if ($user_con){
        header("location: index.php");

    } else {
        $error = $user->getLastError();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <div class="login-page">
        <div class="form" autocomplete="off">
            <form class="login-form" method="post">
                
                <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>

                <?php endif; ?>

                <input type="email" name="email" placeholder="email" required />
                <input type="password" name="password" placeholder="password" required />
                <button type="submit" name="just_do_it">login</button>
                <p class="message">Not registered? <a href="register.php">Create an account</a></p>

            </form>
        </div>
    </div>
</body>
</html>
