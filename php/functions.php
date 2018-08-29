<?php

function makeAddress($street, $building, $block, $apartment, $floor)
{
    $addrPart = ['street', 'building', 'block', 'apartment', 'floor'];
    $addrPrefix = ['ул. ', 'д. ', 'корп. ', 'кв. ', 'этаж '];
    $address = '';
    for ($i = 0; $i < count($addrPart); $i++) {
        if (!empty(${$addrPart[$i]})) {
            $address .= $addrPrefix[$i] . ${$addrPart[$i]} . ', ';
        }
    }
    $address = trim($address);
    if (mb_strlen($address) > 1) {
        $lastChar = mb_substr($address, -1, 1); // последний символ строки
        if ($lastChar == ',') {
            $address = mb_substr($address, 0, mb_strlen($address) - 1);
        }
    }
    return $address;
}

function getOrderNumber(PDO $dbConnect, $userId)
{
    try {
        $str = $dbConnect->prepare('SELECT count(*) AS count FROM orders WHERE userid = :userId');
        $str->execute(array('userId' => $userId));
        $count = $str->fetchColumn();
    } catch (PDOException $e) {
        echo 'Проблема с запросом кол-ва заказов у конкретного пользователя';
        return null;
    }
    if ($count == 1) {
        echo 'Это первый заказ данного пользователя!' . PHP_EOL;
        return "1ый";
    } else {
        echo 'Это частый клиент!' . PHP_EOL;
        return "$count-й";
    }
}
