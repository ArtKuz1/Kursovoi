<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="css/regist_auto.css">
</head>
<body>
<?php
require_once 'sss.php';

session_start();
if (isset($_POST['register'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $FIO = $_POST['FIO'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $query = $conn->prepare("SELECT * FROM Sotr WHERE login=:login");
    $query->bindParam("login", $login, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<script>alert("Этот адрес уже зарегистрирован!");</script>';
    }
    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO Sotr (FIO,email,login,password,prava_admin) VALUES (:FIO,:email,:login,:password_hash,'нет прав')");
        $query->bindParam("FIO", $FIO, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("login", $login, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo '<p class="success">Регистрация прошла успешно!</p>';
            header("Location: http://localhost:8088/avto.php");
        } else {
            echo '<p class="error">Неверные данные!</p>';
        }
    }
}
?>

<form class="form_rv" method="post" action="" name="signup-form">
    <h1 class="h1_1">Регистрация</h1>
    <div class="form_el1">
        <label>ФИО</label>
        <input class="form_el" type="text" name="FIO" required />
    </div>
    <div class="form_el1">
        <label>Email</label>
        <input class="form_el" type="text" name="email" required />
    </div>
    <div class="form_el1">
        <label>Логин</label>
        <input class="form_el" type="text" name="login" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form_el1">
        <label>Пароль</label>
        <input class="form_el" type="password" name="password" required />
    </div>
    <button class="but_rv" type="submit" name="register" value="register">Регистрация</button>
    <a class="a" href="index.php">Вернутся на главную</a>
    <a class="a" href="avto.php">Авторизация</a>
</form>
</body>
</html>