<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col">
          <h2>Quản lí tài khoản khách hàng</h2>
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
                <h3 class="card-title">Cập Nhật tài khoản </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN . '?act=post-edit-user' ?>" method="post" enctype="multipart/form-data">
                
                <div class="card-body">
                <div class="form-group col-12">
                <input type="hidden" class="form-control" name="id" value="<?= $taikhoan['id'] ?>">

                    <label for="">name</label>
                    <input type="text" class="form-control" name="name"  placeholder="nhập họ tên" value="<?= $taikhoan['name'] ?>">
                   
                  </div>

                  <div class="form-group col-12">
                    <label for="">email</label>
                    <input type="email" class="form-control" name="email"  placeholder="nhập email" value="<?= $taikhoan['email'] ?>">
                    
                  
                  </div>
                  
                  <div class="form-group col-12">
                    <label for="">phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="nhập so_dien_thoai" value="<?= $taikhoan['phone'] ?>">
                   
                  </div>

                  <div class="form-group col-12">
                    <label for="">avatar</label>
                    <br>
                    <img src="<?= $taikhoan['avatar'] ?>" name="avatar-old">
                    <input type="file" class="form-control" name="avatar" >

                    
                  </div>

                  

                  

                  
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
                  <!-- <button type="submit" class="btn btn-secondary">Hủy</button> -->

                </div>
              </form>
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