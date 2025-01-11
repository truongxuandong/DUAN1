<div class="col-12">
          <hr>
          <h2>Bình luận của sản phẩm</h2>
          <div class="">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Người bình luận</th>
                  <th>Nội dung</th>
                  <th>Tên sản phẩm</th>
                  <th>Ngày bình luận</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($comments as $key => $binhLuan) : ?>
                  <tr>

                    <td><?= $key + 1 ?></td>
                    <td>
                    <a >
                        <?= $binhLuan['name'] ?>
                      </a>
                    </td>
                    <td><?= $binhLuan['Content'] ?></td>
                    <td><?= $binhLuan['title'] ?></td>
                    <td><?= $binhLuan['Create_at'] ?></td>
                    <td><?= $binhLuan['status'] == 1 ? 'Ẩn' : 'Hiển thị'?></td>

                    <td>
                      <div class="btn-group">

                      <form action="http://localhost/duan1/admin/?act=update-trang-thai-binh-luan" method="post">
                          <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['ID'] ?>">
                          <input type="hidden" name="name_view" value="detail_khach">
                          <button type="submit" class="btn btn-warning">
                              <?= $binhLuan['status'] == 1 ?  'Bỏ ẩn' : 'Ẩn' ?>
                          </button>
                      </form>

                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>

            </table>
          </div>
        </div>
        