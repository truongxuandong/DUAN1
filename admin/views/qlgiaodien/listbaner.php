<div class="col-12">
    <hr>
    <div class="btn btn-warning">
        <a href="<?php echo BASE_URL_ADMIN.'?act=form-add-banner' ?>">Thêm banner</a>
    </div>
    <h2>Danh sách Banner</h2>
    <div class="">
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh banner</th>
                    <th>Tiêu đề</th>
                    <th>Ngày tạo</th>
                    <th>Ngày cập nhập</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($banners as $key => $banner) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><img src="<?= $banner['Img'] ?>" alt="Banner" width="100"></td>
                    <td><?= $banner['Title'] ?></td>
                    <td><?= $banner['CreatedAt'] ?></td>
                    <td><?= $banner['UpdatedAt'] ?></td>
                    
                    <td><?= $banner['Status'] == 1 ? 'Hiển thị' : 'Ẩn' ?></td>
                    <td>
                        <div class="btn-group">
                        <a href="<?php echo BASE_URL_ADMIN . '?act=toggle-banner-status&ID=' . $banner['ID'] . '&Status=' . ($banner['Status'] == 1 ? 0 : 1); ?>" class="btn btn-warning">
                            <?= $banner['Status'] == 1 ? 'Ẩn' : 'Hiển thị' ?>
                        </a>
                        
                        <a href="<?php echo BASE_URL_ADMIN . '?act=form-edit-banner&ID=' . $banner['ID']; ?>"  class="btn btn-warning">
                                Sửa
                            </a>
                            <!-- Xóa banner -->
                            <a href="<?php echo BASE_URL_ADMIN . '?act=delete-banner&ID=' . $banner['ID']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này không?')" class="btn btn-danger">
                                Xóa
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach ;?>
            </tbody>
        </table>
    </div>
</div>
