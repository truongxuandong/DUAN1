
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">

                                    <div class="stat-text"><span class="count">
                                            <?php
                                            if (!empty($totalprice)) {
                                                foreach ($totalprice as $order) {
                                                    // Kiểm tra nếu giá trị không phải null
                                                    $total = $order['total'] !== null ? $order['total'] : 0;
                                                    echo number_format($total, 0, ',', '.') . ' đ';
                                                }
                                            } else {
                                                echo '0 đ ';
                                            }
                                            ?>
                                        </span></div>
                                    <div class="stat-heading">Doanh thu</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">
                                        <?php
                                        if (!empty($totalorder)) {
                                            foreach ($totalorder as $order) {
                                                echo $order['total'];
                                            }
                                        }
                                        ?>
                                    </span></div>
                                    <div class="stat-heading">Đơn hàng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="pe-7s-browser"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">
                                        <?php
                                        if (!empty($totalproduct)) {
                                            foreach ($totalproduct as $product) {
                                                echo $product['total'];
                                            }
                                        }
                                        ?>
                                    </span></div>
                                    <div class="stat-heading">Sản phẩm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">
                                        <?php
                                        if (!empty($totaluser)) {
                                            foreach ($totaluser as $user) {
                                                echo $user['total'];
                                            }
                                        }
                                        ?>
                                    </span></div>
                                    <div class="stat-heading">Tài khoản</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
         <!-- Traffic  -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="box-title">Thống kê doanh thu</h4>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card-body">
                        <!-- Thêm tab để chuyển đổi giữa biểu đồ tháng và ngày -->
                        <ul class="nav nav-tabs" id="chartTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#monthlyChart">Theo tháng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dailyChart">Theo ngày</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="monthlyChart">
                                <canvas id="monthlyChartCanvas"></canvas>
                            </div>
                            <div class="tab-pane fade" id="dailyChart">
                                <canvas id="dailyChartCanvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-body">
                        <!-- Thống kê theo ngày -->
                        <div class="daily-stats">
                            <h4>Thống kê hôm nay</h4>
                            <div class="stat-item">
                                <span>Đơn hàng mới:</span>
                                <strong><?php echo isset($today_orders) ? $today_orders : 0; ?></strong>
                                <?php if (isset($yesterday_orders)): ?>
                                    <small class="comparison <?php echo ($today_orders > $yesterday_orders) ? 'text-success' : 'text-danger'; ?>">
                                        <?php
                                        $diff = $today_orders - $yesterday_orders;
                                        echo ($diff >= 0 ? '+' : '') . $diff . ' so với hôm qua';
                                        ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="stat-item">
                                <span>Doanh thu:</span>
                                <strong><?php echo isset($today_revenue) ? number_format($today_revenue, 0, ',', '.') . ' đ' : '0 đ'; ?></strong>
                                <?php if (isset($yesterday_revenue)): ?>
                                    <small class="comparison <?php echo ($today_revenue > $yesterday_revenue) ? 'text-success' : 'text-danger'; ?>">
                                        <?php
                                        $diff = $today_revenue - $yesterday_revenue;
                                        echo ($diff >= 0 ? '+' : '') . number_format($diff, 0, ',', '.') . ' đ so với hôm qua';
                                        ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                            <div class="stat-item">
                                <span>Sản phẩm bán ra:</span>
                                <strong><?php echo isset($today_products) ? $today_products : 0; ?></strong>
                                <?php if (isset($yesterday_products)): ?>
                                    <small class="comparison <?php echo ($today_products > $yesterday_products) ? 'text-success' : 'text-danger'; ?>">
                                        <?php
                                        $diff = $today_products - $yesterday_products;
                                        echo ($diff >= 0 ? '+' : '') . $diff . ' so với hôm qua';
                                        ?>
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Thêm thống kê theo tháng -->
                        <div class="monthly-stats mt-4">
                            <h4>Thống kê tháng này</h4>
                            <div class="stat-item">
                                <span>Tổng đơn hàng:</span>
                                <strong><?php echo isset($month_orders) ? $month_orders : 0; ?></strong>
                            </div>
                            <div class="stat-item">
                                <span>Tổng doanh thu:</span>
                                <strong><?php echo isset($month_revenue) ? number_format($month_revenue, 0, ',', '.') . ' đ' : '0 đ'; ?></strong>
                            </div>
                            <div class="stat-item">
                                <span>Tổng sản phẩm:</span>
                                <strong><?php echo isset($month_products) ? $month_products : 0; ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Thêm script để vẽ biểu đồ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Biểu đồ theo tháng
    const monthlyData = {
        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
        datasets: [{
            label: 'Doanh thu theo tháng',
            data: <?php echo json_encode($monthly_revenue ?? []); ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    // Biểu đồ theo ngày (7 ngày gần nhất)
    const dailyData = {
        labels: <?php echo json_encode($daily_labels ?? []); ?>,
        datasets: [{
            label: 'Doanh thu theo ngày',
            data: <?php echo json_encode($daily_revenue ?? []); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            tension: 0.4
        }]
    };

    // Khởi tạo biểu đồ tháng
    const monthlyCtx = document.getElementById('monthlyChartCanvas').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: monthlyData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Khởi tạo biểu đồ ngày
    const dailyCtx = document.getElementById('dailyChartCanvas').getContext('2d');
    new Chart(dailyCtx, {
        type: 'line',
        data: dailyData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(value);
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return new Intl.NumberFormat('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(context.raw);
                        }
                    }
                }
            }
        }
    });
});
</script>