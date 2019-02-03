<?php

require "db.php";

?>
<?php if( isset($_SESSION['logged_user'])) :?>
   HI
<?php  echo $_SESSION['logged_user'] ?><br>
<a href="logout.php">Logout</a>
<?php else : ?>
<a href="/login.php">Авторизоватся</a><br>
<a href="/signup.php">Регистрация</a>
<?php endif; ?>