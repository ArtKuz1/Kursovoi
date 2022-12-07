<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Главная</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
</head>
<body>
<?php
require_once 'sss.php';
session_start();
?>
<div class="com">
  <form class="head" method="post" action="poisk.php"> 
    <a class="a"href="index.php">Главная</a>
      <input class="poisk"  type="text" name="keyword" placeholder="Введите название книги или имя автора">
      <input class="but_poisk" type="submit" name="search"  value="Поиск">
    <div class="rv">
      <?php if(isset($_SESSION['log_input']))  
      echo '<a class="a" href="profil.php">Профиль</a>';
        else echo '<a class="a" href="avto.php">Вход</a>'; ?>
    </div>
  </form>
  <div class="blok">
    <div class="osn_blok">
        <?php
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Фентези%'");
        $sql->execute();
        $i=1;
        echo "<h2>Фентези</h2>";
        echo '<div class="info">';
        if($sql->rowCount() > 0)
          while(($res = $sql->fetch(PDO::FETCH_BOTH))&&($i<=4)){
              echo '<form  method="POST" action="book.php">',
              '<input type="hidden" name="book" value="',$res['idBook'],'">
              <button class="blok_info"><img src=',$res['img'],'>
              <p>',$res['Name_Book'],'<br>',$res['Name_Avtor'],'</p>',
              '</button></form>';
              $i++;
          }
        echo '</div>';
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Классическая литература%'");
        $sql->execute();
        $i=1;
        echo "<h2>Классическая литература</h2>";
        echo '<div class="info">';
        if($sql->rowCount() > 0)
          while(($res = $sql->fetch(PDO::FETCH_BOTH))&&($i<=4)){
              echo '<form  method="POST" action="book.php">',
              '<input type="hidden" name="book" value="',$res['idBook'],'">
              <button class="blok_info"><img src=',$res['img'],'>
              <p>',$res['Name_Book'],'<br>',$res['Name_Avtor'],'</p>',
              '</button></form>';
              $i++;
          }
        echo '</div>';
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Сказки%'");
        $sql->execute();
        $i=1;
        echo "<h2>Сказки</h2>";
        echo '<div class="info">';
        if($sql->rowCount() > 0)
          while(($res = $sql->fetch(PDO::FETCH_BOTH))&&($i<=4)){
              echo '<form  method="POST" action="book.php">',
              '<input type="hidden" name="book" value="',$res['idBook'],'">
              <button class="blok_info"><img src=',$res['img'],'>
              <p>',$res['Name_Book'],'<br>',$res['Name_Avtor'],'</p>',
              '</button></form>';
              $i++;
          }
        echo '</div>';
        ?>
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