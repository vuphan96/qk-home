<!-- Sidebar Start -->
<div class="sidebar">
    <nav class="navbar bg-light navbar-light">
        <div class="w-100 bg-light" >
            <h3 class="text-warning text-center" style="color: black !important">QK HOME</h3>
        </div>
        <div class="d-flex align-items-center mx-3 mb-4 w-75">
            <div class="position-relative">
                <img class="rounded-circle" src="templates/admin/assets/img/user.jpg" alt="" style="width: 60px; height: 60px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3 w-50">
                <h4 class="mb-0">Vu Phan</h4>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{route('admin-dashboard')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{route('admin.cat.index')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Danh mục</a>
            <a href="{{route('admin.product.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Sản phẩm</a>
            <a href="{{route('admin.unit.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Đơn vị</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Bán hàng</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Đơn hàng</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Lịch sử</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Người dùng</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Báo cáo</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="button.html" class="dropdown-item">Danh thu</a>
                    <a href="typography.html" class="dropdown-item">Thu nhập</a>
                </div>
            </div>
        </div>
    </nav>
</div>
