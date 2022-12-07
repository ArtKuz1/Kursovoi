<?php
if($sql->rowCount() > 0)
while($res = $sql->fetch(PDO::FETCH_BOTH)){
    echo '<form  method="POST" action="book.php">',
    '<input type="hidden" name="book" value="',$res['idBook'],'">
    <button class="blok_info"><img src=',$res['img'],'>
    <p>',$res['Name_Book'],'<br>',$res['Name_Avtor'],'</p>',
    '</button></form>';
}
?>