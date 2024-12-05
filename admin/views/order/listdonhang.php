
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
            <th>id </th>
            <th>tên khách hàng</th>
            <th>số điện thoại</th>
            <th>tổng giá trị đơn hàng</th>
            <th>phương thức thanh toán</th>
            <th>trạng thái thanh toán</th>
            <th>trạng thái đơn hàng</th>
            
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $donhang) { ?>
            <tr>
                <td><?= $donhang['id'] ?></td>
                <!-- Hiển thị tên khách hàng, nếu không có thì hiển thị user_id -->
                <td><?= $donhang['receiver_name']?></td>
                <td><?= $donhang['phone_car'] ?></td>
                <td><?= number_format($donhang['total_amount'] ?? 0, 0, ',', '.') ?> đ</td>
                <td><?php
                
                        switch($donhang['payment_method']) {
                          case 'COD': // COD
                              echo '<span class="badge bg-primary" style="font-size: 15px;">Thanh toán khi nhận hàng</span>';
                              break;
                          case 'MOMO': // MOMO
                              echo '<span class="badge bg-danger" style="font-size: 15px;">Ví điện tử</span>';
                              break;
                          case 'BANKING': // BANKING
                              echo '<span class="badge bg-info" style="font-size: 15px;">Chuyển khoản</span>';
                              break;
                          case 'CREDIT': // CREDIT
                              echo '<span class="badge bg-warning" style="font-size: 15px;">Thẻ tín dụng</span>';
                              break;
                          default:
                              echo '<span class="badge bg-secondary" style="font-size: 15px;">Unknown</span>'; // Nếu không có giá trị khớp
                              break;
                      }
                      
                        ?> </td> 
                <td><?php
                        switch($donhang['payment_status']) {
                          
                            case 'paid': // Đã thanh toán
                                echo '<span class="badge bg-success" style="font-size: 15px;">Đã thanh toán</span>';
                                break;  
                            case 'unpaid': // Chưa thanh toán
                                echo '<span class="badge bg-secondary" style="font-size: 15px;">Chưa thanh toán</span>';
                                break;
                            case 'refunded': // Đã hoàn tiền
                                echo '<span class="badge bg-info" style="font-size: 15px;">Đã hoàn tiền</span>';
                                break;
                            case 'failed': // Thanh toán thất bại
                                echo '<span class="badge bg-danger" style="font-size: 15px;">Thanh toán thất bại</span>';
                                break;
                            case 'processing': // Đang xử lý
                                echo '<span class="badge bg-primary" style="font-size: 15px;">Đang xử lý</span>';
                                break;
                            default: // Trường hợp không xác định
                                echo '<span class="badge bg-secondary" style="font-size: 15px;">Không xác định</span>';
                                break;
                        }
                        ?></td>
                <td><?php 
                switch($donhang['shipping_status']) {
                    case 'pending': // Đang chờ xử lý
                        echo '<span class="badge bg-warning" style="font-size: 15px;">Chờ xử lý</span>';
                        break;
                    case 'delivering': // Đang giao hàng
                        echo '<span class="badge bg-primary" style="font-size: 15px;">Đang giao hàng</span>';
                        break;
                    case 'delivered': // Đã giao hàng
                        echo '<span class="badge bg-success" style="font-size: 15px;">Đã giao hàng</span>';
                        break;
                    case 'returned': // Đã trả lại
                        echo '<span class="badge bg-info" style="font-size: 15px;">Đã trả lại</span>';
                        break;
                    case 'cancelled': // Đã hủy
                        echo '<span class="badge bg-danger" style="font-size: 15px;">Đã hủy</span>';
                        break;
                    default: // Trường hợp không xác định
                        echo '<span class="badge bg-secondary" style="font-size: 15px;">Không xác định</span>';
                        break;
                } ?>
                </td>
                
                <td>
                    <a href="?act=order-detail&id=<?= $donhang['id'] ?>" class="btn btn-info btn-sm">
                        <i class="fas fa fa-eye"></i> Chi tiết
                    </a>

                    
                      
                    
                        <!-- Các nút thao tác khi chưa giao hàng thành công -->
                        <a href="?act=edit-order&id=<?= $donhang['id'] ?>">
                            <button class="btn btn-warning btn-sm">
                                <i class="fas fa fa-edit"></i> Cập nhật
                            </button>
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
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->



          
          
       