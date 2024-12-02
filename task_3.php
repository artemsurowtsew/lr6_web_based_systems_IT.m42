<?php
header("Content-Type: text/html; charset=utf-8");

// Інтерфейс для прототипів
interface Prototype {
    public function clone(): Prototype;
}

// Абстрактні класи Автобусів, Вантажівок та Легкових автомобілів, які реалізують інтерфейс Prototype
abstract class Bus implements Prototype {
    protected $brand;
    public function __construct($brand) {
        $this->brand = $brand;
    }
    public function getInfo() {
        return "Bus: $this->brand";
    }
    public function clone(): Prototype {
        return clone $this;
    }
}

abstract class Truck implements Prototype {
    protected $brand;
    public function __construct($brand) {
        $this->brand = $brand;
    }
    public function getInfo() {
        return "Truck: $this->brand";
    }
    public function clone(): Prototype {
        return clone $this;
    }
}

abstract class PassengerCar implements Prototype {
    protected $brand;
    public function __construct($brand) {
        $this->brand = $brand;
    }
    public function getInfo() {
        return "PassengerCar: $this->brand";
    }
    public function clone(): Prototype {
        return clone $this;
    }
}

// Конкретні класи для вітчизняних автомобілів
class UABus extends Bus {}
class UATruck extends Truck {}
class UAPassengerCar extends PassengerCar {}

// Конкретні класи для зарубіжних автомобілів
class ForeignBus extends Bus {}
class ForeignTruck extends Truck {}
class ForeignPassengerCar extends PassengerCar {}

// Клас PrototypeRegistry для зберігання прототипів
class PrototypeRegistry {
    private $prototypes = [];

    public function registerPrototype($type, Prototype $prototype) {
        $this->prototypes[$type] = $prototype;
    }

    public function getPrototype($type): Prototype {
        if (!isset($this->prototypes[$type])) {
            throw new Exception("Prototype for $type not found.");
        }
        return $this->prototypes[$type]->clone();
    }
}

// Реєстрація прототипів
$registry = new PrototypeRegistry();
$registry->registerPrototype('ua_bus', new UABus('Bogdan'));
$registry->registerPrototype('ua_truck', new UATruck('Volodymyr'));
$registry->registerPrototype('ua_car', new UAPassengerCar('ZAZ'));
$registry->registerPrototype('foreign_bus', new ForeignBus('Mercedes'));
$registry->registerPrototype('foreign_truck', new ForeignTruck('Volvo'));
$registry->registerPrototype('foreign_car', new ForeignPassengerCar('BMW'));

// Зчитування конфігураційного файлу
$config = parse_ini_file('config.ini');
$factoryType = $config['factory']; // ua або foreign
$carNum = (int)$config['carNum'];
$truckNum = (int)$config['truckNum'];
$busNum = (int)$config['busNum'];

// Створення парку автомобілів за допомогою прототипів
$carPark = [];
for ($i = 0; $i < $carNum; $i++) {
    $carPark[] = $registry->getPrototype("{$factoryType}_car");
}
for ($i = 0; $i < $truckNum; $i++) {
    $carPark[] = $registry->getPrototype("{$factoryType}_truck");
}
for ($i = 0; $i < $busNum; $i++) {
    $carPark[] = $registry->getPrototype("{$factoryType}_bus");
}

// Виведення інформації про автомобілі
foreach ($carPark as $vehicle) {
    echo $vehicle->getInfo() . "<br>";
}
?>
