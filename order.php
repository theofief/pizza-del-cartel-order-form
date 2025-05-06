<?php
// order.php

$menu = [
    "margherita" => 8.99,
    "pepperoni" => 9.99,
    "hawaiian" => 10.99,
    "vegetarian" => 9.49,
    "bbq-chicken" => 11.99,
    "meat-lovers" => 12.99,
    "seafood" => 13.99,
    "supreme" => 14.99,
    "cheese" => 7.99,
    "spicy" => 10.49,
    "chicken" => 11.49,
    "veggie" => 9.99,
    "pesto" => 10.99,
    "buffalo" => 11.99,
    "chili" => 10.49,
    "garlic" => 9.49,
    "spinach" => 9.99,
    "eggplant" => 10.49
];

$toppings = [
    "extra-cheese" => 1.50,
    "mushrooms" => 1.00,
    "onions" => 0.75,
    "green-peppers" => 0.75,
    "black-olives" => 1.25,
    "pineapple" => 1.50,
    "spinach" => 1.00,
    "jalapenos" => 1.25,
    "chicken" => 2.00,
    "bacon" => 2.50,
    "sausage" => 2.00,
    "pepperoni" => 2.00,
    "anchovies" => 2.50,
    "feta-cheese" => 1.50,
    "artichokes" => 2.00
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $road = htmlspecialchars($_POST['road']);
    $postal = htmlspecialchars($_POST['postal']);
    $city = htmlspecialchars($_POST['city']);
    $phone = htmlspecialchars($_POST['phone']);
    $pizza = $_POST['pizza-name'] ?? [];
    $size = htmlspecialchars($_POST['size']);
    $toppingsSelected = $_POST['toppings'] ?? [];

    if (!is_array($pizza)) $pizza = [$pizza];

    $margheritaCount = 0;
    $total = 0;

    foreach ($pizza as $item) {
        if (array_key_exists($item, $menu)) {
            $total += $menu[$item];
            if ($item === 'margherita') $margheritaCount++;
        }
    }

    // Promotion : 2 achetées, 1 offerte
    if ($margheritaCount >= 3) {
        $freePizzas = intdiv($margheritaCount, 3);
        $total -= $menu['margherita'] * $freePizzas;
    }

    foreach ($toppingsSelected as $topping) {
        if (array_key_exists($topping, $toppings)) {
            $total += $toppings[$topping];
        }
    }

    switch ($size) {
        case 'small': $total *= 0.8; break;
        case 'medium': $total *= 1.0; break;
        case 'large': $total *= 1.2; break;
    }
    
    session_start();
    $_SESSION['name'] = $name;
    $_SESSION['total'] = number_format($total, 2);
    header("Location: confirmation.php");
    exit();
}
?>