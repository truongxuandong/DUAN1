<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetLand</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .hidden {
      display: none;
    }
    .fw-bold {
      font-weight: 700; /* Đảm bảo các phần có lớp fw-bold sẽ đậm hơn */
    }
    .border-custom {
  border: 2px solid #ddd; /* Màu đen đậm */
}
  </style>
</head>
<body>
  

   <!-- Main Container -->
   <div class="container my-4">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="list-group">
          <div class="profile-section p-3 border-bottom">
            <!-- Avatar và tên người dùng -->
            <div style="text-align: center;">
              <img src="../uploads/user/default.jpg" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px;">
            </div>
            <h5 class="fw-bold" style="text-align: center; margin-top: 10px;">mynghexua</h5>
            <p style="text-align: center;"><a href="#" class="text-decoration-none fw-bold">Sửa Hồ Sơ</a></p>
          </div>
          <a href="#change-password" class="list-group-item list-group-item-action " onclick="showSection('change-password')">Đổi mật khẩu</a>
          <a href="#orders" class="list-group-item list-group-item-action" onclick="showSection('orders')">Đơn hàng của tôi</a>
          <a href="#help" class="list-group-item list-group-item-action" onclick="showSection('help')">Trung tâm trợ giúp</a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Change Password Section -->
        <section id="change-password" class="p-4 border-custom rounded mb-4">
          <h2 class="h5 fw-bold">Đổi mật khẩu</h2>
          <form>
            <div class="mb-3">
              <label for="current-password" class="form-label fw-bold">Mật khẩu hiện tại</label>
              <input type="password" class="form-control" id="current-password" placeholder="Nhập mật khẩu hiện tại">
            </div>
            <div class="mb-3">
              <label for="new-password" class="form-label fw-bold">Mật khẩu mới</label>
              <input type="password" class="form-control" id="new-password" placeholder="Nhập mật khẩu mới">
            </div>
            <div class="mb-3">
              <label for="confirm-password" class="form-label fw-bold">Xác nhận mật khẩu mới</label>
              <input type="password" class="form-control" id="confirm-password" placeholder="Nhập lại mật khẩu mới">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
          </form>
        </section>

        <!-- Orders Section -->
        <section id="orders" class="p-4 border-custom rounded hidden">
          <h2 class="h5 fw-bold">Đơn hàng của tôi</h2>
          <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
              <a class="nav-link active" data-bs-toggle="tab" href="#all-orders">Tất cả</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#pending-orders">Chờ xác nhận</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#shipping-orders">Đang giao</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#completed-orders">Hoàn thành</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#canceled-orders">Đã hủy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#refund-orders">Trả hàng/hoàn tiền</a>
            </li>
          </ul>
          <div class="tab-content">
            <!-- All Orders -->
            <div class="tab-pane fade show active" id="all-orders">
              <div class="border-custom p-3 mb-2">
                <h6 class="fw-bold">Sản phẩm: Gói hạt giống mèo 2kg</h6>
                <p>Trạng thái: <span class="text-warning">Chờ xác nhận</span></p>
                <button class="btn btn-outline-primary btn-sm">Xem chi tiết</button>
              </div>
            </div>
            <!-- Pending Orders -->
            <div class="tab-pane fade" id="pending-orders">
              <p>Chưa có đơn hàng chờ xác nhận.</p>
            </div>
            <!-- Shipping Orders -->
            <div class="tab-pane fade" id="shipping-orders">
              <p>Chưa có đơn hàng đang giao.</p>
            </div>
            <div class="tab-pane fade" id="completed-orders">
              <p>Chưa có đơn hàng hoàn thành.</p>
            </div>
            <div class="tab-pane fade" id="canceled-orders">
              <p>Chưa có đơn hàng đã hủy.</p>
            </div>
            <div class="tab-pane fade" id="refund-orders">
              <p>Chưa có đơn hàng trả hàng/hoàn tiền.</p>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.col-md-9 > section');
      sections.forEach(section => section.classList.add('hidden')); // Ẩn tất cả các phần
      document.getElementById(sectionId).classList.remove('hidden'); // Hiển thị phần được chọn
    }
  </script>
</body>
</html>
