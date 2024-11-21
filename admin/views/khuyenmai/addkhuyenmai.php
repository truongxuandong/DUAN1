<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h3>Quản lí khuyến mãi</h3>
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
              <h4 class="card-title">Thêm khuyến mãi mới</h4>
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
            <form action="?act=post-add-khuyen-mai" method="post" enctype="multipart/form-data">

              <div class="card-body">
                <!-- Tên khuyến mãi -->
                <div class="form-group col-12">
                  <label for="">Tên sản phẩm</label>
                  <select name="comic_id" class="form-control">
                    <option value="" disabled selected>Chọn sản phẩm</option>
                    <?php foreach ($comics as $comic): ?>
                      <option value="<?= $comic['id'] ?>"><?= $comic['title'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <!-- Loại khuyến mãi -->
                <div class="form-group col-12">
                  <label for="">Loại Khuyến Mãi</label>
                  <select class="form-control" name="sale_type" id="sale_type">
                    <option value="percent">phần trăm</option>
                    <option value="fixed">tiền mặt</option>
                  </select>
                </div>

                <!-- Giá trị khuyến mãi -->
                <div class="form-group col-12">
                  <label for="">Giá trị Khuyến Mãi</label>
                  <input type="number" class="form-control" name="sale_value" id="sale_value" placeholder="Nhập giá trị giảm giá">
                </div>

                <!-- Thời gian bắt đầu -->
                <div class="form-group col-12">
                  <label for="">Ngày Bắt Đầu</label>
                  <input type="date" class="form-control" name="start_date">
                </div>

                <!-- Thời gian kết thúc -->
                <div class="form-group col-12">
                  <label for="">Ngày Kết Thúc</label>
                  <input type="date" class="form-control" name="end_date">
                </div>
                <div class="form-group col-12">
                  <label for="">trạng thái</label>
                  <select class="form-control" name="status">
                    <option value="pending">pending</option>
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>

                  </select>
                </div>



              </div>

              
              <button type="submit" class="btn btn-danger">Thêm Khuyến Mãi</button>
              
              <a href="?act=khuyen-mai" class="btn btn-secondary">Quay lại</a>
            </form>
            
            <div class="card-footer">
              

               
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


