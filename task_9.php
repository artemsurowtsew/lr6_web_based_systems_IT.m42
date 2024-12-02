
<?php
header("Content-Type: text/html; charset=utf-8");

class Country {
    public $area;
    public $population;
    public $language;
    private $capital;

    public function __construct($area, $population, $language, $capital) {
        $this->area = $area;
        $this->population = $population;
        $this->language = $language;
        $this->capital = $capital;
    }

    public function set($field, $value) {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        } elseif ($field === 'capital') {
            $this->setCapital($value);
        } else {
            echo "Field $field does not exist.";
        }
    }

    public function get($field) {
        if (property_exists($this, $field)) {
            return $this->$field;
        } elseif ($field === 'capital') {
            return $this->getCapital();
        } else {
            return "Field $field does not exist.";
        }
    }

    public function show() {
        echo "<p>Area: " . $this->area . "</p>";
        echo "<p>Population: " . $this->population . "</p>";
        echo "<p>Language: " . $this->language . "</p>";
        echo "<p>Capital: " . $this->getCapital() . "</p>";
    }

    public function search($field, $value) {
        if (property_exists($this, $field)) {
            return $this->$field == $value;
        } elseif ($field === 'capital') {
            return $this->getCapital() === $value;
        }
        return false;
    }

    private function getCapital() {
        return $this->capital;
    }

    private function setCapital($capital) {
        $this->capital = $capital;
    }
}

interface CountryAdapterInterface {
    public function displayCountryDetails($country);
}

class HtmlCountryAdapter implements CountryAdapterInterface {
    public function displayCountryDetails($country) {
        echo "<div style='border: 1px solid black; padding: 10px;'>";
        echo "<h3>Country Information (HTML Format)</h3>";
        $country->show();
        echo "</div>";
    }
}

class TextCountryAdapter {
    public function displayCountryDetails($country) {
        // Використовуємо метод get() для доступу до capital
        echo "Country details: <br>";
        echo "Area: " . $country->get('area') . "<br>";
        echo "Population: " . $country->get('population') . "<br>";
        echo "Language: " . $country->get('language') . "<br>";
        echo "Capital: " . $country->get('capital') . "<br>";  // Використовуємо get() для capital
    }
}

class CountryDisplayManager {
    private $adapter;

    public function setAdapter(CountryAdapterInterface $adapter) {
        $this->adapter = $adapter;
    }

    public function display($country) {
        $this->adapter->displayCountryDetails($country);
    }
}

// Створення об'єкта Country
$country1 = new Country("45 339 км²", "1,349 мільйона", "Естонська", "Таллінн");

// Створення об'єкта менеджера виведення
$manager = new CountryDisplayManager();

// Вибір адаптера для виведення в HTML
$htmlAdapter = new HtmlCountryAdapter();
$manager->setAdapter($htmlAdapter);
$manager->display($country1);  // Виведення в HTML форматі

// Вибір адаптера для виведення в текстовому форматі
$textAdapter = new TextCountryAdapter();
$manager->setAdapter($textAdapter);
$manager->display($country1);  // Виведення в текстовому форматі

?>
