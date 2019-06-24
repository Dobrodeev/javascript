<?php
$host = '127.0.0.1';
$db   = 'graphics';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
//$rel = 'man';
$rel = intval(addslashes($_REQUEST['rel']));
//echo 'get_type(): '.gettype($rel).'<br>';
//$html = '';
/*try{
    if (gettype($rel) != 'integer' && gettype($rel) != 'float' && gettype($rel) != 'double')
    {
        throw new PDOException('Невозможно передать string в SQL запрос.');
    }

}*/
$query = "SELECT * FROM probability LIMIT $rel, 4";
$stmt = $pdo->query($query);
$i = 0;
    while ($row = $stmt->fetch())
    {
        if ($i == 3) break;
        $html .= '<tr><td>'.$row['probability_id'].'</td><td>'.$row['first'].'</td><td>'.$row['second'].'</td></tr>';
        $i ++;
    }
    $data['dt'] = $html;
    $data['cmt'] = $stmt->rowCount();
    $data = json_encode($data);
    echo $data;
/*catch (PDOException $exception)
{
    echo 'Была ошибка: '.$exception->getMessage();
}*/

