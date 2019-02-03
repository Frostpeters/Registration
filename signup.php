<?php

require "db.php";

$data = $_POST;
if (isset($data['do_signup'])) {

    $errors = array();
    if (trim($data['login']) == '') {
        $errors[] = 'Enter login';
    }

    if ($data['password'] == '') {
        $errors[] = 'Enter password';
    }else{
        $sql = "SELECT login FROM users WHERE login=?";
        $query = $db->prepare($sql);
        $query->execute([$data['login']]);
        if($query->rowCount() > 0){

          $errors[] = 'Dublicate user';
        }
    }


    if (empty($errors)) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $result = $db->prepare(
            "INSERT INTO users(`login`, `password`)
                VALUES(?,?)");
        $result->execute([$data['login'], md5($data['password'])]);
        echo '<div style="color: green;">Зарегистрирован</div><hr>';


    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}

?>


<form action="/signup.php" method="POST">

    <p>
        <p>Введите логин</p>
        <input type="text" name="login" value="<?php
        if(isset ($data['login'])){
            $data['login'];
        }
        echo $data['login'] ?? '';
         ?>">
    </p>

    <p>
        <p>Введите пароль</p>
        <input type="password" name="password">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегистрироватся</button>
    </p>

    <p>
        <button><a href="/index.php">Назад</a></button>
    </p>
</form>
