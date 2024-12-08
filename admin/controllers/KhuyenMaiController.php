
<?php
class KhuyenMaiController
{
    public $modelKhuyenMai;
    public function __construct()
    {
        $this->modelKhuyenMai = new KhuyenMaiModel();
    }
    public function View_KhuyenMai()
    {
        $khuyenmais = $this->modelKhuyenMai->getAllKhuyenMai();
        require_once './views/khuyenmai/listkhuyenmai.php';
    }
    public function formAddKhuyenMai()
    {
        $comics = $this->modelKhuyenMai->getAllIdSp();
        require_once './views/khuyenmai/addkhuyenmai.php';
    }
    
    public function postAddKhuyenMai()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comic_id = $_POST['comic_id'];
        $sale_type = $_POST['sale_type'];
        $sale_value = $_POST['sale_value'];
        $status = $_POST['status'];
        $start_date = strtotime($_POST['start_date'] . ' ' . $_POST['start_time']);
        $end_date = strtotime($_POST['end_date'] . ' ' . $_POST['end_time']);
        $today = strtotime(date('Y-m-d'));

        if ($start_date < $today) {
            $_SESSION['error'] = 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại';
            header('location: ?act=form-add-khuyen-mai');
            exit();
        }

        
        if ($end_date <= $start_date) {
            $_SESSION['error'] = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
            header('location: ?act=form-add-khuyen-mai');
            exit();
        }

        
        if ($sale_type === 'percent') {
           
            if ($sale_value < 1 || $sale_value > 100) {
                $_SESSION['error'] = 'Giá trị giảm phần trăm phải từ 1% đến 100%';
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
        } elseif ($sale_type === 'fixed') {
          
            $min_sale_value = 1000; 
            if ($sale_value < $min_sale_value) {
                $_SESSION['error'] = "Giá trị giảm tiền phải tối thiểu là $min_sale_value";
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
        }

        if ($status == 'active') {
            if ($today < $start_date) {
                $_SESSION['error'] = 'Không thể kích hoạt khuyến mãi trước ngày bắt đầu';
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
            if ($today > $end_date) {
                $_SESSION['error'] = 'Không thể kích hoạt khuyến mãi đã hết hạn';
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
        } elseif ($status == 'inactive') { 
            if ($today < $start_date) {
                $_SESSION['error'] = 'Không thể đánh dấu hết hạn khi chưa đến thời gian khuyến mãi';
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
            if ($today <= $end_date) {
                $_SESSION['error'] = 'Không thể đánh dấu hết hạn khi khuyến mãi vẫn còn hiệu lực';
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
        } elseif ($status == 'pending') {
            if ($today >= $start_date) {
                $_SESSION['error'] = 'Không thể đặt trạng thái chờ khi đã đến hoặc qua ngày bắt đầu';
                header('location: ?act=form-add-khuyen-mai');
                exit();
            }
        }

        // Thêm kiểm tra trùng lặp
        if ($this->modelKhuyenMai->checkExistingPromotion($comic_id, $start_date, $end_date)) {
            $_SESSION['error'] = 'Đã tồn tại khuyến mãi cho truyện này trong khoảng thời gian đã chọn';
            header('location: ?act=form-add-khuyen-mai');
            exit();
        }

        
        if ($this->modelKhuyenMai->addKhuyenMai($comic_id, $sale_type, $sale_value, $start_date, $end_date, $status)) {
            $_SESSION['success'] = 'Thêm khuyến mãi thành công';
            header('location: ?act=khuyen-mai');
            exit();
        } else {
            $_SESSION['error'] = 'Thêm khuyến mãi thất bại';
            header('location: ?act=form-add-khuyen-mai');
            exit();
        }
    }
}

    public function formEditKhuyenMai()
    {
        $khuyenmai = $this->modelKhuyenMai->getKhuyenMaiById($_GET['id']);
        $comics = $this->modelKhuyenMai->getAllIdSp();
        require_once './views/khuyenmai/editkhuyenmai.php';
    }
    public function postEditKhuyenMai()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $comic_id = $_POST['comic_id'];
        $sale_type = $_POST['sale_type'];
        $sale_value = $_POST['sale_value'];
        $status = $_POST['status'];
        $start_date = strtotime($_POST['start_date'] . ' ' . $_POST['start_time']);
        $end_date = strtotime($_POST['end_date'] . ' ' . $_POST['end_time']);
        $today = strtotime(date('Y-m-d'));

        
        if ($start_date < $today) {
            $_SESSION['error'] = 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại';
            header('location: ?act=form-edit-khuyen-mai&id='.$id);
            exit();
        }

        
        if ($end_date <= $start_date) {
            $_SESSION['error'] = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
            header('location: ?act=form-edit-khuyen-mai&id='.$id);
            exit();
        }

        
        if ($sale_type === 'percent') {
            
            if ($sale_value < 1 || $sale_value > 100) {
                $_SESSION['error'] = 'Giá trị giảm phần trăm phải từ 1% đến 100%';
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
        } elseif ($sale_type === 'fixed') {
           
            $min_sale_value = 1000; 
            if ($sale_value < $min_sale_value) {
                $_SESSION['error'] = "Giá trị giảm tiền phải tối thiểu là $min_sale_value";
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
        }

        
        if ($status == 'active') {
            if ($today < $start_date) {
                $_SESSION['error'] = 'Không thể kích hoạt khuyến mãi trước ngày bắt đầu';
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
            if ($today > $end_date) {
                $_SESSION['error'] = 'Không thể kích hoạt khuyến mãi đã hết hạn';
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
        } elseif ($status == 'inactive') { 
            if ($today < $start_date) {
                $_SESSION['error'] = 'Không thể đánh dấu hết hạn khi chưa đến thời gian khuyến mãi';
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
            if ($today <= $end_date) {
                $_SESSION['error'] = 'Không thể đánh dấu hết hạn khi khuyến mãi vẫn còn hiệu lực';
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
        } elseif ($status == 'pending') {
            if ($today >= $start_date) {
                $_SESSION['error'] = 'Không thể đặt trạng thái chờ khi đã đến hoặc qua ngày bắt đầu';
                header('location: ?act=form-edit-khuyen-mai&id='.$id);
                exit();
            }
        }

        // Thêm kiểm tra trùng lặp, loại trừ khuyến mãi hiện tại
        if ($this->modelKhuyenMai->checkExistingPromotion($comic_id, $start_date, $end_date, $id)) {
            $_SESSION['error'] = 'Đã tồn tại khuyến mãi cho truyện này trong khoảng thời gian đã chọn';
            header('location: ?act=form-edit-khuyen-mai&id='.$id);
            exit();
        }

       
        if ($this->modelKhuyenMai->updateKhuyenMai($id, $comic_id, $sale_type, $sale_value, $start_date, $end_date, $status)) {
            $_SESSION['success'] = 'Sửa khuyến mãi thành công';
            header('location: ?act=khuyen-mai');
            exit();
        } else {
            $_SESSION['error'] = 'Sửa khuyến mãi thất bại';
            header('location: ?act=form-edit-khuyen-mai&id='.$id);
            exit();
        }
    }
}
public function deleteKhuyenMai()
{
    $id = $_GET['id'];
    $khuyenmai = $this->modelKhuyenMai->getKhuyenMaiById($id); // Lấy thông tin khuyến mãi

    // Kiểm tra xem khuyến mãi có còn hiệu lực không
    $today = strtotime(date('Y-m-d'));

    // Chuyển đổi end_date sang timestamp nếu cần
    $end_date = strtotime($khuyenmai['end_date']);

    // Kiểm tra nếu ngày hiện tại nhỏ hơn hoặc bằng ngày kết thúc
    if ($today <= $end_date) {
        $_SESSION['error'] = 'Không thể xóa khuyến mãi còn hiệu lực.';
        header('location: ?act=khuyen-mai');
        exit();
    }

    // Nếu đã hết hạn, thực hiện xóa
    $this->modelKhuyenMai->deleteKhuyenMai($id);
    header('location: ?act=khuyen-mai');
}
}