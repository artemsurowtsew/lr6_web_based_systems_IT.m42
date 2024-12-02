<?php
// EuroAdapter.php

include_once('Euro_Calc.php');
include_once('ITarget.php');

class EuroAdapter extends EuroCalc implements ITarget {

    public function __construct() {
        $this->requester(); // Викликаємо метод для ініціалізації ставки
    }

    // Метод для встановлення ставки
    function requester() {
        $this->rate = 0.8111; // Ставка для євро (1 гривня = 0.8111 євро)
        return $this->rate;
    }
}
?>
