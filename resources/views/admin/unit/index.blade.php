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
                        <h3 class="pl-2">Quản lý đơn vị tính</h3>
                    </div>
                </div>
                {{-- search by filter  --}}
                <div class="top-menu row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4">
                        <form action="{{route('admin.unit.index')}}" id="button_search">
                            {{-- @csrf --}}
                            <div class="input-group input-group d-flex justify-content-end">
                                <div>
                                    <input type="text" name="keyword" class="form-control rounded-0"
                                        placeholder="tìm kiếm" value="{{ $_GET['keyword'] ?? ''}}">
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row  pt-2 pb-2">
                    {{-- delete list unit  --}}
                    <div class="col-sm-4">
                        <a type="button" onclick="deleteList()" class=" btn btn-danger">Xóa</a>
                    </div>
                    {{-- file  --}}
                    <div class="col-sm-8 d-flex justify-content-end">
                        <div class="" style="margin-right: 4px"><button type="button" class=" btn btn-success"
                                data-toggle="modal" data-target="#modalAddUnit">Thêm</button></div>
                    </div>

                </div>

                {{-- list unit  --}}
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col" class="text-center"><input name="select-all" id="select-all"
                                        type="checkbox"></th>
                                <th scope="col">Tên đơn vị</th>
                                <th scope="col" class="text-center">Trạng thái</th>
                                <th scope="col" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTmp as $key => $unit)
                                <tr>
                                    <td class="text-center"><input name="checkbox-{{ $unit->id }}" class="grid-row-checkbox" data-id="{{ $unit->id }}"
                                            id="checkbox-{{ $unit->id }}" type="checkbox" value="{{ $unit->id }}">
                                    </td>
                                    <td>{{ $unit->name }}</td>
                                    <td class="text-center">{!! $unit->status == 1
                                        ? '<button class="btn btn-sm btn-success" href="">ON</button>'
                                        : '<button class="btn btn-sm btn-danger" href="">OFF</button>' !!}</td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#modalEditUnit" href=""
                                            onclick="editForm({{ $unit->id }}, '{{ $unit->name }}', {{ $unit->status }})">Sửa</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                            onclick="deleteItem({{ $unit->id }})">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{-- add unit  --}}
                <div class="modal fade" id="modalAddUnit" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm đơn vị</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="unit-form-add" role="form">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Tên &nbsp;<span style="color: red">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nhập tên đơn vị" required>
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
                {{-- end modal add unit --}}
                {{-- modal edit unit --}}
                <div class="modal fade" id="modalEditUnit" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa đơn vị</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="unit-form-edit" role="form">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name_edit">Tên &nbsp;<span style="color: red">*</span></label>
                                        <input type="text" name="name_edit" class="form-control" id="name_edit"
                                            placeholder="Nhập tên đon vị" required>
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
                {{-- end modal edit unit  --}}

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
    </div>
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
                    $('.error-name').html('<p style="color:red">Tên đơn vị không được trống</p>');
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
                        url: '{{ route('admin.unit.create') }}',
                        cache: false,
                        data: $('#unit-form-add').serialize(),
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
                    $('.error-name').html('<p style="color:red">Tên đơn vị không được trống</p>');
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
                        url: '{{ route('admin.unit.update') }}',
                        cache: false,
                        data: $('#unit-form-edit').serialize(),
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


            $('#select-all').click(function(event) {
                if (this.checked) {
                    $(':checkbox').prop('checked', true);
                } else {
                    $(':checkbox').prop('checked', false);
                }
            });
            var selectedRows = function () {
                var selected = [];
                $('.grid-row-checkbox:checked').each(function(){
                    selected.push($(this).data('id'));
                });

                return selected;
            }
            function deleteList(){
                var ids = selectedRows().join();
                deleteItem(ids);
            }

            function deleteItem(ids) {
                    if(ids == ""){
                        swal({
                            title: "Vui lòng chọn it nhât 1 bản ghi trước khi xoá đối tượng",
                            text: "",
                            type: "warning",
                        },
                        function(isConfirm) {
                            if (isConfirm) {} else {}
                        });
                        return;
                    }
                    swal({
                        title: "Bạn chắc chắn xóa",
                        text: "",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                        if (result.value == true) {
                            $.ajax({
                        type: "POST",
                        url: '{{ route('admin.unit.delete') }}',
                        cache: false,
                        data: {
                            ids:ids,
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
                    });

            }
        </script>
    @endsection
