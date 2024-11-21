<?php 
class AdminGiaodienController
{
    public $modelgiaodien;
    public function __construct()
    {
        // Khởi tạo model tương ứng
        $this->modelgiaodien = new AdminGiaodien();
    }

    public function listBanner()
    {
        $banners = $this->modelgiaodien->getAllBanners();
        
        require_once './views/qlgiaodien/listbaner.php';
    }
  
    public function formaddBanner()
    {
        // Hiển thị form thêm banner
        require_once './views/qlgiaodien/addbanner.php';
        
    }

    public function postaddBanner()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Lấy dữ liệu từ form
        $Title = $_POST['Title'] ?? '';
        $Description = $_POST['Description'] ?? '';
        $Status = $_POST['Status'] ?? '';
        $Position = $_POST['Position'] ?? 0;
        $Img = $_FILES['Img'] ?? null;

        // Tạo mảng chứa lỗi
        $errors = [];

        // Kiểm tra các trường bắt buộc
        if (empty($Title)) {
            $errors['Title'] = 'Không được để trống';
        }
        if (empty($Description)) {
            $errors['Description'] = 'Không được để trống';
        }
        if (empty($Status)) {
            $errors['Status'] = 'Không được để trống';
        }

        // Xử lý upload ảnh
        $file_thumb = '';
        if (isset($Img) && $Img['error'] === 0) {
            $uploadDir = '../uploads/banner/';
            $fileName = time() . '_' . basename($Img['name']);
            $uploadFile = $uploadDir . $fileName;

            // Kiểm tra nếu thư mục không tồn tại, tạo mới
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($Img['tmp_name'], $uploadFile)) {
                $file_thumb = $uploadFile; // Lưu đường dẫn ảnh đã upload
            } else {
                $errors['Img'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
            }
        } else {
            $errors['Img'] = 'Bạn cần chọn một ảnh để tải lên';
        }

        // Lưu lỗi vào session nếu có lỗi
        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            header("location:" . BASE_URL_ADMIN . '?act=form-add-banner');
            exit();
        }

        // Thêm banner nếu không có lỗi
        if ($this->modelgiaodien->insertBanner(
            $Title,
            $Description,
            $file_thumb, // Sử dụng đường dẫn ảnh đã upload
            $Status,
            $Position
        )) {
            $_SESSION['success'] = "Thêm banner thành công!";
            header("location:" . BASE_URL_ADMIN . '?act=giao-dien');
            exit();
        } else {
            echo 'loi';

            $_SESSION['error'] = "Có lỗi xảy ra khi thêm banner!";
            exit();
        }
    }
}

    public function UpdataBannerStatus() {
       
        if (isset($_GET['ID']) && isset($_GET['Status'])) {
            $ID = $_GET['ID']; // Lấy ID từ URL (GET request)
            $Status = $_GET['Status']; // Lấy Status từ URL (GET request)
            
            // Gọi hàm toggleBannerStatus để cập nhật
            $result = $this->modelgiaodien->toggleBannerStatus($ID, $Status);
            
            if ($result) {
                if ($Status == 1) {
                   header("location:" . BASE_URL_ADMIN . '?act=giao-dien');
                    exit;
                } else {
                   header("location:" . BASE_URL_ADMIN . '?act=giao-dien');
                   exit;

                }
            } else {
                // echo "Có lỗi xảy ra khi cập nhật trạng thái banner.";
            }
        } else {
            // echo "Thiếu thông tin ID hoặc Status!";
        }
    }
    



    
    public function deleteBanner()
{
    // Kiểm tra xem có ID của banner trong URL không
    if (isset($_GET['ID'])) {
        $ID = $_GET['ID'];  // Lấy ID banner từ URL

        // Lấy thông tin banner từ model
        $banner = $this->modelgiaodien->getAllBanners($ID);

        // Kiểm tra nếu banner tồn tại
        if ($banner) {
            $delete = $this->modelgiaodien->deleteBanner($ID);
            header("Location: " . BASE_URL_ADMIN . '?act=giao-dien');
            exit();
        } else {
            echo "Banner không tồn tại!";
        }
    } else {
        header("Location: " . BASE_URL_ADMIN . '?act=giao-dien');
        exit();
    }
}

