<?php 

class HomeController 
{
    public $home;

    public function __construct() {

    }

    public function views_home() {
        require_once './views/home.php';
    }
    public function listsanpham(){
        require_once './views/sanpham.php';
    }
    public function giohang(){
        require_once './views/cart.php';
    }
    public function lienhe(){
        require_once './views/contact.php';
    }
} 