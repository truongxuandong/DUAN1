
<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h3>Quản lí đơn hàng</h3>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
          
            <!-- Main content -->
            <section class="content">
              
          
                    <div class="card">
                      <div class="card-header">
                      </div>
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
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>STT</th>
                              <th>mã đơn hàng</th>
                              <th>tên người nhận</th>
                              <th>số điện thoại</th>
                              <th>ngày đặt</th>
                              <th>tổng tiền</th>
                              <th>trạng thái</th>
                              <th>thao tác</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <tr>
                                <td>1</td>
                                <td>443333fff</td>
                                <td>thanh</td>
                                <td>3444452344</td>
                                <td>13/08/2004</td>
                                <td>200000</td>
                                <td>hoan thanh</td>
                                
                                <td>
                                  
                                  <button class="btn btn-primary"><i class="far fa fa-eye" style="margin-right: 5px;"></i>hien thi</button>
                                  
                                  
                                  <button class="btn btn-warning"><i class="fas fa fa-wrench" style="margin-right: 5px;"></i>sua</button>
                                  
          
                                                   
                                </td>
                              </tr>
                            
          
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
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          
          
       