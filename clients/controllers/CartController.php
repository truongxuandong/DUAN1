<?php
require_once 'models/Product.php';
require_once 'models/Cart.php';

class CartController {
    private $productModel;

    public function __construct($pdo) {
        $this->productModel = new Product($pdo);
    }

    public function viewProducts() {
        $products = $this->productModel->getAllProducts();
        include 'views/products.php';
    }

    public function addToCart() {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'] ?? 1;
        Cart::addProduct($productId, $quantity);
        header("Location: index.php?action=cart");
    }

    public function viewCart() {
        $cartItems = Cart::getCartItems();
        $products = [];
        
        foreach ($cartItems as $id => $quantity) {
            $products[$id] = $this->productModel->getProduct($id);
            $products[$id]['quantity'] = $quantity;
        }
        
        $total = Cart::getTotal($products);
        include 'views/cart.php';
    }
}
?>
