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
                <h3 class="card-title">Thêm người dùng mới</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN . '?act=post-add-user' ?>" method="post" enctype="multipart/form-data">
                
                <div class="card-body">
                <div class="form-group col-12">
                    <label for="">name</label>
                    <input type="text" class="form-control" name="name"  placeholder="nhập họ tên">

                 </div>
                  

                  <div class="form-group col-12">
                    <label for="">email</label>
                    <input type="email" class="form-control" name="email"  placeholder="nhập email">
                
                  </div>
                  <div class="form-group col-12">
                    <label for="">password</label>
                    <input type="password" class="form-control" name="password"  placeholder="nhập password">
                    
                  
                  </div>




                  <div class="form-group col-12">
                    <label for="">phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="nhập so_dien_thoai">
                   
                  </div>

                  <div class="form-group col-12">
                    <label for="">avatar</label>
                    <input type="file" class="form-control" name="avatar" >
                    
                  </div>

                  <!-- <div class="form-group col-12">
                    <label for="">role</label>
                    <select id="trang_thai_id" name="gioi_tinh" class="form-control custom-select">
                    <option  value="user">user</option>
                    <option  value="admin">admin</option>
                  </select> -->
                  <!-- </div> -->

                  

                  
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Thêm mới</button>
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