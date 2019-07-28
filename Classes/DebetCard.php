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
        $doubleDown = 0;
        $oddSum = 0;
        if (in_array($getFirst, $firstNumber)) {
            for ($i = count($str_split) - 1; $i >= 0; $i--) {
                if ($i % 2 == 0) {
                    $str_split[$i] = $str_split[$i] * 2;
                    if ($str_split > 9) {
                        $first = (int)($str_split[$i] / 10);
                        $second = $str_split[$i] % 10;
                        $str_split[$i] = $first + $second;
                        $doubleDown += $str_split[$i];
                    }
                } else {
                    $oddSum += $str_split[$i];
                }
            }
            $amount = $doubleDown + $oddSum;
            if ($amount % 10 == 0)
                echo 'Card is valid. <br>';
            else
                echo 'Card is not valid. <br>';
            echo '$doubleDown = ' . $doubleDown . '<br>';
            echo '$oddSum = ' . $oddSum . '<br>';
            echo '$amount = ' . $amount . '<br>';
        }
    }
}