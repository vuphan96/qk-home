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
            <div class="bg-light rounded p-4">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="pl-2">Quản lý danh mục</h3>
                    </div>
                </div>
                {{-- search by filter  --}}
                <div class="top-menu row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <form action="" id="button_search">
                            <div class="input-group input-group d-flex justify-content-end">
                                <div>
                                    <input type="text" name="keyword" class="form-control rounded-0"
                                        placeholder="tìm kiếm" value="">
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row  pt-2 pb-2">
                    {{-- delete list category  --}}
                    <div class="col-sm-4">
                        <a type="button" class=" btn btn-danger">Xóa</a>
                    </div>
                    {{-- file  --}}
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div class="" style="margin-right: 4px"><a href="{{route('admin.product.create')}}" type="button" class=" btn btn-success">Thêm</a></div>
                        <div class="" style="margin-right: 4px"><a type="button" class=" btn btn-success">Nhập</a>
                        </div>
                        <div class=""><a type="button" class=" btn btn-success">Xuất</a></div>
                    </div>

                </div>

                {{-- list category  --}}
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col" class="text-center"><input name="select-all" id="select-all"
                                        type="checkbox"></th>
                                <th scope="col">Tên SP</th>
                                <th scope="col">Mã SP</th>
                                <th scope="col" style="text-align:center">Hình</th>
                                <th scope="col">Giá nhập</th>
                                <th scope="col">Giá bán</th>
                                <th scope="col">Đơn vị</th>
                                <th scope="col" class="text-center">Trạng thái</th>
                                <th scope="col" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTmp as $key => $product)
                                <tr>
                                    <td class="text-center"><input name="checkbox-{{ $product->id }}"
                                            id="checkbox-{{ $product->id }}" type="checkbox" value="{{ $product->id }}">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td style="text-align:center"><img src="Storage/files/{{$product->image}}" alt="product image" title="product image" width="50px" height="50px"></td>
                                    <td>{{ $product->price_in }}</td>
                                    <td>{{ $product->price_out }}</td>
                                    <td>{{ $product->product_unit }}</td>
                                    <td class="text-center">{!! $product->status == 1
                                        ? '<button class="btn btn-sm btn-success" href="">ON</button>'
                                        : '<button class="btn btn-sm btn-danger" href="">OFF</button>' !!}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modalEditCategory" href=""
                                            onclick="editForm({{ $product->id }}, '{{ $product->name }}', {{ $product->status }})">Sửa</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                            onclick="deleteItem({{ $product->id }})">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <br>
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4 d-flex justify-content-end">
                        <nav class="text-center" aria-label="...">
                            {{ $dataTmp->appends(request()->all())->links() }}
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        @if (session('msg'))
            @php
                $session_value = session('msg');
            @endphp
        @endif
        @include('templates.admin.inc.footer')
        <!-- Recent Sales End -->
        <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
        <script>
            var notice ='<?php echo $session_value ?? '' ;?>';
            if(notice == 'success') {
                swal({
                    title: "Thêm sản phẩm thành công",
                    text: "",
                    type: "success",
                    timer: 2000,
                },
                function(isConfirm) {
                    if (isConfirm) {} else {}
                });
            }
            if (notice == 'error') {
                swal({
                    title: "Thất bại",
                    text: "",
                    type: "warning",
                },
                function(isConfirm) {
                    if (isConfirm) {} else {}
                });
            }
        </script>
    @endsection
