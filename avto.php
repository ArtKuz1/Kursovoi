<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
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
if (isset($_POST['login']))
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$_POST['username']]);
        $user = $stmt->fetch();
        // verifying the password
        if ($user && password_verify($_POST['password'], $user['password']))
        {
            $_SESSION['username'] = $user['username'];
            header("Location: http://localhost/19088_RF/index.php");
            exit;
        } else {
            echo "Login and password don't match";
        }
    }
?>

<form class="form_rv" method="post" action="" name="signin-form">
    <h1 class="h1_1">Авторизация</h1>
    <div class="form_el1">
        <label>логин</label>
        <input class="form_el" type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form_el1">
        <label>пароль</label>
        <input class="form_el" type="password" name="password" required />
    </div>
    <button class="but_rv" type="submit" name="login" value="login">Авторизация</button>
</form>
</body>
</html>
