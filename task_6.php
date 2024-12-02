<?php

// Target: Інтерфейс, який очікує клієнт
interface CurrencyConverter
{
    public function getPriceInCurrency(): float;
}

// Adaptee: Стара система, яка працює в іншій валюті (гривня)
class PriceInUAH
{
    private $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

// Adapter: Адаптер, який використовує спадкування для переведення в новий інтерфейс
class PriceAdapter extends PriceInUAH implements CurrencyConverter
{
    private $conversionRateUSD = 0.027; // Тариф для переведення в долари
    private $conversionRateEUR = 0.025; // Тариф для переведення в євро

    // Переведення ціни в долари
    public function getPriceInUSD(): float
    {
        return $this->getPrice() * $this->conversionRateUSD;
    }

    // Переведення ціни в євро
    public function getPriceInEUR(): float
    {
        return $this->getPrice() * $this->conversionRateEUR;
    }

    // Адаптований метод для отримання ціни в доларах
    public function getPriceInCurrency(): float
    {
        return $this->getPriceInUSD(); // Можна змінити на getPriceInEUR() для євро
    }
}

// Клієнт: клас, що використовує адаптований інтерфейс
class Client
{
    private $currencyConverter;

    public function __construct(CurrencyConverter $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    public function showPrice()
    {
        echo "Price in currency: " . $this->currencyConverter->getPriceInCurrency() . "<br>";
    }
}

// Створюємо новий об'єкт ціни в гривнях
$priceInUAH = new PriceAdapter(1000); // Ціна 1000 гривень

// Створюємо клієнт, який використовує адаптовану ціну
$client = new Client($priceInUAH);

// Показуємо ціну у доларах
$client->showPrice();

?>
