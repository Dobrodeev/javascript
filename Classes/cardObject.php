<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 28.07.2019
 * Time: 20:07
 */
include 'DebetCard.php';
$card = new DebetCard();
/*define(VISA, 4102321252026611);
define(MASTERCARD, 5363542306897142);*/
$cards = [4102321252026611, 5363542306897142, 4388576018402626, 4388576018410707, 8388576018410707];
$card->checkCard($cards[4]);