<?php
class MainClass {
    public static function who() {
        echo __CLASS__;
    }
    public static function test() {
        static::who();
    }
}

class AditionalClass extends MainClass {
    public static function who() {
        echo __CLASS__;
        parent::who();
    }
}
$class_name = 'MainClass';
$class_name::test();
echo "<br>";
AditionalClass::test();
