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
