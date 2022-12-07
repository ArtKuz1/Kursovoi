<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<style>
    .com_prof{
        width: 1000px;
        height: 1000px;
        background: white;
        color: #070752;
        margin: 56px auto;
        border-radius: 10px;
    }
    button{
        background-color: white;
        border:0px;
        font-family: 'Times New Roman', Times, serif;
        font-size:16px;
    }
</style>
</head>
<body>
<?php
require_once 'sss.php';
session_start();
?>
<div class="com_prof">
<a class="a"href="index.php">Главная</a>
  <form class="head" method="post"> 
        <?php
        if (isset($_POST['log_in'])){
            unset($_SESSION['log_input']);
            $_SESSION['log_id'] = null;
            $_SESSION['log_sotr'] = null;
            header("Location: index.php");
        }
        $log_id=$_SESSION['log_id'];
        if ($_SESSION['log_sotr']== "User"){
        echo '<a class="a" href="book_user.php">Книги пользователя</a>';
        $sql = $conn->prepare("SELECT FIO, email FROM user WHERE idUser LIKE '$log_id'");
        }
        elseif ($_SESSION['log_sotr']== "Sotr"){
            echo '<a class="a" href="dobav.php">Добавление книги</a>
            <a class="a" href="delite.php">Удаление книги</a>';
            $sql = $conn->prepare("SELECT FIO, email FROM sotr WHERE idSotr LIKE '$log_id'");
        }
        ?>
        <button class="a" type="submit" name="log_in" value="log_in">Выход из аккаунта</button>
        

    </form>
    <div class="osn_blok">
    <?php
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0)
            while($res = $sql->fetch(PDO::FETCH_BOTH)){
                echo '<p>ФИО: ',$res['FIO'],'</p>';
                echo '<p>Email: ',$res['email'],'</p>';
            }
        ?>
    </div>
</div>
<footer>
  <a href="">Помощь</a>
</footer>
</body>
</html>