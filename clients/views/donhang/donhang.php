<!-- Thêm link đến Bootstrap nếu chưa có -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h2 class="text-center mb-4">Danh sách Đơn Hàng</h2>
    <table class="table table-striped table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Ngày đặt</th>
                <th>Trạng thái thanh toán</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái giao hàng</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders_items as $key => $orders_item): ?>
                <?php if ($orders_item['user_id'] == $_SESSION['user_id']): // Kiểm tra điều kiện ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?=$orders_item['title'] ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($orders_item['order_date'])) ?></td>
                    <td>
                        <?php 
                            if ($orders_item['payment_status'] == 'paid') {
                                echo '<span class="badge bg-success">Đã thanh toán</span>';
                            } elseif ($orders_item['payment_status'] == 'unpaid') {
                                echo '<span class="badge bg-danger">Chưa thanh toán</span>';
                            } elseif ($orders_item['payment_status'] == 'refunded') {
                                echo '<span class="badge bg-secondary">Đã hoàn lại</span>';
                            } elseif ($orders_item['payment_status'] == 'failed') {
                                echo '<span class="badge bg-dark">Thất bại</span>';
                            } elseif ($orders_item['payment_status'] == 'processing') {
                                echo '<span class="badge bg-warning">Đang xử lý</span>';
                            }
                        ?>
                    </td>
                    <td><?= $orders_item['payment_method'] ?></td>
                    <td>
                        <?php 
                            if ($orders_item['shipping_status'] == 'delivered') {
                                echo '<span class="badge bg-success">Đã giao hàng</span>';
                            } elseif ($orders_item['shipping_status'] == 'pending') {
                                echo '<span class="badge bg-warning">Đang chờ</span>';
                            } elseif ($orders_item['shipping_status'] == 'delivering') {
                                echo '<span class="badge bg-info">Đang giao</span>';
                            }
                        ?>
                    </td>
                    <td style="text-align: center;">
    <!-- Kiểm tra trạng thái giao hàng trước khi hiển thị nút đánh giá -->
    <div class="d-flex align-items-center justify-content-center gap-2">
        <?php if ($orders_item['shipping_status'] == 'delivered'): ?>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModal" data-order-id="<?= $orders_item['id'] ?>">
                Đánh giá
            </button>
        <?php else: ?>
            <span class="badge bg-secondary">Chưa thể đánh giá</span>
        <?php endif; ?>

        <a href="?act=chi-tiet-don-hang&id=<?= $orders_item['id'] ?>" class="btn btn-light btn-sm" title="Mở rộng">
            <i class="fa fa-arrows-alt"></i>
        </a>
    </div>
</td>

                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Đánh giá -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reviewModalLabel">Đánh giá Đơn Hàng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="reviewForm">
          <input type="hidden" name="order_id" id="order_id">
          <div class="mb-3">
            <label for="reviewContent" class="form-label">Nội dung đánh giá</label>
            <textarea class="form-control" id="reviewContent" name="content" rows="4" placeholder="Nhập nội dung đánh giá..." required></textarea>
          </div>
          <div class="mb-3">
            <label for="reviewRating" class="form-label">Đánh giá</label>
            <select class="form-select" id="reviewRating" name="rating">
              <option value="1">1 Sao</option>
              <option value="2">2 Sao</option>
              <option value="3">3 Sao</option>
              <option value="4">4 Sao</option>
              <option value="5">5 Sao</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Thêm script Bootstrap và jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>