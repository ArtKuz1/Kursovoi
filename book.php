<?php 
require_once 'sss.php';
session_start();
$bookID = $_POST['book'];
$UserID = (int)$_SESSION['log_id'];
$sql = $conn->prepare("SELECT * FROM book WHERE idBook LIKE '$bookID'");
$sql->execute();
$res = $sql->fetch(PDO::FETCH_BOTH);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title><?php echo $res['Name_Book']?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <style>
      img{
        width: 235px;
        height: 340px;
        margin: 0 10px;
        float:left;
      }
      h1{
        margin:10px 0;
        width:500px;
        float:left; 
      }
      p{ 
        margin:10px 0;
        float:left;
      }
      .opisanie{
        width:500px;
        float:left;
      }
      .pokup{
        width:150px;
        margin:10px;
        float:left;
      }
      button {
        width:235px;
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 5px 5px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 0;
        -webkit-transition-duration: 0.4s; /* Safari */
        transition-duration: 0.4s;
        cursor: pointer;
}
button :hover {    background-color: #4CAF50; /* Green */}
.book{
  height:360px;
  float:left;
}
    </style>
</head>
<body>
<?php

?>
<div class="com">
  <form class="head" method="post" action="poisk.php"> 
    <a class="a"href="index.php">Главная</a>
      <input class="poisk"  type="text" name="keyword" placeholder="Введите название книги или имя автора">
      <input class="but_poisk" type="submit" name="search"  value="Поиск">
    <div class="rv">
      <?php
      if(isset($_SESSION['log_input']))  
      echo '<a class="a" href="profil.php">Профиль</a>';
        else echo '<a class="a" href="avto.php">Вход</a>';
      ?>
        
    </div>
  </form>
  <div class="blok">
    <div class="osn_blok">
      <div class = 'book'>
        <?php
        if($sql->rowCount() > 0){
            echo '<img src=',$res['img'],'>
            <h1>',$res['Name_Book'],'</h1><p>Автор: ',$res['Name_Avtor'],'<br>
            Жанр:',$res['genre'],'</p>
            <div class="opisanie"><p>',$res['opisanie'],'</p></div>
            <p>Цена:',$res['cena'],' руб.</p>';
        }
        ?>
        </div>
        <form class="pokup"method="post">
          <?php
          $bookID = $_POST['book'];
          if ($_SESSION['log_sotr']== "User"){
            $query = $conn->prepare("SELECT * FROM book_user 
            WHERE user_iduser=:user_iduser AND book_idbook=:book_idbook");
            $query->bindParam("book_idbook", $bookID, PDO::PARAM_STR);
            $query->bindParam("user_iduser", $UserID, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
              echo'<button disabled>Куплено</button>';
            }
            if ($query->rowCount() == 0) {
            echo'<input type="hidden" name="book" value="',$bookID,'">
            <button type="submit" name="pokup">Купить</button>';
            if (isset($_POST['pokup'])) {
              $query = $conn->prepare("INSERT INTO book_user (user_iduser,book_idbook)
              VALUES (:user_iduser,:book_idbook)");
              $query->bindParam("user_iduser", $UserID, PDO::PARAM_STR);
              $query->bindParam("book_idbook", $bookID, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    echo '<script>alert("Покупка прошла успешно!");</script>';
                } else {
                    echo '<script>alert("Ошибка!");</script>';
                }
            }}
          }elseif($_SESSION['log_sotr']== "Sotr"){echo'<button disabled>Сотрудник, а тебе зачем?</button>';}
          else {echo'<button disabled>Для покупки авторизируйтесь</button>';}
          ?>
        </form>
    </div>
    <div class="dop_blok">
          <ul id="menu">
            <li><span>Легкое чтение</span>
              <ul>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Детектив">
                    <input type="submit" name="genre" value="Детективы">
                  </form>
                </li>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Фентези">
                    <input type="submit" name="genre" value="Фентези">
                  </form>
                </li>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Фантастика">
                    <input type="submit" name="genre" value="Фантастика">
                  </form>  
                </li>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Приключения">
                    <input type="submit" name="genre" value="Приключения">
                  </form>
                </li>
              </ul>
            </li>
            <li>
                <form method="POST" action = "genre.php" class="form_ger">
                  <input type="hidden" name="genres" value="Классическая литература">
                  <input type="submit" name="genre" value="Классическая литература">
                </form>
              </li>
            <li><span>Хобби/досуг</span>
              <ul>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Отдых/туризм">
                    <input type="submit" name="genre" value="Отдых/туризм">
                  </form>  
                </li>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Рыбалка">
                    <input type="submit" name="genre" value="Рыбалка">
                  </form>
                </li>
              </ul>
            </li>
            <li><span>Детские книги</span>
              <ul>
                <li>
                  <form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Стихи для детей">
                    <input type="submit" name="genre" value="Стихи для детей">
                  </form>
                </li>
                <li><form method="POST" action = "genre.php">
                    <input type="hidden" name="genres" value="Сказки">
                    <input type="submit" name="genre" value="Сказки">
                  </form>
                </li>
              </ul>
            </li>
          </ul>
    </div>
  </div>
</div>
<footer>
  <a href="">Помощь</a>
</footer>
<script type="text/javascript" src = "js/js.js"></script>
</body>
</html>