public function formEditBanner()
{
    // Lấy ID banner từ URL hoặc request
    $ID = $_GET['ID'] ;

    // Kiểm tra xem ID có hợp lệ không (không phải 0)
    if ($ID == 0) {
        $_SESSION['error'] = "ID không hợp lệ!";
        header("Location: " . BASE_URL_ADMIN . "?act=giao-dien");
        exit();
    }

    // Lấy dữ liệu banner từ database
    $banner = $this->modelgiaodien->getDetailBanner($ID);

    // Kiểm tra xem banner có tồn tại không
    if (!$banner) {
        $_SESSION['error'] = "Banner không tồn tại!";
        header("Location: " . BASE_URL_ADMIN . "?act=giao-dien");
        exit();
    }

    // Hiển thị form chỉnh sửa banner
    require_once './views/qlgiaodien/editbanner.php';
}

public function postEditBanner()
{
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy ID banner cần sửa
        $ID = $_POST['ID'] ?? 0;

        // Lấy dữ liệu từ form
        $Title = $_POST['Title'] ?? '';
        $Description = $_POST['Description'] ?? '';
        $Status = $_POST['Status'] ?? '';
        $Position = $_POST['Position'] ?? 0;
        $Img = $_FILES['Img'] ?? null;

        // Tạo mảng chứa lỗi
        $errors = [];

        // Kiểm tra các trường bắt buộc
        if (empty($Title)) {
            $errors['Title'] = 'Không được để trống';
        }
        if (empty($Description)) {
            $errors['Description'] = 'Không được để trống';
        }
        if (empty($Status)) {
            $errors['Status'] = 'Không được để trống';
        }

        // Xử lý upload ảnh nếu có
        $file_thumb = '';
        if (isset($Img) && $Img['error'] === 0) {
            $uploadDir = '../uploads/banner/';
            $fileName = time() . '_' . basename($Img['name']);
            $uploadFile = $uploadDir . $fileName;

            // Kiểm tra nếu thư mục không tồn tại, tạo mới
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($Img['tmp_name'], $uploadFile)) {
                $file_thumb = $uploadFile; // Lưu đường dẫn ảnh đã upload
            } else {
                $errors['Img'] = "Không thể tải lên ảnh. Vui lòng thử lại!";
            }
        }

        // Lưu lỗi vào session nếu có lỗi
        if (!empty($errors)) {
            $_SESSION['error'] = $errors;
            header("location:" . BASE_URL_ADMIN . '?act=form-edit-banner&ID=' . $ID);
            exit();
        }

        // Lấy banner hiện tại
        $banner = $this->modelgiaodien->getDetailBanner($ID);
        var_dump($banner);
        if (!$banner) {
            $_SESSION['error'] = "Banner không tồn tại!";
            header("location:" . BASE_URL_ADMIN . '?act=giao-dien');
            exit();
        }

        // Nếu không upload ảnh mới, giữ nguyên ảnh cũ
        if (empty($file_thumb)) {
            $file_thumb = $banner['Img'];
        }

        // Cập nhật banner nếu không có lỗi
        if ($this->modelgiaodien->updateBanners(
            $ID,
            $Title,
            $Description,
            $file_thumb, // Đường dẫn ảnh (giữ nguyên nếu không sửa)
            $Status,
            $Position
        )) {
            $_SESSION['success'] = "Cập nhật banner thành công!";
            header("location:" . BASE_URL_ADMIN . '?act=giao-dien');
            exit();
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật banner!";
            header("location:" . BASE_URL_ADMIN . '?act=form-edit-banner&ID=' . $ID);
            exit();
        }
    }
}


    
}
   