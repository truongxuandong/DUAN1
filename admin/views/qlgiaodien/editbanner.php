<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Quản lý giao diện Banner</h1>
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
            <h3 class="card-title">Sửa Banner</h3>
          </div>

          <!-- Form -->
          <form method="POST" action="?act=edit-banner" enctype="multipart/form-data">
              <!-- Ẩn ID banner -->
              <input type="hidden" name="ID" value="<?= $banner['ID'] ?>">

              <div class="form-group col-6">
                  <label for="Title">Tiêu đề Banner:</label>
                  <input type="text" 
                         class="form-control" 
                         id="Title" 
                         name="Title" 
                         placeholder="Nhập tiêu đề" 
                         value="<?= htmlspecialchars($banner['Title']) ?>" 
                         required>
                  <?php if (isset($_SESSION['error']['Title'])) { ?>
                      <p class="text-danger"><?= $_SESSION['error']['Title'] ?></p>
                  <?php } ?>
              </div>

              <div class="form-group col-6">
                  <label for="Description">Mô tả:</label>
                  <input type="text" 
                         class="form-control" 
                         id="Description" 
                         name="Description" 
                         placeholder="Nhập mô tả" 
                         value="<?= htmlspecialchars($banner['Description']) ?>" 
                         required>
                  <?php if (isset($_SESSION['error']['Description'])) { ?>
                      <p class="text-danger"><?= $_SESSION['error']['Description'] ?></p>
                  <?php } ?>
              </div>

              <div class="form-group col-6">
                  <label for="Img">Hình ảnh hiện tại:</label>
                  <div>
                      <img src="<?= BASE_URL . $banner['Img'] ?>" alt="Banner Image" style="max-width: 100%; height: auto;">
                  </div>
                  <label for="Img">Chọn hình ảnh mới (nếu cần):</label>
                  <input type="file" 
                         class="form-control" 
                         id="Img" 
                         name="Img" 
                         accept="image/*">
                  <?php if (isset($_SESSION['error']['Img'])) { ?>
                      <p class="text-danger"><?= $_SESSION['error']['Img'] ?></p>
                  <?php } ?>
              </div>

              <div class="form-group col-6">
                  <label for="Status">Trạng thái:</label>
                  <select class="form-control" id="Status" name="Status" required>
                      <option value="1" <?= isset($banner['Status']) && $banner['Status'] == 1 ? 'selected' : '' ?>>Kích hoạt</option>
                  </select>
                  <?php if (isset($_SESSION['error']['Status'])) { ?>
                      <p class="text-danger"><?= $_SESSION['error']['Status'] ?></p>
                  <?php } ?>
              </div>

              <div class="form-group col-6">
                  <label for="Position">Vị trí:</label>
                  <input type="number" 
                         class="form-control" 
                         id="Position" 
                         name="Position" 
                         value="<?= htmlspecialchars($banner['Position']) ?>" 
                         required>
                  <?php if (isset($_SESSION['error']['Position'])) { ?>
                      <p class="text-danger"><?= $_SESSION['error']['Position'] ?></p>
                  <?php } ?>
              </div>

              <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
          </form>

        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
