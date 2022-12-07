<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация сотрудника</title>
    <link rel="stylesheet" type="text/css" href="css/regist_auto.css">
</head>
<body>
<?php
require_once 'sss.php';

session_start();
if (isset($_POST['login']))
    {
        $stmt = $conn->prepare("SELECT * FROM Sotr WHERE Login=?");
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch();
        // verifying the password
        if ($user && password_verify($_POST['password'], $user['password']))
        {
            $_SESSION['log_sotr'] = "Sotr";
            $_SESSION['log_id'] = $user['idSotr'];
            $_SESSION['log_input'] = true;
            header("Location: index.php");
            exit;
        } else {
            echo "Login and password don't match";
        }
    }
?>

<form class="form_av" method="post" action="" name="signin-form">
    <h1 class="h1_1">Авторизация сотрудника</h1>
    <div class="form_el1">
        <label>логин</label>
        <input class="form_el" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form_el1">
        <label>пароль</label>
        <input class="form_el" type="password" name="password" required />
    </div>
    <button class="but_rv" type="submit" name="login" value="login">Авторизация</button>
    <a class="a" href="index.php">Вернутся на главную</a>
</form>
</body>
</html>
