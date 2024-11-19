<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2>Quản lý Sản Phẩm và biến thể</h2>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
          <i class="fas fa-<?= $_SESSION['message']['type'] === 'success' ? 'check-circle' : 'exclamation-circle' ?>"></i> 
          <?= $_SESSION['message']['text'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="?act=form-them-san-pham">
              <button class="btn btn-success">Thêm sách mới</button>
            </a>
            
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên sản phẩm</th>
                  <th>Tên tác giả</th>
                  <th>Thể loại</th>
                  <th>Mô tả</th>
                  <th>Ngày phát hành</th>
                  <th>Giá bán</th>
                  <th>Giá niêm yết</th>
                  <th>Số lượng</th>
                  <th>Hình ảnh</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listsp as $sanPham) { ?>
                  <tr>
                    <td><?= $sanPham['id'] ?></td>
                    <td><?= $sanPham['title'] ?></td>
                    <td><?= $sanPham['author_name'] ?? 'Không có tác giả' ?></td>
                    <td><?= $sanPham['category_name'] ?? 'Không có thể loại' ?></td>
                    <td><?= $sanPham['description'] ?></td>
                    <td><?= $sanPham['publication_date'] ?></td>
                    <td><?= number_format($sanPham['price'], 0, ',', '.') ?> VNĐ</td>
                    <td><?= number_format($sanPham['original_price'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                      <?= $sanPham['stock_quantity'] > 0 ? $sanPham['stock_quantity'] : 'Hết hàng' ?>
                    </td>
                    <td>
                      <?php if (!empty($sanPham['image']) && file_exists($sanPham['image'])): ?>
                        <img src="<?= $sanPham['image'] ?>" style="width: 100px; height: auto;" alt="Hình ảnh sản phẩm">
                      <?php else: ?>
                        <img src="path/to/default-image.jpg" style="width: 100px; height: auto;" alt="Hình ảnh sản phẩm">
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="?act=form-sua-san-pham&id=<?= $sanPham['id'] ?>">
                        <button class="btn btn-warning">Sửa</button>
                      </a>
                      <a href="?act=xoa-san-pham&id=<?= $sanPham['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                        <button class="btn btn-danger">Xóa</button>
                      </a>
                      <a href="?act=chi-tiet-bien-the-sp&id=<?= $sanPham['id'] ?>">
                        <button class="btn btn-info">Chi tiết</button>
                      </a>
                      <!-- Manage Variants Button -->
                     
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

          </div>
          <div class="card-footer">
           
          </div>
      </div>
    </div>
  </div>
</section>

