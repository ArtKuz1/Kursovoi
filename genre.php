<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Каталог</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>
<style type="text/css">

</style>
</head>
<body>
<?php
require_once 'sss.php';
?>
<div class="com">
  <form class="head" method="post" action="poisk.php">
  <a class="a"href="index.php">Главная</a> 
      <input class="poisk"  type="text" name="keyword" placeholder="Введите название книги или имя автора">
      <input class="but_poisk" type="submit" name="search"  value="Поиск">
    <div class="rv">
        <a class="a" href="regis.php">Регистрация</a>
    </div>
  </form>
  <div class="blok">
    <div class="osn_blok">
      <?php
      $genres = $_POST['genres'];
      echo '<h1>Книги по жанру "',$genres,'"</h1>';
      switch($genres)
      {
      case "Классическая литература":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Классическая литература%'");
        break;
      case "Детектив":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Детектив%'");
        break;
      case "Фентези":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Фентези%'");
        break;
      case "Фантастика":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Фантастика%'");
        break;
      case "Приключения":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Приключения%'");
        break;
      case "Отдых/туризм":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Отдых/туризм%'");
        break;
      case "Рыбалка":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Рыбалка%'");
        break;
      case "Стихи для детей":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Стихи для детей%'");
        break;
      case "Сказки":
        $sql = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor, img FROM book WHERE genre LIKE '%Сказки%'");
        break;
      }
      $sql->execute();
      $result=$sql->setFetchMode(PDO::FETCH_ASSOC);
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