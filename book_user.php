<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Список книг</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<style>
    .com_prof{ width: 1000px;
        height: 1000px;
        background: white;
        color: #070752;
        margin: 56px auto;
        border-radius: 10px;}
    button{ background-color: white;
        border:0px;
        font-family: 'Times New Roman', Times, serif;
        font-size:16px;}
    form{ margin:0;}
</style>
</head>
<body>
<?php
require_once 'sss.php';
session_start();
?>
<div class="com_prof">
    <form class="head" method="post" action="poisk.php"> 
        <a class="a"href="index.php">Главная</a>
        <input class="poisk"  type="text" name="keyword" placeholder="Введите название книги или имя автора">
        <input class="but_poisk" type="submit" name="search"  value="Поиск">
        <div class="rv"><a class="a" href="profil.php">Профиль</a></div></form>
    <div class="osn_blok">
        <?php
        $log_id=$_SESSION['log_id'];
        $sql = $conn->prepare("SELECT book.idBook,book.img,book.Name_Book,book.Name_Avtor FROM user 
        INNER JOIN book_user ON idUser=user_iduser 
        INNER JOIN book ON idBook=book_idbook
        WHERE user_iduser LIKE '$log_id'");
        $sql->execute();
        $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
        require_once 'vivod.php';
        ?>
    </div>
</div>
<footer>
  <a href="">Помощь</a>
</footer>
</body>
</html>