@extends('templates.admin.master')
@section('main-content')
    <style>
        .filepond--credits {
            display: none;
        }
    </style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class=" ">
                            <h3 class="card-title"> Nhập danh mục </h3>
                    </div>

                    <div class="card-tools d-flex align-items-end">
                        <div class="btn-group float-right mr-5">
                            <a href="{{ route('admin.cat.index') }}" class="btn  btn-flat btn-default"
                            title="List"><i class="fa fa-list"></i><span class="hidden-xs">Trở lại trang danh sách</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-tools">
                    <br><br>
                </div>


                <form action="{{ route('admin.cat.post_import.category') }}" method="post" accept-charset="UTF-8"
                    class="form-horizontal" id="import-excel" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group {{ $errors->has('file') ? ' text-red' : '' }}">
                                <label for="image" class="col-sm-2 col-form-label">
                                </label>
                                <div class="col-sm-6 p-3">
                                    <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
                                    <input name="excel_file" placeholder="Your Import"
                                        type="file" class="filepond" id="excel_file" name="excel-file">
                                    <div>
                                        @if(session()->get('dupticateCode'))
                                            <span class="form-text text-red">
                                                    <i class="fa fa-info-circle"></i> {{ route('admin.cat.index') }}
                                                    <div class="pl-3">
                                                        @foreach(session()->get('dupticateCode') as $row_index => $warrning)
                                                            <code><b>Dòng {{ $row_index }} - {{ $warrning }}</b></code>
                                                            <br/>
                                                        @endforeach
                                                    </div>
                                                </span>
                                        @endif
                                        <span class="form-text">
                                            <i class="fa fa-info-circle"></i> Chỉ chấp nhận tập tin <span style="color:red">  .xls hoặc .xlsx</span>
                                        </span>
                                        <br>
                                        <span class="form-text">
                                        <i class="fa fa-info-circle"></i> Lưu ý: file nhập danh mục sản phẩm tối thiểu 1 bản ghi
                                    </span>

                                    </div>
                                </div>
                            </div>
                            <div class="fields-group">
                                <div class="form-group">
                                    <div class="col-md-6 pl-3">
                                        <button class="btn btn-sm btn-primary" id="button-upload"><i
                                                    class="fa fa-save"></i> Tải lên
                                        </button>
                                        <a class="btn btn-sm btn-success"
                                        href="{{ asset('templates/fileimport/DanhmucsanphamTmp.xlsx')}}"><i
                                                    class="fa fa-download"></i> Tải mẫu excel import</a>
                                        <a class="btn btn-sm btn-secondary"
                                        href="{{ route('admin.cat.index') }}"><i class="fa fa-backward"></i>
                                            Quay lại</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
    @include('templates.admin.inc.footer')
    <br>
</div>

<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script>
    $.fn.filepond.registerPlugin(FilePondPluginFileValidateSize);
    $.fn.filepond.registerPlugin(FilePondPluginFileValidateType);
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
    $('#button-upload').prop('disabled', true);
    $('.filepond').filepond({
        labelIdle: 'Chọn từ hệ thống hoặc kéo thả file vào <span class="filepond--label-action"> đây</span>',
        maxFileSize: '10MB',
        acceptedFileTypes: [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ],
        storeAsFile: true,
        allowImagePreview: true
    });
    $('.filepond').on('FilePond:addfile', function (e) {
        console.log(e);
        if (e.detail.items.length > 0) {
            $('#button-upload').prop('disabled', false);
        } else {
            $('#button-upload').prop('disabled', true);
        }
    });
    $(document).ready(function () {
        $('#import-excel').submit(function () {
            $('#loading').show();
        });
    });
</script>
@endsection
