<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link rel="stylesheet" type="text/css" href="css/regist_auto.css">
</head>
<body>
<?php
require_once 'sss.php';

session_start();
if (isset($_POST['login']))
    {
        $stmt = $conn->prepare("SELECT * FROM User WHERE Login=?");
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch();
        if ($user && password_verify($_POST['Password'], $user['Password']))
        {
            $_SESSION['log_sotr'] = "User";
            $_SESSION['log_id'] = $user['idUser'];
            $_SESSION['log_input'] = true;
            header("Location: index.php");
            exit;
        } else {
            echo '<script>alert("Неверные данные!");</script>';
        }
    }
?>
<form class="form_av" method="post" action="" name="signin-form">
    <h1 class="h1_1">Авторизация</h1>
    <div class="form_el1">
        <label>логин</label>
        <input class="form_el" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form_el1">
        <label>пароль</label>
        <input class="form_el" type="password" name="Password" required />
    </div>
    <button class="but_rv" type="submit" name="login" value="login">Авторизация</button>
    <a class="a" href="index.php">Вернутся на главную</a>
    <a class="a" href="avto_sotr.php">Авторизация сотрудника</a>
    <a class="a" href="regis.php">Регистрация</a>
</form>
</body>
</html>
