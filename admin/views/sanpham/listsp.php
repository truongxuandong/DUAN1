<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Quản lý Sản Phẩm</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham'?>">
              <button class="btn btn-success">Thêm sách mới</button>
            </a>
            <button class="btn btn-success">Thêm sản phẩm</button>
          </div><!-- /.card-header -->

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên sản phẩm</th>
                  <th>Tên tác giả</th>
                  <th>Mã thể loại</th>
                  <th>Mô tả</th>
                  <th>Ngày phát hành</th>
                  <th>Giá</th>
                  <th>Số lượng</th>
                  <th>Hình ảnh</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($listsp as $key => $sanPham) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $sanPham['title'] ?></td>
                    <td><?= $sanPham['author_id'] ?></td>
                    <td><?= $sanPham['category_id'] ?></td>
                    <td><?= $sanPham['description'] ?></td>
                    <td><?= $sanPham['publication_date'] ?></td>
                    <td><?= number_format($sanPham['price'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                      <?= $sanPham['stock_quantity'] > 0 ? 'Còn hàng' : 'Hết hàng'; ?>
                    </td>
                    <td>
                      <img src="<?= BASE_URL . $sanPham['image'] ?>" style="width: 100px; height: auto;" alt="Hình ảnh sản phẩm" onerror="this.onerror=null; this.src='path_to_default_image.jpg'">
                    </td>
                    <td>
                      <a href="<?= BASE_URL_ADMIN . 'act=form-sua-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                        <button class="btn btn-warning">Sửa</button>
                      </a>
                      <a href="<?= BASE_URL_ADMIN . 'act=xoa-san-pham&id_san_pham=' . $sanPham['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                        <button class="btn btn-danger">Xóa</button>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section><!-- /.content -->
