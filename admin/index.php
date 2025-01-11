<?php
session_start();

require_once '../commons/env.php';
require_once '../commons/core.php';
require_once './models/AuthModel.php';

$auth = new Auth();

// Thiết lập thời gian timeout session (10 phút = 600 giây)
$timeout = 600;

// Chỉ kiểm tra timeout nếu đã đăng nhập
if (isset($_SESSION['admin_id'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        $auth->logout();
        exit;
    }
    // Cập nhật thời gian hoạt động
    $_SESSION['last_activity'] = time();
}

// Lấy action từ URL
$act = $_GET['act'] ?? '';

// Danh sách các route được phép truy cập khi chưa đăng nhập
$publicRoutes = ['loginAdmin', 'show-login-form', 'end-session'];

// Kiểm tra xem người dùng đã được xác thực từ trang clients chuyển sang
if (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true && isset($_SESSION['user'])) {
    // Thiết lập đầy đủ các session cần thiết cho admin
    $_SESSION['admin_id'] = $_SESSION['user']['id'];
    $_SESSION['admin_name'] = $_SESSION['user']['name'] ?? '';
    $_SESSION['admin_role'] = $_SESSION['user']['role'];
    $_SESSION['is_logged_in'] = true;
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['last_activity'] = time();
    
    unset($_SESSION['admin_auth']); // Xóa session tạm thời
    
    // Chuyển hướng về trang chủ admin
    header('Location: ?act=/');
    exit;
} else {
    // Kiểm tra đăng nhập
    if (!isset($_SESSION['admin_id'])) {
        if (!in_array($act, $publicRoutes)) {
            header('Location: ?act=show-login-form');
            exit;
        }
    }
}

// Xử lý kết thúc session chỉ khi có request rõ ràng
if ($act === 'end-session' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    $auth->endSession();
    exit;
}

// Các require controllers và models
require_once './controllers/BinhluanController.php';
require_once './controllers/HomeController.php';
require_once './controllers/OrderController.php';
require_once './controllers/UserController.php';
require_once './controllers/GiaodienController.php';
require_once './controllers/SanPhamController.php';
require_once './controllers/DanhMucController.php';
require_once './controllers/KhuyenMaiController.php';
require_once './controllers/AuthController.php';

require_once './models/User.php';
require_once './models/Order.php';
require_once './models/VariantSanPham.php';
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/KhuyenMai.php';
require_once './models/AdminBinhluan.php';
require_once './models/AdminBanner.php';
require_once './models/Thongke.php';

$home = new HomeController();
$user = new userController();
$order = new OrderController();
$khuyenmai = new KhuyenMaiController();

// Include header nếu không phải trang login
if (!in_array($act, $publicRoutes)) {
    include_once "./views/layout/header.php";
    include_once "./views/layout/sidebar.php";
}

// Xử lý routing
match ($act) {
    '' => !isset($_SESSION['admin_id'])
        ? header('Location: ?act=show-login-form')
        : $home->views_home(),
    'loginAdmin' => (new AuthController())->login(),
    'show-login-form' => (new AuthController())->showLoginForm(),
    'logout' => $auth->logout(),
    'end-session' => exit(),

    '/' => $home->views_home(),
    //user
    'user' => $user->views_user(),
    'add-user' => $user->views_add_user(),
    'post-add-user' => $user->views_post_add_user(),
    'edit-user' => $user->views_edit_user(),
    'post-edit-user' => $user->views_post_edit_user(),
    'delete-user' => $user->delete_user(),

    //order
    'order' => $order->views_order(),
    
    'edit-order' => $order->views_edit_order(),
    'post-edit-order' => $order->views_post_edit_order(),
    'order-detail' => $order->views_order_detail(),

    //banner
    'giao-dien' => (new AdminGiaodienController())->listBanner(),
    'form-add-banner' => (new AdminGiaodienController())->formaddBanner(),
    'add-banner' => (new AdminGiaodienController())->postaddBanner(),
    'toggle-banner-status' => (new AdminGiaodienController())->UpdataBannerStatus(),
    'delete-banner' => (new AdminGiaodienController())->deleteBanner(),
    'form-edit-banner' => (new AdminGiaodienController())->formEditBanner(),
    'edit-banner' => (new AdminGiaodienController())->postEditBanner(),

    //binh luan
    'binh-luan' => (new AdminBinhluanController())->listBinhluan(),
    'update-trang-thai-binh-luan' => (new AdminBinhluanController())->updateTrangThaiBinhLuan(),

    'danh-gia' => (new AdminBinhluanController())->listDanhgia(),
    'delete-danhgia' => (new AdminBinhluanController())->deletedanhgia(),
    'approve-danhgia' => (new AdminBinhluanController())->approveDanhGia(),
    'reject-danhgia' => (new AdminBinhluanController())->rejectDanhGia(),

    // rou danh mục
    'listdm' => (new DanhMucController())->danhsachDanhMuc(),
    'form-them-danh-muc' => (new DanhMucController())->formAddDanhMuc(),
    'post-danh-muc' => (new DanhMucController())->postAddDanhMuc(),
    'form-sua-danh-muc' => (new DanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' => (new DanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' => (new DanhMucController())->deleteDanhMuc(),
    //route san pham
    'san-pham' => (new SanPhamController())->danhSachSanPham(),
    'form-them-san-pham' => (new SanPhamController())->formAddSanPham(),
    'them-san-pham' => (new SanPhamController())->postAddSanPham(),
    'form-sua-san-pham' => (new SanPhamController())->formEditSanPham(),
    'sua-san-pham' => (new SanPhamController())->postEditSanPham(),
    'xoa-san-pham' => (new SanPhamController())->postDeleteSanPham(),

    //khuyen mai
    'khuyen-mai' => $khuyenmai->View_KhuyenMai(),
    'form-add-khuyen-mai' => $khuyenmai->formAddKhuyenMai(),
    'post-add-khuyen-mai' => $khuyenmai->postAddKhuyenMai(),
    'form-edit-khuyen-mai' => $khuyenmai->formEditKhuyenMai(),
    'post-edit-khuyen-mai' => $khuyenmai->postEditKhuyenMai(),
    'delete-khuyen-mai' => $khuyenmai->deleteKhuyenMai(),

    //rou bien the sp

    'chi-tiet-bien-the-sp' => (new SanPhamController())->danhSachVariants(),
    'form-them-bien-the' => (new SanPhamController())->formAddVariant(),
    'them-bien-the' => (new SanPhamController())->postAddVariant(),
    'form-sua-bien-the' => (new SanPhamController())->formEditVariant(),
    'sua-bien-the' => (new SanPhamController())->postEditVariant(),
    'xoa-bien-the' => (new SanPhamController())->postDeleteVariant(),

    //binh luan
    'binh-luan' => (new AdminBinhluanController())->listBinhluan(),
    'update-trang-thai-binh-luan' => (new AdminBinhluanController())->updateTrangThaiBinhLuan(),
    'danh-gia' => (new AdminBinhluanController())->listDanhgia(),
    'delete-danhgia' => (new AdminBinhluanController())->deletedanhgia(),
    'approve-danhgia' => (new AdminBinhluanController())->approveDanhGia(),
    'reject-danhgia' => (new AdminBinhluanController())->rejectDanhGia(),

    default => header('Location: ?act=show-login-form')
};

// Include footer nếu không phải trang login
if (!in_array($act, $publicRoutes)) {
    include_once "./views/layout/footer.php";
}

// Thêm định nghĩa BASE_URL ở đầu file hoặc trong file config
// define('BASE_URL', 'http://localhost/duan1/');
// define('UPLOAD_PATH', $_SERVER['DOCUMENT_ROOT'] . '/duan1/uploads/');
// define('UPLOAD_URL', BASE_URL . 'uploads/');
