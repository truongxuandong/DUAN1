<?php
// Thêm ở đầu file navbar.php
require_once './models/danhmuc.php';
$modelDanhMuc = new DanhMuc();
$listdm = $modelDanhMuc->getAllDanhMuc();
?>
<!-- Navbar Start -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

</body>

</html>
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="category-dropdown">
                <button class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    onclick="toggleMenu()"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Danh mục sản phẩm</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </button>
                <nav class="position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="category-menu" style="display: none;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <?php foreach ($listdm as $danhmuc): ?>
                            <a href="<?php echo $danhmuc['id']; ?>" class="nav-item nav-link">
                                <?php echo $danhmuc['name']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="?act=/" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                        <span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper
                    </h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="./" class="nav-item nav-link active">Trang chủ</a>
                        <a href="?act=sanpham" class="nav-item nav-link">Sản phẩm</a>
                        <a href="?act=lienhe" class="nav-item nav-link">Liên hệ</a>
                    </div>
                    <?php
                    if (isset($_SESSION['user'])) {
                        // Lấy thông tin email người dùng
                        $email = $_SESSION['user']['email'] ?? 'Người dùng';

                        // Kiểm tra xem người dùng có phải admin hay không
                        $isAdmin = ($_SESSION['role'] ?? '') === 'admin';

                        // Hiển thị menu dropdown tài khoản
                        echo '<div class="dropdown">';
                        echo '<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">';
                        echo '<img src="./assets/img/avata.jpg" alt="Account" style="height: 30px; width: auto;" /> ' . htmlspecialchars($email);
                        echo '</button>';
                        echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                        echo '<li><a class="dropdown-item" href="?act=profile">Tài Khoản Của Tôi</a></li>';

                        // Nếu là admin, hiển thị mục "Quản lý Admin"
                        if ($isAdmin) {
                            echo '<li><a class="dropdown-item" href="?act=admin">Quản lý Admin</a></li>';
                        }

                        echo '<li><a class="dropdown-item" href="?act=logout">Đăng Xuất</a></li>';
                        echo '</ul>';
                        echo '</div>';
                    } else {
                        // Nếu người dùng chưa đăng nhập
                        echo '<a href="?act=login" class="nav-item nav-link">Đăng nhập</a>';
                    }
                    ?>






                </div>
            </nav>
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="https://game8.vn/media/202209/images/toonder-comics-1.jpg" alt="Fashionable Dress">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Fashionable Dress</h3>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="https://hanoi-school.fpt.edu.vn/wp-content/uploads/Thiet-ke-khong-ten-32-1024x536.png" alt="Reasonable Price">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First Order</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Reasonable Price</h3>
                                <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 45px; height: 45px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Navbar End -->

<script>
    function toggleMenu() {
        var menu = document.getElementById('category-menu');
        if (menu.style.display === 'none') {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    }

    // Đóng menu khi click ra ngoài
    document.addEventListener('click', function(event) {
        var menu = document.getElementById('category-menu');
        var button = event.target.closest('.category-dropdown button');
        var isClickInside = event.target.closest('.category-dropdown');

        if (!isClickInside && menu.style.display === 'block') {
            menu.style.display = 'none';
        }
        if (button) {
            event.stopPropagation();
        }
    });
</script>

<style>
    .category-dropdown {
        position: relative;
    }

    #category-menu {
        width: 100%;
        background: white;
        z-index: 999;
        top: 100%;
        left: 0;
    }
</style>