<?php
session_start();
require_once '../commons/env.php';
require_once '../commons/core.php';














// index phục vụ request của admin

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new DashboardController())->dashboard()

    
};