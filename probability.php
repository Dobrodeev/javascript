<?php
include 'assets/DB.php';
$page = 1;
if (isset($_REQUEST['page']))
{
    $page = addslashes($_REQUEST['page']);
}
$offset = $page * 5;
$query = "SELECT * FROM probability LIMIT $offset, 5";
$query2 = "SELECT COUNT(probability_id) as cmt FROM probability";
$stmt = $pdo->query($query);
$stmt2 = $pdo->query($query2);
$stmt2 = $stmt2->fetch();
$allRows = $stmt2['cmt'];
$allPages = ceil($allRows / 5);
/*echo 'AllPages: '.$allPages.'<br>';
echo 'AllROWS/5: '.($allRows/5).'<br>';*/
while ($row = $stmt->fetch())
{
    $html .= '<tr><td>'.$row['probability_id'].'</td><td>'.$row['first'].'</td><td>'.$row['second'].'</td></tr>';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
        .hide {
            opacity: 0;
        }
    </style>
</head>
<body>
<script src="assets/jquery-3.3.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<h5>Результаты нескольких опытов бросания монеты</h5>
<!--<table class="table table-striped table-bordered table-hover">-->
<table class="table table-condensed probability">
    <tr><th>Число бросаний</th><th>Число появлений герба</th><th>Относительная частота</th></tr>
    <tr><td>4040</td><td>2048</td><td>0,5069</td></tr>
    <tr><td>12000</td><td>6019</td><td>0,5016</td></tr>
    <tr><td>24000</td><td>12012</td><td>0,5005</td></tr>

</table>
<div class="hide"></div>
<button class="show-more" data-rel="3">Show more</button>

<h5>Список наук по сложности изучения</h5>

<table class="table table-bordered">
    <?=$html?>
</table>

<? if ($allPages > 1){?>
<form action="" method="get">
</form>
<?}?>
<h4>Спрортивный инвентарь</h4>
<table class="table table-condensed table-hover">
    <tr><th>id_product</th><th>name_product</th><th>price_product</th></tr>
    <tr class="active"><td>1</td><td>Шорты бифлекс</td><td>150</td></tr>
    <tr class="success"><td>2</td><td>Шорты бифлекс высокие</td><td>250</td></tr>
    <tr><td>3</td><td class="active">Топ (трикотаж)</td><td>80</td></tr>
    <tr><td>4</td><td>Топ со вставками в ассортименте</td><td>150</td></tr>
    <tr><td>5</td><td>Гетры (80 см)</td><td>130</td></tr>
    <tr><td>6</td><td>Жидкая магнезия 50 мл</td><td>70</td></tr>
    <tr><td>7</td><td>Жидкая магнезия 100 мл</td><td>110</td></tr>
    <tr><td>8</td><td>Жидкая магнезия 200 мл</td><td>170</td></tr>
    <tr><td>9</td><td>Наколенники с мягкими вставками</td><td>290</td></tr>
    <tr><td>10</td><td>Шорты для разогрева</td><td>200</td></tr>

</table>
<script>
    $(document).ready(function() {
        $('.show-more').on("click", function(){
            let rel = +$(this).attr('data-rel');
            $.ajax({
                url: "../assets/ajax.php",
                type: "POST",
                dataType: 'json',
                cache: false,
                data: {"rel": rel},
                success: function (data) {
                    if (+data.cmt < 4) $('.show-more').css('display', 'none');
                    $('.probability').append(data.dt);
                    rel += 3;
                    $('.show-more').attr('data-rel', rel);
                }
            });
        });
    });
    // скрытие на клик
    /*$(function(){

        $('#spoiler').click(function(){
            $('.hidden').slideDown();
            $('#spoiler').text('Скрыть');
        });

    });*/
</script>
</body>
</html>

