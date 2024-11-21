<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h3>Chỉnh sửa khuyến mãi</h3>
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
              <h4 class="card-title">Cập nhật thông tin khuyến mãi</h4>
            </div>
            <!-- /.card-header -->

             <!-- thong bao   -->
      <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
            <!-- form start -->
            <form action="?act=post-edit-khuyen-mai" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $khuyenmai['id'] ?>">
              <div class="card-body">
                <!-- Tên sản phẩm -->
                <div class="form-group col-12">
                  <label for="">Tên sản phẩm</label>
                  <select name="comic_id" class="form-control">
                    <option value="" disabled>Chọn sản phẩm</option>
                    <?php foreach ($comics as $comic): ?>
                      <option value="<?= $comic['id'] ?>" <?= $comic['id'] == $khuyenmai['comic_id'] ? 'selected' : '' ?>>
                        <?= $comic['title'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <!-- Loại khuyến mãi -->
                <div class="form-group col-12">
                  <label for="">Loại Khuyến Mãi</label>
                  <select class="form-control" name="sale_type">
                    <option value="percent" <?= $khuyenmai['sale_type'] == 'percent' ? 'selected' : '' ?>>Phần trăm</option>
                    <option value="fixed" <?= $khuyenmai['sale_type'] == 'fixed' ? 'selected' : '' ?>>Tiền mặt</option>
                  </select>
                </div>

                <!-- Giá trị khuyến mãi -->
                <div class="form-group col-12">
                  <label for="">Giá trị Khuyến Mãi</label>
                  <input type="number" class="form-control" name="sale_value" 
                         value="<?= intval($khuyenmai['sale_value']) ?>" 
                         placeholder="Nhập giá trị giảm giá">
                </div>

                <!-- Thời gian bắt đầu -->
                <div class="form-group col-12">
                  <label for="start_date">Ngày Bắt Đầu</label>
                  <input type="date" class="form-control" id="start_date" name="start_date" 
                         value="<?= date('Y-m-d', strtotime($khuyenmai['start_date'])) ?>">
                </div>

                <!-- Thời gian kết thúc -->
                <div class="form-group col-12">
                  <label for="end_date">Ngày Kết Thúc</label>
                  <input type="date" class="form-control" id="end_date" name="end_date" 
                         value="<?= date('Y-m-d', strtotime($khuyenmai['end_date'])) ?>">
                </div>

                <!-- Trạng thái -->
                <div class="form-group col-12">
                  <label for="">Trạng Thái</label>
                  <select class="form-control" name="status">
                    <option value="pending" <?= $khuyenmai['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="active" <?= ($khuyenmai['status']) === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($khuyenmai['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                  </select>
                </div>
              </div>

              <!-- Submit button -->
              <button type="submit" class="btn btn-primary">Cập nhật</button>
              <a href="?act=khuyen-mai" class="btn btn-secondary">Quay lại</a>
            </form>
            
            <div class="card-footer">
              <!-- Footer content -->
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

