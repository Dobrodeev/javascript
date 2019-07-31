<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 28.07.2019
 * Time: 19:11
 */

class DebetCard
{
    public $number;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

//Алгоритм Ганса Луна. Проверка валидности банковских карт.
    public function checkCard($card)
    {
        $firstNumber = [4, 5, 37, 6];
        $str_split = str_split($card);
        $getFirst = $str_split[0];
        /*$doubleDown = 0;
        $oddSum = 0;*/
        $amount = 0;
        if (!in_array($getFirst, $firstNumber) || $str_split[0] == 3 && $str_split[1] != 7) {
//            echo 'Card is not valid. <br>';
            return false;
        }
        for ($i = count($str_split) - 1; $i >= 0; $i--) {
            if ($i % 2 == 0) {
                $str_split[$i] = $str_split[$i] * 2;
                if ($str_split[$i] > 9) {
//                        $first = (int)($str_split[$i] / 10);
//                        $second = $str_split[$i] % 10;
//                        $str_split[$i] = 1 + $str_split[$i] % 10;
                    $amount += 1 + $str_split[$i] % 10;
                }
            } else {
                $amount += $str_split[$i];
            }
        }
//            $amount = $doubleDown + $oddSum;
        if ($amount % 10 == 0)
//            echo 'Card is valid. <br>';
            return true;
        else
//            echo 'Card is not valid. <br>';
            return false;
        /*echo '$doubleDown = ' . $doubleDown . '<br>';
        echo '$oddSum = ' . $oddSum . '<br>';
        echo '$amount = ' . $amount . '<br>';*/
    }
}