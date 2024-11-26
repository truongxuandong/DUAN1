<?php
// Start the session
session_start();

// Include necessary files
require_once '../commons/env.php';
require_once '../commons/core.php';

// Include layout components
require_once './views/layout/header.php';
require_once './views/layout/navbar.php';

// Include Controllers
require_once './controllers/HomeController.php';

// Include Models
require_once './models/danhmuc.php';
require_once './models/sanpham.php';

// Instantiate the HomeController
$home = new HomeController();

// Get the requested action from the URL or default to '/'
$act = $_GET['act'] ?? '/';

// Handle routing using a match statement
match ($act) {
    '/' => $home->views_home(),          // Homepage
    'chitietsp' => $home->views_chitietsp(), // Product details
    'sanpham' => $home->views_sanpham(),     // Product list
    'lienhe' => $home->views_lienhe(),       // Contact page
    'timkiem' => $home->views_timkiem(),     // Search functionality
    default => $home->views_home(),          // Default route (Homepage)
};

// Include footer layout
include './views/layout/footer.php';
?>
