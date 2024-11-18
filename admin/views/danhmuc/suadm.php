
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Quản lý Danh Mục Sản Phẩm</h1>
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
            <h3 class="card-title">Sửa Danh Mục</h3>
          </div> 


          <form   action="?act=sua-danh-muc"  method="POST">
            <div class="card-body">
            <input type="hidden" class="form-control" name="id" value="<?= $danhMuc['id'] ?>">
              
              <div class="form-group">
                <label>Tên Danh Mục</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục" value="<?= $danhMuc['name'] ?>">
                
              </div>

              <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" placeholder="Nhập mô tả"><?= htmlspecialchars($danhMuc['description']) ?></textarea>

              </div>



            </div>


            <button type="submit" class="btn btn-primary" style="margin: 0 40px 40px ;">Sửa</button>

          </form>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
</div>