<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
<style>
body {
    background-image: url(image/fon.jpg);
}
.form_dob{
    width: 600px;
    height: 625px;
    background: white;
    color: #070752;
    margin: 56px auto;
    border-radius: 10px;
    
}
h1{ margin:10px;}
a{
    margin: 10px;
    border: 1px solid black;
    padding: 2px;
    float: left;
    }
a:link{
    text-decoration: none;
    color: black;
}
a:visited {
    text-decoration: none;
    color: black;
}
a:active {
    text-decoration: none; }
a:hover {
    text-decoration: none;
    color: blue;
    border: 1px solid blue;
}
.form_el_dob{
    width: 505px;
    height: 30px;
    margin: 0 17px 0 15px;
    float: left;
}
.form_el_dob_opis{
    width: 505px;
    height: 100px;
    margin: 0 17px 0 15px;
    float: left;
    vertical-align:top;
}
.form_el1_dob{
    width: 505px;
    height: auto;
    margin: 15px 17px 0 20px;
    float: left;
}
.but_dob{
    width: 300px;
    height: 50px;
    margin: 30px 148px 0 150px;
    float: left;
    border-radius: 50px;
    color: white;
    outline: #070752;
    background: #070752;
    float: left;
}
</style>
</head>
<body>
<?php
require_once 'sss.php';

session_start();
if (isset($_POST['dobavlenie'])) {
    $Name_Book = $_POST['Name_Book'];
    $Name_Avtor = $_POST['Name_Avtor'];
    $genre = $_POST['genre'];
    $img = $_POST['img'];
    $opisanie = $_POST['opisanie'];
    $cena = $_POST['cena'];
    $sql = $conn->prepare("INSERT INTO book(Name_Book, Name_Avtor, genre, img, opisanie, cena) 
    VALUES ('$Name_Book','$Name_Avtor','$genre','$img','$opisanie','$cena')");
    $result = $sql->execute();
        if ($result) {
            echo '<script>alert("Добавление данных прошло успешно!");</script>';
            header("Location: profil.php");
        } else {
            echo '<script>alert("Неверные данные!");</script>';
        }
}
?>

<form class="form_dob" method="post" action="" name="signup-form">
    <h1>Добавление книги</h1>
    <div class="form_el1_dob">
        <label>Название книги</label>
        <input class="form_el_dob" type="text" name="Name_Book" required />
        <div class="vopr"><p class="vopr_text"></p></div>
    </div>
    <div class="form_el1_dob">
        <label>Имя автора</label>
        <input class="form_el_dob" type="text" name="Name_Avtor" required />
    </div>
    <div class="form_el1_dob">
        <label>Жанры</label>
        <input class="form_el_dob" type="text" name="genre" required />
    </div>
    <div class="form_el1_dob">
        <label>Ссылка на изображение</label>
        <input class="form_el_dob" type="text" name="img" required />
    </div>
    <div class="form_el1_dob">
        <label>Описание</label>
        <textarea class="form_el_dob_opis" name="opisanie"></textarea>
    </div>
    <div class="form_el1_dob">
        <label>Цена книги</label>
        <input class="form_el_dob" type="text" name="cena" required />
    </div>
    <button class="but_dob" type="submit" name="dobavlenie" value="dobavlenie">Добавить</button>
    <a href="profil.php">Вернутся в профиль</a>
</form>
</body>
</html>