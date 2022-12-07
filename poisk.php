<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Поиск</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
</head>
<body>
<div class="com">
  <form class="head" method="post"> 
  <a class="a"href="index.php">Главная</a>
      <input class="poisk"  type="text" name="keyword" placeholder="Введите название книги или имя автора">
      <input class="but_poisk" type="submit" name="search"  value="Поиск">
    <div class="rv">
        <a class="a" href="regis.php">Регистрация</a>
    </div>
  </form>
<?php
require_once 'sss.php';
if (isset($_POST['search'])){
  $keyword = $_POST['keyword'];
  $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book
  WHERE Name_Book LIKE '%$keyword%' or Name_Avtor LIKE '%$keyword%'");
  $sql->execute();
  $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
}
?>
  <div class="blok">
    <div class="osn_blok">
      <?php
      echo '<h1>Результаты поиска по "',$keyword,'"</h1>';
      require_once 'vivod.php';
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
          <li>
            <form method="POST" action = "genre.php" class="form_ger">
              <input type="hidden" name="genres" value="Классическая литература">
              <input type="submit" name="genre" value="Классическая литература">
            </form>
          </li>
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