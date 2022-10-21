<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "19088_Rieltorskaia_Firma";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

session_start();
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $query = $conn->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<p class="error">Этот адрес уже зарегистрирован!</p>';
    }
    if ($query->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO users(username,password) VALUES (:username,:password_hash)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
//                    $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo '<p class="success">Регистрация прошла успешно!</p>';
            header("Location: http://localhost/19088_RF/avto.php");
        } else {
            echo '<p class="error">Неверные данные!</p>';
        }
    }
}
?>

<form class="form_rv" method="post" action="" name="signup-form">
    <h1 class="h1_1">Регистрация</h1>
    <div class="form_el1">
        <label>логин</label>
        <input class="form_el" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form_el1">
        <label>пароль</label>
        <input class="form_el" type="password" name="password" required />
    </div>
    <button class="but_rv" type="submit" name="register" value="register">Регистрация</button>
    <a href="index.php">Вернутся к выбору таблицы</a>
</form>
</body>
</html>