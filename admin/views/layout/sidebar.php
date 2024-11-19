<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="menu-item-has-children dropdown" style="margin-top: 20px;">
                    <a href="<?= BASE_URL_ADMIN ?>" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-home" style="font-size: 20px; margin-right: 10px;"></i>Trang Chủ
                    </a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="?act=listdm" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-th-large" style="font-size: 18px; margin-right: 10px;"></i>Danh mục sản phẩm
                    </a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="?act=san-pham" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-book" style="font-size: 18px; margin-right: 10px;"></i>Sản phẩm
                    </a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="?act=order" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-list-alt" style="font-size: 18px; margin-right: 10px;"></i>Danh sách đơn hàng
                    </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="?act=khuyen-mai" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-list-alt" style="font-size: 18px; margin-right: 10px;"></i>Quản lí khuyến mãi
                    </a>
                </li>
                

                <li class="menu-item-has-children dropdown">

                    <a href="?act=binh-luan">
                        <i class="menu-icon fa fa-comments" style="font-size: 20px; margin-right: 10px;"></i>Bình luận
                    </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="?act=danh-gia">
                        <i class="menu-icon fa fa-star" style="font-size: 20px; margin-right: 10px;"></i>Đánh giá
                    </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="<?= BASE_URL_ADMIN."?act=giao-dien"?>" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-comments" style="font-size: 20px; margin-right: 10px;"></i>Quản lí Banner

                    </a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="?act=user" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-users" style="font-size: 18px; margin-right: 10px;"></i>Quản lí tài khoản
                    </a>
                </li>
                
                <li class="menu-item-has-children dropdown">
                    <a href="" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-line-chart" style="font-size: 15px; margin-right: 10px;"></i>Thống kê
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>



<script>
    document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('.menu-item-has-children .dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault(); // Ngăn điều hướng mặc định
            const parent = this.closest('.menu-item-has-children');
            const isOpen = parent.classList.contains('open');
            
            // Đóng tất cả các menu khác
            document.querySelectorAll('.menu-item-has-children.open').forEach(item => {
                item.classList.remove('open');
            });

            // Toggle trạng thái menu hiện tại
            if (!isOpen) {
                parent.classList.add('open');
            }
        });
    });
});

</script>
