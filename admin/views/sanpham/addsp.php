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
            <h3 class="card-title">Thêm sản phẩm</h3>
          </div>


          <form action="<?= BASE_URL_ADMIN . 'act=them-san-pham' ?>" method="POST" enctype="multipart/form-data">
            <div class="row card-body ">
              <div class="form-group col-12">
                <label>Tên sản phẩm</label>
                <input type="text" class="form-control" name="title" placeholder="Nhập tên sản phẩm">
                <?php if (isset($errors['title'])) { ?>
                  <p class="text-danger"><?= $errors['title'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Tên tác giả</label>
                <input type="text" class="form-control" name="author_id" placeholder="Nhập tên tác giả">
                <?php if (isset($errors['author_id'])) { ?>
                  <p class="text-danger"><?= $errors['author_id'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Mã thể loại</label>
                <input type="text" class="form-control" name="category_id" placeholder="Nhập tên sản phẩm">
                <?php if (isset($errors['category_id'])) { ?>
                  <p class="text-danger"><?= $errors['category_id'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Ngày phát hành</label>
                <input type="date" class="form-control" name="publication_date" placeholder="Nhập ngày phát hành">
                <?php if (isset($errors['publication_date'])) { ?>
                  <p class="text-danger"><?= $errors['publication_date'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Giá</label>
                <input type="number" class="form-control" name="price" placeholder="Nhập giá sản phẩm">
                <?php if (isset($errors['price'])) { ?>
                  <p class="text-danger"><?= $errors['price'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Số lượng</label>
                <input type="number" class="form-control" name="stock_quantity" placeholder="Nhập số lượng sản phẩm">
                <?php if (isset($errors['stock_quantity'])) { ?>
                  <p class="text-danger"><?= $errors['stock_quantity'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Hình ảnh</label>
                <input type="file" class="form-control" name="image">
                <?php if (isset($errors['image'])) { ?>
                  <p class="text-danger"><?= $errors['image'] ?></p>
                <?php } ?>
              </div>

              <div class="form-group col-6">
                <label>Album ảnh</label>
                <input type="file" class="form-control" name="img_array[]" multiple>

              </div>

              <div class="form-group col-12">
                <label>Mô tả</label>
                <textarea name="description" id="" class="form-control" placeholder="Nhập mô tả"></textarea>
              </div>

              <button type="submit" class="btn btn-primary" style="margin: 0 40px 40px;">Thêm</button>

          </form>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>