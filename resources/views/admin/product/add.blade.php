@extends('templates.admin.master')
@section('main-content')
    <style>
        .text-dark th {
            border-bottom-width: 0px !important;
        }
        .form-error {
            color: red;
        }
    </style>
    <div class="content">
        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4" style="min-height: 600px">
            <div class="col-sm-10 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h2 class="mb-4">Thêm sản phẩm mới</h2>
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Tên sản phẩm &nbsp;<span class="form-error">*</span></label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}">
                            <span class="form-text form-error">
                                {{ $errors->first('product_name') }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="product_code" class="form-label">Mã sản phẩm &nbsp;<span class="form-error">*</span></label>
                            <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code') }}">
                            <i class="fa fa-info-circle"></i> &nbsp; Mã SP gồm ký tự A-Za-z 0-9 -_ !
                            <br>
                            <span class="form-text form-error">
                                {{ $errors->first('product_code') }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="price_in" class="form-label">Giá nhập &nbsp;<span class="form-error">*</span></label>
                            <input type="number" class="form-control" id="price_in" name="price_in" value="{{ old('price_in') }}">
                            <span class="form-text form-error">
                                {{ $errors->first('price_in') }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="price_out" class="form-label">Giá bán &nbsp;<span class="form-error">*</span></label>
                            <input type="number" class="form-control" id="price_out" name="price_out" value="{{ old('price_out') }}">
                            <span class="form-text form-error">
                                {{ $errors->first('price_out') }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="product_image" class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" id="product_image" name="product_image" value="">
                        </div>
                        <div class="mb-3">
                            <label for="floatingSelect">Danh mục &nbsp;<span class="form-error">*</span></label>
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example" id="cat_id" name="cat_id">
                                <option disabled selected hidden>Chọn danh mục</option>
                                @foreach($dataCategory as $itemCat)
                                    <option value="{{$itemCat->id}}">{{$itemCat->name}}</option>
                                @endforeach
                            </select>
                            <span class="form-text form-error">
                                {{ $errors->first('cat_id') }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="floatingSelect">Đơn vị &nbsp;<span class="form-error">*</span></label>
                            <select class="form-select form-select-lg" aria-label=".form-select-lg example" id="product_unit" name="product_unit">
                                <option disabled selected hidden>Chọn đơn vị</option>
                                @foreach($dataUnit as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                            <span class="form-text form-error">
                                {{ $errors->first('product_unit') }}
                            </span>
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
