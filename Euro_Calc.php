<?php 
// EuroCalc.php

class EuroCalc {
    private $euro;
    private $product;
    private $service;
    public $rate = 1; // Ставка обміну

    // Обробка запиту
    public function requestCalc($productNow, $serviceNow) {
        $this->product = $productNow;
        $this->service = $serviceNow;
        $this->euro = $this->product + $this->service;
        return $this->requestTotal();
    }

    // Повернення результату
    public function requestTotal() {
        $this->euro *= $this->rate; // Множимо на ставку обміну
        return $this->euro;
    }
}
?>
