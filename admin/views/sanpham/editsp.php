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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Sửa sản phẩm</h3>
          </div>

          <!-- Form sửa sản phẩm -->
          <form action="?act=sua-san-pham" method="POST" enctype="multipart/form-data">
            <div class="row card-body">

              <!-- Hidden ID -->
              <input type="hidden" name="id" value="<?= $comic['id'] ?>">

              <!-- Tên sản phẩm -->
              <div class="form-group col-6">
                <label for="title">Tên sản phẩm</label>
                <input type="text" class="form-control" name="title" value="<?= $comic['title'] ?>" placeholder="Nhập tên sản phẩm">
                <?php if (isset($errors['title'])): ?>
                    <p class="text-danger"><?= $errors['title']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Tên tác giả -->
              <div class="form-group col-6">
                <label for="author_id">Tên tác giả</label>
                <select class="form-control" name="author_id" id="author_id">
                  <option selected disabled>Chọn tác giả</option>
                  <?php foreach ($listTacGia as $tacGia): ?>
                    <option value="<?= $tacGia['id'] ?>" <?= ($comic['author_id'] == $tacGia['id']) ? 'selected' : '' ?>>
                      <?= $tacGia['name'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (isset($errors['author_id'])): ?>
                    <p class="text-danger"><?= $errors['author_id']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Thể loại -->
              <div class="form-group col-6">
                <label for="category_id">Thể loại</label>
                <select class="form-control" name="category_id" id="category_id">
                  <option selected disabled>Chọn thể loại</option>
                  <?php foreach ($listDanhMuc as $danhMuc): ?>
                    <option value="<?= $danhMuc['id'] ?>" <?= ($comic['category_id'] == $danhMuc['id']) ? 'selected' : '' ?>>
                      <?= $danhMuc['name'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (isset($errors['category_id'])): ?>
                    <p class="text-danger"><?= $errors['category_id']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Ngày phát hành -->
              <div class="form-group col-6">
                <label for="publication_date">Ngày phát hành</label>
                <input type="date" class="form-control" name="publication_date" value="<?= $comic['publication_date'] ?>" placeholder="Nhập ngày phát hành">
                <?php if (isset($errors['publication_date'])): ?>
                    <p class="text-danger"><?= $errors['publication_date']; ?></p>
                <?php endif; ?>
              </div>
              <!-- Giá bán -->
              <div class="form-group col-6">
                <label for="price">Giá bán</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $comic['price'] ?>" placeholder="Nhập giá sản phẩm">
                <?php if (isset($errors['price'])): ?>
                    <p class="text-danger"><?= $errors['price']; ?></p>
                <?php endif; ?>
              </div>
              <!-- Giá niêm yết -->
              <div class="form-group col-6">
                <label for="original_price">Giá niêm yết</label>
                <input type="number" class="form-control" id="original_price" name="original_price" value="<?= $comic['original_price']?>" placeholder="Nhập giá sản phẩm">
                <?php if (isset($errors['original_price'])): ?>
                    <p class="text-danger"><?= $errors['original_price']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Số lượng -->
              <div class="form-group col-6">
                <label for="stock_quantity">Số lượng</label>
                <input type="number" class="form-control" name="stock_quantity" value="<?= $comic['stock_quantity'] ?>" placeholder="Nhập số lượng sản phẩm">
                <?php if (isset($errors['stock_quantity'])): ?>
                    <p class="text-danger"><?= $errors['stock_quantity']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Hình ảnh -->
              <div class="form-group col-6">
                <label for="image">Hình ảnh</label>
                <input type="file" class="form-control" name="image">
                <!-- Display current image -->
                <?php if ($comic['image']): ?>
                    <div>
                        <p>Hình ảnh hiện tại:</p>
                        <img src="<?= $comic['image'] ?>" alt="Current Image" style="max-width: 100px; height: auto;">
                    </div>
                <?php endif; ?>
                <input type="hidden" name="old_image" value="<?= $comic['image'] ?>"> 
                <?php if (isset($errors['image'])): ?>
                    <p class="text-danger"><?= $errors['image']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Mô tả -->
              <div class="form-group col-12">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control" placeholder="Nhập mô tả"><?= $comic['description'] ?></textarea>
                <?php if (isset($errors['description'])): ?>
                    <p class="text-danger"><?= $errors['description']; ?></p>
                <?php endif; ?>
              </div>

              <!-- Nút sửa -->
              <button type="submit" class="btn btn-primary" style="margin: 0 5px 40px;">Sửa</button>
              <button href="?act=san-pham" class="btn btn-primary" style="margin: 0 5px 40px;">Quay lại</button>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
