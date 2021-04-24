<?php

    require_once('./loader.php');

    use databases\DatabaseControl;
    use lib\admin\AdminAuth;
    use lib\users\UserAuth;
    use lib\users\UserData;
    use lib\admin\AdminData;

    $db = new DatabaseControl();

    $userData = new UserData($db);
    $adminData = new AdminData($db);
    $user = new UserAuth($userData);
    $admin = new AdminAuth($adminData);

    if ($user->isLoggedIn()) {
        header("location: index.php"); //redirect ke index 

    }

    if (isset($_POST['just_do_it'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userValidation = $userData->getUserUsername($username);
        $adminValidation = $adminData->getAdminUsername($username);

        if($userValidation){
            $user_con = $user->login($username, $password);
            if($user_con){
                header("location: index.php");
            }
            else{
                $error = $user->getLastError();
            }
        }
        else if($adminValidation){
            $admin_con = $admin->login($username, $password);
            if($admin_con){
                header("location: index.php");
            }
            else{
                $error = $admin->getLastError();
            }
        }
        else{
            $error = "Username dan Password Anda Salah!";
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

                <input type="username" name="username" placeholder="Username atau Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit" name="just_do_it">login</button>
                <p class="message">Not registered? <a href="register.php">Create an account</a></p>

            </form>
        </div>
    </div>
</body>
</html>
