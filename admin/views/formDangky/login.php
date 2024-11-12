<div class="container-fluid">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row mb-4">
      <div class="col-md-6">
        <h1>Vui lòng đăng nhập</h1>
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


        <!-- Table content -->
        <div class="card-body">

          <?php if (isset($_SESSION['error'])) { ?>
            <?php if (is_array($_SESSION['error'])) { ?>
              <?php foreach ($_SESSION['error'] as $error) { ?>
                <p class="text-danger login-box-msg"><?= $error ?></p>
              <?php } ?>
            <?php } else { ?>
              <p class="text-danger login-box-msg"><?= $_SESSION['error'] ?></p>
            <?php } ?>
          <?php } else { ?>
            <!-- <p class="login-box-msg">Vui lòng đăng nhập</p> -->
          <?php } ?>



          <form action="<?= BASE_URL_ADMIN . '?act=check-login-admin' ?>" method="POST">
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" name="email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">

              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mt-2 mb-3">

          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="forgot-password.html">Quên mật khẩu</a>
            <a href="<?= BASE_URL_ADMIN . '?act=register' ?>">Đăng ký tài khoản</a>

          </p>

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