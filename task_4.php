<?php
header("Content-Type: text/html; charset=utf-8");

class Country {
    public $area;
    public $population;
    public $language;
    private $capital;  // нове приватне поле для демонстрації інкапсуляції

    // Конструктор для ініціалізації полів
    public function __construct($area, $population, $language, $capital) {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
        $this->capital = $capital;  // встановлюємо значення приватного поля
    }

    // Метод для встановлення значення поля
    public function set($field, $value) {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        } elseif ($field === 'capital') {
            $this->setCapital($value);  // використання інкапсуляції
        } else {
            echo "Field $field does not exist.";
        }
    }

    // Метод для отримання значення поля
    public function get($field) {
        if (property_exists($this, $field)) {
            return $this->$field;
        } elseif ($field === 'capital') {
            return $this->getCapital();  // використання інкапсуляції
        } else {
            return "Field $field does not exist.";
        }
    }

    // Метод для виведення значень полів на екран
    public function show() {
        echo "<p>Area: " . $this->area . "</p>";
        echo "<p>Population: " . $this->population . "</p>";
        echo "<p>Language: " . $this->language . "</p>";
        echo "<p>Capital: " . $this->getCapital() . "</p>";  // виведення приватного поля через метод
    }

    // Метод для пошуку за одним із полів
    public function search($field, $value) {
        if (property_exists($this, $field)) {
            if ($this->$field == $value) {
                return true;
            }
        } elseif ($field === 'capital') {
            return $this->getCapital() === $value;
        }
        return false;
    }

    // Приватний метод для отримання значення приватного поля "capital"
    private function getCapital() {
        return $this->capital;
    }

    // Приватний метод для встановлення значення приватного поля "capital"
    private function setCapital($capital) {
        $this->capital = $capital;
    }

    // Деструктор для видалення об'єкта
    public function __destruct() {
        echo "Objects are deleted!";
    }

    // Статичний метод для виведення масиву об'єктів
    public static function show_objects($countries) {
        foreach ($countries as $country) {
            $country->show();
        }
    }
}

// Створення трьох об'єктів класу Country
$country1 = new Country("45 339 км²", "1,349 мільйона", "Естонська", "Таллінн");
$country2 = new Country("603 628 км²", "41 мільйона", "Українська", "Київ");
$country3 = new Country("357 022 км²", "83 мільйона", "Німецька", "Берлін");

// Виклик методу для виведення даних
$country1->show();
$country2->show();
$country3->show();

// Зміна значення приватного поля capital через публічний метод set
$country1->set('capital', 'Інкапсульоване значення столиці Естонії: Таллінн');

// Отримання значення приватного поля capital через публічний метод get
echo "<p>Updated Capital for Country1: " . $country1->get('capital') . "</p>";

// Створення масиву з 5 об'єктів класу Country
$countries = [
    new Country("45 339 км²", "1,349 мільйона", "Естонська", "Таллінн"),
    new Country("603 628 км²", "41 мільйона", "Українська", "Київ"),
    new Country("357 022 км²", "83 мільйона", "Німецька", "Берлін"),
    new Country("9 984 670 км²", "38 мільйона", "Англійська", "Оттава"),
    new Country("1 564 116 км²", "19 мільйона", "Румунська", "Бухарест")
];

// Виклик статичного методу для виведення масиву об'єктів
Country::show_objects($countries);

// Видалення об'єктів
unset($country1);
unset($country2);
unset($country3);

?>
