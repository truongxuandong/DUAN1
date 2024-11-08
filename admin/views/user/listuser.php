<div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6" style="padding:10px 5px;">
                  <h2>Quản lí tài khoản</h2>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
        
          <!-- Main content -->
          <section class="content">
            
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

    <?php if(isset($_SESSION['success'])): ?>
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
                      <a href="<?= BASE_URL_ADMIN . '?act=add-user' ?>" class="btn btn-success">Thêm tài khoản</a>
                    </div>
                    
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>họ tên</th>
                            <th>email</th>
                            <th>số điện thoại</th>
                            <th>ảnh đại diện</th>
                            <th>role</th>
                            <th>ngày tạo </th>
                            <th>ngày sửa</th>
                            <th>thao tác</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($users as $user){ ?>
                            <tr>
                              
                              <td><?= $user['id'] ?></td>
                              <td><?= $user['name'] ?></td>
                              <td><?= $user['email'] ?></td>
                              <td><?= $user['phone'] ?></td>
                              <td>
                                <img src="<?= $user['avatar'] ?>" style="width:100px" alt="" >
                              </td>
                              <td><?= $user['role'] ?></td>
                              <td><?= date('d/m/Y H:i', strtotime($user['created_at']))?></td>
                              <td><?= date('d/m/Y H:i', strtotime($user['updated_at'] ))?></td>

                              <td>
                                <a href="<?= BASE_URL_ADMIN . '?act=edit-user&id=' . $user['id'] ?>">

                                  <button class="btn btn-warning">sửa</button>
                                </a>
                                 
                                <a href="<?= BASE_URL_ADMIN . '?act=delete-user&id=' . $user['id'] ?>">

                                  <button class="btn btn-danger" onclick="return confirm('bạn có muốn xóa không ?')"> xóa</button>
                                </a>
                              
                              </td>
                            </tr>

                        <?php } ?>
                          
                         
        
                        </tbody>
                        
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
</div>

<!-- Thêm script để thông báo tự động tắt sau 3 giây -->
<script>
    // Đặt thời gian 3 giây để thông báo tự động tắt
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
        });
    }, 3000); // 3000 ms = 3 giây
</script>


        