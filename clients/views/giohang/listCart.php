<div class="container-fluid">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="row mb-4">
      <div class="col-md-6">
        <h1>Giỏ Hàng</h1>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <!-- Success and error messages -->
        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <div class="card">
          <div class="card-header">
            <!-- Add to Cart button (if needed) -->
            <a href="<?= BASE_URL . '?act=add-to-cart' ?>">
              <button class="btn btn-success">Thêm sản phẩm vào giỏ</button>
            </a>
          </div>

          <!-- Table content -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Sản Phẩm</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col">Đơn Giá</th>
                    <th scope="col">Tổng</th>
                    <th scope="col">Thao Tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($cartItems)): ?>
                    <tr>
                      <td colspan="6" class="text-center">Giỏ hàng của bạn hiện tại trống</td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($cartItems as $key => $cartItem) : ?>
                      <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= htmlspecialchars($cartItem['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                          <form action="<?= BASE_URL . '?act=update-cart' ?>" method="POST">
                            <input type="hidden" name="cart_item_id" value="<?= $cartItem['id'] ?>">
                            <input type="number" name="quantity" value="<?= $cartItem['quantity'] ?>" min="1" class="form-control" style="width: 60px;">
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Cập nhật</button>
                          </form>
                        </td>
                        <td><?= number_format($cartItem['unit_price'], 0, ',', '.') ?> VND</td>
                        <td><?= number_format($cartItem['quantity'] * $cartItem['unit_price'], 0, ',', '.') ?> VND</td>
                        <td>
                          <a href="<?= BASE_URL . '?act=remove-from-cart&cart_item_id=' . $cartItem['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                            <button class="btn btn-danger btn-sm">Xóa</button>
                          </a>
                        </td>
                      </tr>
                    <?php endforeach ?>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <!-- Display total price -->
            <div class="text-right">
              <h3>Tổng: <?= number_format($totalPrice, 0, ',', '.') ?> VND</h3>
            </div>
            <div class="text-right mt-2">
              <a href="<?= BASE_URL . '?act=checkout' ?>">
                <button class="btn btn-success">Thanh toán</button>
              </a>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
