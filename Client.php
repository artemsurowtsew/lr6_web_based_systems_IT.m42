<?php
// Client.php

include_once('EuroAdapter.php');
include_once('Dollar_Calc.php');

class Client {

    private $requestNow;
    private $dollarRequest;

    public function __construct() {
        $this->requestNow = new EuroAdapter(); // Створюємо адаптер для євро
        $this->dollarRequest = new DollarCalc(); // Створюємо калькулятор для доларів

        // Отримуємо суму в євро
        $euro = "&#8364;"; 
        echo "Euros: $euro" . $this->makeAdapterRequest($this->requestNow) . "<br/>";

        // Перетворюємо в долари
        echo "Dollars: $" . $this->makeDollarRequest($this->dollarRequest);
    }

    // Викликаємо адаптер для обчислення євро
    private function makeAdapterRequest(ITarget $req) {
        return $req->requestCalc(40, 50); // 40 товарів + 50 послуг = 90 євро
    }

    // Викликаємо метод для обчислення доларів
    private function makeDollarRequest(DollarCalc $req) {
        return $req->requestCalc(40, 50); // 40 товарів + 50 послуг = 90 доларів
    }
}

// Створюємо об'єкт клієнта
$worker = new Client();
?>
