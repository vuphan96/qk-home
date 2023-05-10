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
                        </form>'
                    </div>
                </div>
                <div class="row  pt-2 pb-2">
                    {{-- delete list category  --}}
                    <div class="col-sm-4">
                        <a type="button" class=" btn btn-danger">Xóa</a>
                    </div>
                    {{-- file  --}}
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div class="" style="margin-right: 4px"><button type="button" class=" btn btn-success"
                                data-toggle="modal" data-target="#modalAddCategory">Thêm</button></div>
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
                                <th scope="col">Tên</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col" class="text-center">Trạng thái</th>
                                <th scope="col" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTmp as $key => $category)
                                <tr>
                                    <td class="text-center"><input name="checkbox-{{ $category->id }}"
                                            id="checkbox-{{ $category->id }}" type="checkbox" value="{{ $category->id }}">
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->create_by }}</td>
                                    <td class="text-center">{!! $category->status == 1
                                        ? '<button class="btn btn-sm btn-success" href="">ON</button>'
                                        : '<button class="btn btn-sm btn-danger" href="">OFF</button>' !!}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modalEditCategory" href=""
                                            onclick="editForm({{ $category->id }}, '{{ $category->name }}', {{ $category->status }})">Sửa</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                            onclick="deleteItem({{ $category->id }})">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{-- add category  --}}
                <div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="category-form-add" role="form">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Tên &nbsp;<span style="color: red">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nhập tên danh mục" required>
                                        <div class="error-name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái</label><br>
                                        <input type="radio" name="status" value="1" checked="checked" /> Hiện
                                        <input type="radio" name="status" value="0" /> Ẩn
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" id="submit">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal add category --}}
                {{-- modal edit category --}}
                <div class="modal fade" id="modalEditCategory" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="category-form-edit" role="form">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name_edit">Tên &nbsp;<span style="color: red">*</span></label>
                                        <input type="text" name="name_edit" class="form-control" id="name_edit"
                                            placeholder="Nhập tên danh mục" required>
                                        <div class="error-name"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Trạng thái</label><br>
                                        <input type="radio" name="status" value="1" id="status1" /> Hiện
                                        <input type="radio" name="status" value="0" id="status0" /> Ẩn
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="button" class="btn btn-primary" id="edit_submit">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal edit category  --}}

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
        @include('templates.admin.inc.footer')
        <!-- Recent Sales End -->
        <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#submit").on('click', function(event) {
                    validateForm();
                });
            });

            function validateForm() {
                var name = $('#name').val();
                var status = $('[name = "status"]:checked').val();
                console.log(status);
                var errorMsg = null;
                if (!name) {
                    $('.error-name').html('<p style="color:red">Tên danh mục không được trống</p>');
                    errorMsg = 1;
                } else {
                    $('.error-name').html('');
                }
                submitFormAdd(errorMsg);
            }
// thêm mới danh mục
            function submitFormAdd(errorMsg) {

                if (errorMsg == null) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('admin.cat.create.category') }}',
                        cache: false,
                        data: $('#category-form-add').serialize(),
                        success: function(data) {
                            if (data.error == 0) {
                                swal({
                                        title: "Thêm thành công",
                                        text: "",
                                        type: "success",
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {} else {}
                                    });
                                location.reload();
                            } else {
                                swal({
                                        title: data.message,
                                        text: "",
                                        type: "warning",
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {} else {}
                                    });
                            }
                        },
                        error: function() {
                            swal({
                                    title: "Lỗi hệ thống, Vui lòng liên hệ bộ phận kỹ thuật",
                                    text: "",
                                    type: "warning",
                                },
                                function(isConfirm) {
                                    if (isConfirm) {} else {}
                                });
                        }
                    });
                }

            }
// chỉnh sửa danh mục
            function editForm(id, name, status) {
                $('#id').val(id);
                $('#name_edit').val(name);
                if (status == 1) {
                    $('#status1').attr('checked', 'checked');
                } else {
                    $('#status0').attr('checked', 'checked');
                }
            }

            $(document).ready(function() {
                $("#edit_submit").on('click', function(event) {
                    validateFormEdit();
                });
            });

            function validateFormEdit() {
                var name = $('#name_edit').val();
                var status = $('[name = "status"]:checked').val();
                var errorMsg = null;
                if (!name) {
                    $('.error-name').html('<p style="color:red">Tên danh mục không được trống</p>');
                    errorMsg = 1;
                } else {
                    $('.error-name').html('');
                }
                submitFormEdit(errorMsg);
            }

            function submitFormEdit(errorMsg) {

                if (errorMsg == null) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('admin.cat.update.category') }}',
                        cache: false,
                        data: $('#category-form-edit').serialize(),
                        success: function(data) {
                            if (data.error == 0) {
                                swal({
                                        title: data.message,
                                        text: "",
                                        type: "success",
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {} else {}
                                    });
                                location.reload();
                            } else {
                                swal({
                                        title: data.message,
                                        text: "",
                                        type: "warning",
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {} else {}
                                    });
                            }
                        },
                        error: function() {
                            swal({
                                    title: "Lỗi hệ thống, Vui lòng liên hệ bộ phận kỹ thuật",
                                    text: "",
                                    type: "warning",
                                },
                                function(isConfirm) {
                                    if (isConfirm) {} else {}
                                });
                        }
                    });
                }

            }
            // $('#select-all').click(function(event) {
            //     if (this.checked) {
            //         // Iterate each checkbox
            //         $(':checkbox').each(function() {
            //             this.checked = true;
            //         });
            //     } else {
            //         $(':checkbox').each(function() {
            //             this.checked = false;
            //         });
            //     }
            // });

            // $('#select-all').click(function(event) {
            //     var $that = $(this);
            //     $(':checkbox').each(function() {
            //         this.checked = $that.is(':checked');
            //     });
            // });

            $('#select-all').click(function(event) {
                if (this.checked) {
                    $(':checkbox').prop('checked', true);
                } else {
                    $(':checkbox').prop('checked', false);
                }
            });

            function deleteItem(id) {
                result = confirm("Bạn chắc chắn xóa mục này");
                if(result) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('admin.cat.delete.category') }}',
                        cache: false,
                        data: {
                            id:id,
                            _token: '{{ csrf_token() }}',
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data.error == 0) {
                                swal({
                                        title: data.message,
                                        text: "",
                                        type: "success",
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {} else {}
                                    });
                                location.reload();
                            } else {
                                swal({
                                        title: data.message,
                                        text: "",
                                        type: "warning",
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {} else {}
                                    });
                            }
                        },
                        error: function() {
                            swal({
                                    title: "Lỗi hệ thống, Vui lòng liên hệ bộ phận kỹ thuật",
                                    text: "",
                                    type: "warning",
                                },
                                function(isConfirm) {
                                    if (isConfirm) {} else {}
                                });
                        }
                    });
                }

            }
        </script>
    @endsection
