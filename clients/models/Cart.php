<?php
class Cart {
    public static function addProduct($id, $quantity) {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $quantity;
        } else {
            $_SESSION['cart'][$id] = $quantity;
        }
    }

    public static function getCartItems() {
        return $_SESSION['cart'] ?? [];
    }

    public static function clearCart() {
        unset($_SESSION['cart']);
    }

    public static function getTotal($products) {
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $quantity) {
            $total += $products[$id]['price'] * $quantity;
        }
        return $total;
    }
}
?>
