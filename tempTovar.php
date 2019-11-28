<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 24.01.2019
 * Time: 13:04
 */
$host = '127.0.0.1';
$db = 'testworktrafgid';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,];
$pdo = new PDO($dsn, $user, $pass, $opt);
$id_el = isset($_REQUEST['id_el']) ? $_REQUEST['id_el'] : '';
if ($id_el == 'Запрос 1') {
    $query = 'SELECT requests.id, offers.name, requests.price, requests.count, operators.fio FROM operators
  INNER JOIN requests ON operators.id=requests.operator_id
  INNER JOIN offers ON requests.offer_id=offers.id WHERE count>2 AND operator_id IN (10,12)';
} elseif ($id_el == 'Запрос 2') {
    $query = 'SELECT offers.name, requests.count, requests.price FROM offers
   INNER JOIN requests ON offers.id=requests.offer_id GROUP BY offer_id';
}
$stmt = $pdo->query($query);
/*echo '<h5>Номер заказа, имя товара, цена, количество, имя оператора за которым числится заказ </h5>';
echo '<table class="table table-dark">';
echo '<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Имя</th>
      <th scope="col">Цена</th>
      <th scope="col">Количество товара</th>
      <th scope="col">ФИО оператора</th>
    </tr>
  </thead>
  <tbody>';
while ($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'] .'</td><td>'.$row['price'].'</td><td>'.$row['count'].'</td><td>'.$row['fio'].'</td></tr>';
}
echo '</tbody>
</table>';*/

/*echo '<h5>Имя товара, количество товара, и сумма (price) по каждому товару </h5>';
$stmt = null;
$stmt = $pdo->query($query2);
echo '<table class="table table-dark">';
echo '<thead>
    <tr>
      <th scope="col">Имя</th>
      <th scope="col">Количество товара</th>
      <th scope="col">Цена</th>
    </tr>
  </thead>
  <tbody>';
while ($row = $stmt->fetch(PDO::FETCH_LAZY))
{
    echo '<tr><td>'.$row['name'].'</td><td>'.$row['count'] .'</td><td>'.$row['price'].'</td></tr>';
}
echo '</tbody>
</table>';*/

?>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 26.05.2019
 * Time: 19:45
 */
?>