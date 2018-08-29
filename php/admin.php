<per>
<?php

$dbConnect = require_once 'dbconnect.php';

if ($dbConnect === false) {
    header("Location: error.php?errcode=002");
    return;
}

try {
    // Пользователи:
    $sth_users = $dbConnect->query('SELECT * FROM users');
} catch (PDOException $e) {
    echo 'Ошибка запроса к таблице пользователи';
    return;
}
try {
    // Заказы:
    $sth_orders = $dbConnect->query('SELECT orders.*, users.name FROM orders,users WHERE orders.userid=users.id');
} catch (PDOException $e) {
    echo 'Ошибка запроса к таблице заказы';
    return;
}
?>

<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админка</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css">
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 30px;
            font-family: "Verdana", sans-serif;
            font-size: 15px;
        }

        table {
            border: 1px solid #d3d3d3;
            border-collapse: collapse;
            text-align: left;
            margin-bottom: 30px;
        }

        thead {
            text-align: center;
            background-color: #eaeaea;
        }

        tbody {
            font-size: 14px;
        }

        td {
            padding: 6px 0;
            margin: 0;
            border: 1px solid #d4d4d4;
            vertical-align: middle;
        }

        .table-name {
            text-align: left;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 0 11px 15px;
            background-color: #c4e2ba;
        }

        .td-align-center {
            text-align: center;
        }

        .td-align-left {
            text-align: left;
            padding-left: 15px;
        }
    </style>

</head>
<body>

<table>
    <thead>
    <tr>
        <td colspan="4" class="table-name">Clients:</td>
    </tr>
    <tr>
        <td width="50px">id</td>
        <td width="200px">name</td>
        <td width="300px">email</td>
        <td width="200px">phone</td>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $sth_users->fetch()) : ?>
        <tr>
            <td class="td-align-center"><?php echo $row['id']; ?></td>
            <td class="td-align-left"><?php echo $row['name']; ?></td>
            <td class="td-align-left"><?php echo $row['email']; ?></td>
            <td class="td-align-center"><?php echo $row['phone']; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>


<table>
    <thead>
    <tr>
        <td colspan="5" class="table-name">Orders:</td>
    </tr>
    <tr>
        <td width="50px">id</td>
        <td width="200px">username</td>
        <td width="500px">address</td>
        <td width="80px">payment</td>
        <td width="80px">callback</td>
    </tr>
    </thead>
    <tbody>
    <?php require_once 'functions.php'; ?>
    <?php while ($row = $sth_orders->fetch()) : ?>
        <?php $addr = makeAddress($row['street'], $row['building'], $row['block'], $row['apartment'], $row['floor']); ?>
        <tr>
            <td class="td-align-center"><?php echo $row['id']; ?></td>
            <td class="td-align-left"><?php echo $row['name']; ?></td>
            <td class="td-align-left"><?php echo $addr; ?></td>
            <td class="td-align-center"><?php ($row['payment'] > 0) ? ($p = 'card') : ($p = '$');
                echo $p; ?></td>
            <td class="td-align-center"><?php ($row['callback'] > 0) ? ($c = 'no') : ($c = '');
                echo $c; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
