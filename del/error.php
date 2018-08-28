<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница фильтрации ошибок</title>
</head>

<body>

<p>Произошла ошибка!</p>
<p>Код ошибки: <?php echo $_GET['errcode'] . '<br>';  ?></p>

<p>Cписок ошибок: </p>
<ul>
    <li>Ошибка 001 - Одного из ключевых полей пусто. Номер телефона или адрес электронной почты.</li>
    <li>Ошибка 002 - Не произошло соединение с базой. Проверте настройки подключения.</li>
    <li>Ошибка 003 - Проблема с запросом поиска по адресу элетронной почты.</li>
    <li>Ошибка 004 - Проблемы с добавлением нового пользователя в базу.</li>
    <li>Ошибка 005 - Проблема с добавлением нового заказа в базу</li><br>
    <li>Ошибка 006 - Проблема с запросом кол-ва заказов у конкретного пользователя</li>
    <li>Ошибка 007 - Отсутствует папка ахив писем и не удалось ее создать.</li>
    <li>Ошибка 008 - Проблема с получением данных о клиентах.</li>
    <li>Ошибка 009 - Проблема с получением данных о заказах.</li>
</ul>

</body>
</html>
