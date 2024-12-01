<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetLand</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="clients/assets/css/thongtin.css">
  <style>
    .hidden {
      display: none;
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
          <div class="profile-section p-3 border-bottom text-center">
            <!-- Avatar và tên người dùng -->
            <img src="./uploads/user/default.jpg" alt="Avatar" class="rounded-circle" style="width: 60px; height: 60px;">
            <h5 class="fw-bold mt-2">
              <?php
              if (isset($_SESSION['user']['name'])) {
                echo htmlspecialchars($_SESSION['user']['name']);
              } else {
                echo 'Người dùng';
              }
              ?>
            </h5>
            <p><a href="?act=edit-profile" class="text-decoration-none fw-bold">Sửa Hồ Sơ</a></p>
          </div>
          <a href="#orders" class="list-group-item list-group-item-action" onclick="showSection('orders')">Đơn hàng của tôi</a>
          <a href="?act=change-password" class="list-group-item list-group-item-action" onclick="showSection('change-password')">Đổi mật khẩu</a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-9">
        <!-- Orders Section -->
        <section id="orders" class="p-4 border-custom rounded">
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

        <!-- Change Password Section -->
       
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.col-md-9 > section');
      sections.forEach(section => {
        if (section.id === sectionId) {
          section.classList.remove('hidden'); // Hiển thị phần được chọn
        } else {
          section.classList.add('hidden'); // Ẩn các phần khác
        }
      });
    }

    // Mặc định hiển thị "Đơn hàng của tôi"
    showSection('orders');
  </script>
</body>

</html>
