<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Thêm Biến Thể Sản Phẩm</h1>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Thêm Biến Thể Cho Sản Phẩm</h3>
          </div>

          <!-- Hiển thị thông báo -->
          <?php if (isset($_SESSION['message'])): ?>
              <div class="alert alert-<?= $_SESSION['message']['type'] ?> alert-dismissible fade show" role="alert">
                  <?= $_SESSION['message']['text'] ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['message']); ?>
          <?php endif; ?>


          <!-- Form for Adding a New Product Variant -->
          <form action="?act=them-bien-the" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="comic_id" value="<?= $_GET['comic_id'] ?>">
            <div class="row card-body">

              <!-- Format -->
              <div class="form-group col-6">
                <label for="format">Định dạng <span class="text-danger">*</span></label>
                <select class="form-control" name="format" id="format" required>
                  <option value="Bìa cứng">Bìa Cứng</option>
                  <option value="Bìa mềm">Bìa Mềm</option>
                </select>
              </div>

              <!-- Language -->
              <div class="form-group col-6">
                <label for="language">Ngôn ngữ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="language" placeholder="Ví dụ: Tiếng Việt, Tiếng Anh" required>
              </div>

              <!-- Original Price -->
              <div class="form-group col-6">
                <label for="original_price">Giá gốc (VNĐ) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="original_price" placeholder="Nhập giá gốc" required>
              </div>

              <!-- Price -->
              <div class="form-group col-6">
                <label for="price">Giá bán (VNĐ) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="price" placeholder="Nhập giá bán" required>
              </div>

              <!-- Stock Quantity -->
              <div class="form-group col-6">
                <label for="stock_quantity">Số lượng <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="stock_quantity" placeholder="Nhập số lượng" required>
              </div>

              <!-- Publication Date -->
              <div class="form-group col-6">
                <label for="publication_date">Ngày xuất bản <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="publication_date" required>
              </div>

              <!-- ISBN -->
              <div class="form-group col-6">
                <label for="isbn">ISBN <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="isbn" placeholder="Nhập mã ISBN" required>
              </div>

              <!-- Image -->
              <div class="form-group col-6">
                <label for="image">Hình ảnh sản phẩm</label>
                <input type="file" class="form-control" name="image">
              </div>

              <!-- Add Variant Button -->
              <div class="form-group col-12">
                <button type="submit" class="btn btn-success" name="add_variant">Thêm biến thể</button>
                <a href="?act=san-pham" class="btn btn-secondary">Quay lại</a>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
