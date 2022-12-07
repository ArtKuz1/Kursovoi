<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Удаление</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        .form_el_del{
            width: 505px;
    height: auto;
    margin: 15px 17px 15px 20px;
    border:1px solid black;
        }
        a{
    margin: 10px;
    border: 1px solid black;
    padding: 2px;
    float: right;
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
    </style>
</head>
<body>
<?php

require_once 'sss.php';
session_start();
if (isset($_POST['delite'])) {
    $idDelite = $_POST['idDelite'];
    $sql = $conn->prepare("DELETE FROM book WHERE idBook=$idDelite");
    $result = $sql->execute();
        if ($result) {
            echo '<script>alert("Удаление данных прошло успешно!");</script>';
            
        } else {
            echo '<script>alert("Ошибка!");</script>';
        }
}
?>

<form class="com" method="post" action="" name="signup-form">
    <h1>Удаление книги</h1>
    <?php
echo "<table style='border: solid 1px black; margin:10px;'>";
echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}


    $stmt = $conn->prepare("SELECT idBook, Name_Book, Name_Avtor FROM book");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
echo "</table>";

?>
    <h4>Введите ID книги для удаления</h4>
    <input class="form_el_del" type="text" name="idDelite" required />
    <button class="but_dob" type="submit" name="delite" value="delite">Удалить</button>
    <a href="profil.php">Вернутся в профиль</a>
</form>
</body>
</html>