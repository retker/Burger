<?php

require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(array('/', 'templatest'));
$twig = new Twig_Environment($loader);

echo $twig->render('index.html', array());
