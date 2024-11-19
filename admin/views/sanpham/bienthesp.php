<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Biến Thể Cho Sản Phẩm</h3>
          </div>
          
          <div class="card-header">
            <a href="?act=form-them-bien-the&comic_id=<?= $_GET['id'] ?>">
              
              <button class="btn btn-success">Thêm biến thể mới</button>
            </a>
          </div>

          <div class="card-body"></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Định dạng</th>
                  <th>Ngôn ngữ</th>
                  <th>Sale</th>
                  <th>Giá bán</th>
                  <th>Giá niêm yết</th>
                  <th>Số lượng</th>
                  <th>Ngày phát hành</th>
                  <th>ISBN</th>
                  <th>Hình ảnh</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listVariants as $variant): ?>
                  <tr>
                    <td><?= ($variant['id']) ?></td>
                    <td><?= ($variant['format']) ?></td>
                    <td><?= ($variant['language']) ?></td>
                    <td><?= (is_numeric($variant['sale']) && (!isset($variant['sale_start']) || strtotime($variant['sale_start']) <= time())) ? 
                        ($variant['sale'] <= 100 ? 
                            number_format($variant['sale'], 0) . '%' : 
                            number_format($variant['sale'], 0, ',', '.') . ' đ') 
                        : '0' ?></td>
                    <td>
                        <?= number_format($variant['price'] ?? 0, 0, ',', '.') ?> VNĐ
                    </td>
                    <td>
                        <?= number_format($variant['original_price'] ?? 0, 0, ',', '.') ?> VNĐ
                    </td>
                    <td><?= $variant['stock_quantity'] > 0 ? $variant['stock_quantity'] : 'Hết hàng' ?></td>
                    <td><?= ($variant['publication_date']) ?></td>
                    <td><?= ($variant['isbn']) ?></td>
                    <td>
                      <?php if (!empty($variant['image']) && file_exists($variant['image'])): ?>
                        <img src="<?= ($variant['image']) ?>" style="width: 80px; height: auto;" alt="Biến thể">
                      <?php else: ?>
                        <img src="path/to/default-image.jpg" style="width: 80px; height: auto;" alt="Biến thể">
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="?act=form-sua-bien-the&id=<?= $variant['id'] ?>&comic_id=<?= $_GET['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                      <a href="?act=xoa-bien-the&id=<?= $variant['id'] ?>&comic_id=<?= $_GET['id'] ?>" onclick="return confirm('Xóa biến thể này?')" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
