<?php 

class HomeController 
{
    public $home;
    protected $data = [];

    public function __construct() {
        $this->home = new Thongke();
    }

    public function views_home() {
        $totalprice = $this->home->getTotalPrice();
        $totalproduct = $this->home->getTotalProduct();
        $totaluser = $this->home->getTotalUser();
        $totalorder = $this->home->getTotalOrder();

        // Thống kê theo ngày
        $today = date('Y-m-d');
        $today_orders = $this->home->countOrdersByDate($today);
        $today_revenue = $this->home->getRevenueByDate($today);
        $today_products = $this->home->countProductsSoldByDate($today);

        // Thống kê theo tháng
        $year = date('Y');
        $monthly_data = $this->home->getMonthlyRevenue($year);
        
        // Chuẩn bị dữ liệu cho biểu đồ
        $monthly_revenue = array_fill(0, 12, 0); // Khởi tạo mảng 12 tháng với giá trị 0
        foreach ($monthly_data as $data) {
            $month_index = (int)$data['month'] - 1; // Chuyển tháng về index 0-11
            $monthly_revenue[$month_index] = (float)$data['total'];
        }

        // Lấy thống kê tháng hiện tại
    $currentMonth = date('m');
    $currentYear = date('Y');
    
    // Tính tổng đơn hàng trong tháng
    $month_orders = $this->home->countOrdersByDateRange($currentMonth, $currentYear);
    
    // Tính tổng doanh thu trong tháng
    $month_revenue = $this->home->sumRevenueByDateRange($currentMonth, $currentYear);
    
    // Tính tổng sản phẩm bán ra trong tháng
    $month_products = $this->home->countProductsSoldByDateRange($currentMonth, $currentYear);
    
    // Thống kê hôm qua
    $yesterday = date('Y-m-d', strtotime('-1 day'));
    $yesterday_orders = $this->home->countOrdersByDate($yesterday);
    $yesterday_revenue = $this->home->getRevenueByDate($yesterday);
    $yesterday_products = $this->home->countProductsSoldByDate($yesterday);

    // Dữ liệu cho biểu đồ theo ngày (7 ngày gần nhất)
    $daily_data = $this->home->getDailyRevenue(7);
    $daily_labels = [];
    $daily_revenue = [];
    foreach ($daily_data as $data) {
        $daily_labels[] = date('d/m', strtotime($data['date']));
        $daily_revenue[] = (float)$data['total'];
    }

    // Truyền dữ liệu sang view
    $data = [
        // ... other data ...
        'month_orders' => $month_orders,
        'month_revenue' => $month_revenue,
        'month_products' => $month_products,
        'yesterday_orders' => $yesterday_orders,
        'yesterday_revenue' => $yesterday_revenue,
        'yesterday_products' => $yesterday_products,
        'daily_labels' => $daily_labels,
        'daily_revenue' => $daily_revenue
    ];

        // Truyền các biến sang view
        require_once './views/trangchu.php';
    }
} 