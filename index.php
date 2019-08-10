<?php
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');
session_name("test");
session_start();
//phpinfo();
$_SESSION['count'] = @$_SESSION['count'] + 1;
if ($_SESSION['count'] > 5)
{
    echo 'Вопросов было: '.$_SESSION['count'].'<br>';
    echo 'Правильных ответов: '.$_SESSION['true_answer'].'<br>';
    $_SESSION = array();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $lang['graphics']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css ">
</head>
<body>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<?
spl_autoload_register(function ($className)
{
    include $className.'.php';
});
//В текущей сессии работы с браузером Вы открыли эту страницу

$questionGraphics = new Images(4);
$questionGraphics->get_true_image();
$questionGraphics->get_indexes();

?>
<p>Вопрос номер <?=$_SESSION['count']?></p>
<p>Правильных ответов <?=$_SESSION['true_answer']?></p>
<form action="#" method="post">
    <?php $questionGraphics->get_all_image(); ?>
    <input type="hidden" name="trueVariant" value="<? $questionGraphics->getTrueIndex()?>">
    <button type="submit" class="btn btn-default" name="go">Submit</button>
</form>
<?php
if (isset($_POST['go']))
{
    $answer = $_POST['optionsRadios'];
    $true = $_POST['trueVariant'];
    if ($answer == $true)
        $_SESSION['true_answer'] ++;
}
?>
</body>
</html>