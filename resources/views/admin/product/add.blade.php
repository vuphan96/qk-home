@extends('templates.admin.master')
@section('main-content')
    <style>
        .text-dark th {
            border-bottom-width: 0px !important;
        }
    </style>
    <div class="content">
        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4" style="min-height: 600px">
            <div class="col-sm-10 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h2 class="mb-4">Thêm sản phẩm mới</h2>
                    <form role="form" action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="product_code" class="form-label">Mã sản phẩm</label>
                            <input type="text" class="form-control" id="product_code" name="product_code" value="">
                        </div>
                        <div class="mb-3">
                            <label for="price_in" class="form-label">Giá nhập</label>
                            <input type="number" class="form-control" id="price_in" name="price_in" value="">
                        </div>
                        <div class="mb-3">
                            <label for="price_out" class="form-label">Giá bán</label>
                            <input type="number" class="form-control" id="price_out" name="price_out" value="">
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="product_image" name="product_image" value="">
                        </div>
                        <div class="mb-3">
                            <label for="floatingSelect">Danh mục</label>
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example" id="cat_id" name="cat_id">
                                <option selected>Chọn Danh mục</option>
                                <option value="1">Bàn</option>
                                <option value="2">Ghế</option>
                                <option value="3">Tủ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="floatingSelect">Đơn vị</label>
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example" id="product_unit" name="product_unit">
                                <option selected>chọn đơn vị</option>
                                <option value="1">Bộ</option>
                                <option value="2">Cái</option>
                                <option value="3">Hộp</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" value="1">
                            <label class="form-check-label" for="status">Trạng thái</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
        @include('templates.admin.inc.footer')
        <!-- Recent Sales End -->
        <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>

    @endsection
