<div class="container-fluid">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row mb-4">
      <div class="col-md-6">
        <h1>Danh Mục Sản Phẩm</h1>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa fa-check-circle"></i> <?= $_SESSION['success'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <div class="card">
          <div class="card-header">
            <a href="<?= BASE_URL_ADMIN . '?act=form-them-danh-muc' ?>">
              <button class="btn btn-success">Thêm Danh Mục</button>
          </div>

          <!-- Table content -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listDanhMuc as $key => $danhMuc) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $danhMuc['name'] ?></td>
                      <td><?= $danhMuc['description'] ?></td>
                      <td>
                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-danh-muc&id=' . $danhMuc['id'] ?>">
                          <button class="btn btn-warning">Sửa</button>
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id=' . $danhMuc['id'] ?>"
                          onclick="return confirm('Bạn có đồng ý xóa hay không?')">
                          <button class="btn btn-danger">Xóa</button>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>

              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>