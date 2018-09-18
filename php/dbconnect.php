<?php
/**
 * В данном модуле реализованно подключение
 * к базе данных MySQL через PDO
 */

try {
    $host = 'localhost';
    $port = 3306;
    $dbName = 'Burger';
    $username = 'root';
    $pas = '123';
    $charset = 'utf8';

    $dbConnect = new PDO("mysql:host=$host; port=$port; dbname=$dbName; charset=$charset;", $username, $pas);
    $dbConnect->exec("set names utf8");
    return $dbConnect;
} catch (PDOException $e) {
    return false;
}
