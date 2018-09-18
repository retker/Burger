<?php

require_once 'ImageChange.php';
$img = new ImageChange('../img/content/php.jpg');

// Поворот
$img->rotate(45,'../img/content/php_rotated.jpg');
echo "Изображение повернули" . '<br>';

// Нанесение водяного знака
$img->setWatermark('../img/content/burger.png', 0.75 ,'center','../img/content/php_watermarked.jpg');
echo "Нанесли водяной знак" . '<br>';;

// Изменение размера
$img->resizeProportional(200,'../img/content/php_resized.jpg');
echo "Изменили размер" . '<br>';;
