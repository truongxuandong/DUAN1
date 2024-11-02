
        
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Quản lý Sản Phẩm</h1>
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
      <h3 class="card-title">Thêm sản phẩm</h3>
      </div>
      
      
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="row card-body ">
      <div class="form-group col-12">
      <label>Tên sản phẩm</label>
      <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên san pham" >
     
      </div>
      
      <div class="form-group col-6">
      <label>Giá sản phẩm</label>
      <input type="number" class="form-control" name="gia_san_pham" placeholder="Nhập gia san pham" >
      
      </div>
      
      <div class="form-group col-6">
      <label>Giá KM</label>
      <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập gia khuyen mai" >
      
      </div>
      
      
      
      <div class="form-group col-6">
      <label>Hình ảnh</label>
      <input type="file" class="form-control" name="hinh_anh" >
      
      </div>
      
      <div class="form-group col-6">
      <label>Album ảnh</label>
      <input type="file" class="form-control" name="img_array[]"  multiple>
      
      </div>
      
      <div class="form-group col-6">
      <label>Số lượng</label>
      <input type="number" class="form-control" name="so_luong" placeholder="Nhập so luong" >
      
      </div>
      
      <div class="form-group col-6">
      <label>Ngày nhập</label>
      <input type="date" class="form-control" name="ngay_nhap" placeholder="Nhập ngay nhap" >
      
      </div>
      
      <div class="form-group col-6">
      <label>Danh muc</label>
      <select class="form-control"name="danh_muc_id" id="exampleFormControlSelect1">
            <option selected disabled>Chon Danh muc san pham</option>
            
            <option value="">2</option>
             
            
        </select>
      
      </div>
      
      
      <div class="form-group col-12">
      <label>Trạng thái</label>
      <select class="form-control"name="trang_thai" id="exampleFormControlSelect1">
            <option selected disabled>Chon Danh muc san pham</option>
            <option value="1">con ban</option>
            <option value="2">dung ban</option>
            
          </select>
      
      </div>
      
      <div class="form-group col-12">
      <label>Mô tả</label>
      <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả"></textarea>
      </div>
      
      
      
      
      
      </div>
      
     
      <button type="submit" class="btn btn-primary" style="margin: 0 40px 40px;" >them</button>
      
      </form>
      </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
          </section>
        