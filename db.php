<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch (PDOException $е)
{
    print "Couldn't connect to the database: " . $e->getMessage();
}

session_start();