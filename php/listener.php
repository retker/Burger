<per>
<?php

//Проверяем поля email и phone, а если на стороне клиента средствами html5 проверять обязательность заполнения,
// то тут необходимо это делать?

//Фаза1

if ((empty($_POST['email'])) || (empty($_POST['phone']))) {
    echo('ошибка поля email и phone должны быть заполнены.');
    return null;
}

// подключаем модуль коннекта к базе и проверяем успех подключения.
$dbConnect = require_once 'dbconnect.php';
if ($dbConnect === false) {
    echo 'Ошибка подлючения к базе' . PHP_EOL;
    return;
} else {
    echo 'Подлючение прошло успешно!' . PHP_EOL;
}

//Проверяем по email есть ли пользователь в базе и получаем в $userId id пользователя из базы
try {
    $str = $dbConnect->prepare("SELECT id, email FROM users WHERE email = ?");
    $str->execute([$_POST['email']]);
    $userId = $str->fetchColumn(0);
} catch (PDOException $e) {
    echo 'Проблема с запросом поиска по адресу элетронной почты.';
    return;
}

if ($userId === false) {
    try {
        $sth = $dbConnect->prepare("INSERT INTO users(name, email, phone) VALUES (:fname, :femail, :fphone)");
        $sth->execute(array(
            "fname" => strtolower(trim($_POST['name'])),
            "femail" => strtolower(trim($_POST['email'])),
            "fphone" => strtolower(trim($_POST['phone']))
        ));
        $userId = $dbConnect->lastInsertId();
    } catch (PDOException $e) {
        echo 'Проблемы с добавлением нового пользователя в базу.';
        return;
    }

    echo 'Создали нового пользователя!' . PHP_EOL;
} else {
    echo 'Пользователь сущетсвует в базе!' . PHP_EOL;
}


// Фаза2

((!empty($_POST['payment'])) && ($_POST['payment'] == 'card')) ? ($payment = 1) : ($payment = 0);
((!empty($_POST['callback'])) && ($_POST['callback'] == 'on')) ? ($callback = 1) : ($callback = 0);

$sql = "INSERT INTO orders" .
    "(userid, street, building, block, apartment, floor, comment, payment, callback) " .
    "VALUES " .
    "(:fuser_id, :fstreet, :fhome, :fpart, :fappt, :ffloor, :fcomment, :fpayment, :fcallback)";
try {
    $sth = $dbConnect->prepare($sql);
    $sth->execute(array(
        "fuser_id" => $userId,
        "fstreet" => strtolower(trim($_POST['street'])),
        "fhome" => strtolower(trim($_POST['home'])),
        "fpart" => strtolower(trim($_POST['part'])),
        "fappt" => strtolower(trim($_POST['appt'])),
        "ffloor" => strtolower(trim($_POST['floor'])),
        "fcomment" => strtolower(trim($_POST['comment'])),
        "fpayment" => $payment,
        "fcallback" => $callback
    ));
    $orderId = $dbConnect->lastInsertId();
    echo 'Записали заказ в базу!' . PHP_EOL;
} catch (PDOException $e) {
    echo 'Проблема с добавлением нового заказа в базу.';
    return;
}

// Фаза 3

require_once 'functions.php';

$letters = __DIR__ . DIRECTORY_SEPARATOR . '../letters';
if (!file_exists($letters)) {
    try {
        mkdir($emailsFolder, 0777);
    } catch (ErrorException $e) {
        echo 'Отсутствует папка с архив писем или не удалось ее создать';
        return;
    }
}

$emailFileName = $letters . DIRECTORY_SEPARATOR . date('Y-m-d__H-i-s') . '.txt';

$userAddress = makeAddress($_POST['street'], $_POST['home'], $_POST['part'], $_POST['appt'], $_POST['floor']);
$userOrderNum = getOrderNumber($dbConnect, $userId);

$emailText = "Заказ № $orderId" . PHP_EOL;
$emailText .= "Ваш заказ будет доставлен по адресу:\n" . PHP_EOL;
$emailText .= $userAddress . "\n\n" . PHP_EOL;
$emailText .= "Состав заказа: \n" . PHP_EOL;
$emailText .= "DarkBeefBurger за 500 рублей, 1 шт\n\n" . PHP_EOL;
$emailText .= "Спасибо!\n" . PHP_EOL;
$emailText .= "Это Ваш " . $userOrderNum . " заказ!\n" . PHP_EOL;

file_put_contents($emailFileName, $emailText);
echo 'Письмо сформированно и сохраненно!' . PHP_EOL;
