@extends('admin.master')

@section('title', 'لوحة تحكم فريلانقو | قسم الصلاحيات')

@section('css')
    <style>
        .dataTables_wrapper {
            overflow-x: auto;
        }

        .fixed-column {
            background-color: #f8f9fa;
            z-index: 1;
        }
        
        .product {
            position: relative;
            cursor: pointer;
        }

        .description-box {
            max-height: 50px;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
            background-color: #ffffff;
        }

        .scroll-box {
            max-height: 150px;
            overflow-y: auto;
            display: none;
            border: 1px solid #7212df;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            z-index: 10;
            top: 0;
            left: 0;
            width: 100%;
        }

        .product:hover .scroll-box {
            display: block;
        }

        .description-box:hover {
            max-height: 200px;
        }

        .show-sizes-btn {
            position: relative;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .show-sizes-btn:hover {
            background-color: #0056b3;
        }
    </style>
@stop

@section('content')

<!-- Modal لتعديل صلاحية موجودة -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">تعديل الصلاحية</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-permission-form">
                    @csrf
                    <input type="hidden" id="permission_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">اسم الصلاحية</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_desc" class="form-label">وصف الصلاحية</label>
                        <input type="text" class="form-control" id="edit_desc" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_guard" class="form-label">مستحق الصلاحية</label>
                        <input type="text" class="form-control" id="edit_guard" name="guard" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal لإضافة صلاحية جديدة -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة صلاحية جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.permission.store') }}" method="POST" id="form_add">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">اسم الصلاحية</label>
                            <input name="name" class="form-control" type="text" required>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">وصف الصلاحية</label>
                            <input name="description" class="form-control" type="text" required>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">مستحق الصلاحية</label>
                            <select name="guard" class="form-control">
                                <option disabled selected>حدد المستحق</option>
                                @foreach ($guards as $key => $value)
                                    <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">مجموعة الصلاحية</label>
                            <select name="model" class="form-control">
                                <option disabled selected>حدد المجموعة</option>
                                @foreach ($models as $key => $value)
                                    <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- البحث والتصفية -->
    <div class="row">
        <div class="col-12">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">التصفية</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">اسم الصلاحية</label>
                            <input id="search_name" class="form-control" type="text">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">وصف الصلاحية</label>
                            <input id="search_desc" class="form-control" type="text">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 d-flex align-items-end gap-2">
                            <button id="search_btn" class="btn btn-primary w-50">بحث</button>
                            <button id="clear_btn" class="btn btn-secondary w-50" type="button">إعادة تهيئة</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- عرض الجدول -->
    <div class="row">
        <div class="col-12">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">الصلاحيات</h5>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="d-flex justify-content-end">
                                <a data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-primary text-white">
                                    إضافة صلاحية
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="permissions-table" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>اسم الصلاحية</th>
                                    <th>وصف الصلاحية</th>
                                    <th>مستحق الصلاحية</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function () {
            // تهيئة DataTable مع الفلاتر
       window.table = $('#permissions-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route("admin.permission.getdata") }}',
        data: function (d) {
            d.name = $('#search_name').val(); // البحث بواسطة اسم الصلاحية
            d.desc = $('#search_desc').val(); // البحث بواسطة وصف الصلاحية
        }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'name', name: 'name' },
        { data: 'description', name: 'description' },
        { data: 'guard', name: 'guard' },
        { 
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false,
            render: function (data, type, row) {
                return `
                    <div class="d-flex gap-3">
                        <a href="javascript:void(0);" class="text-warning edit-btn" data-id="${row.id}" data-name="${row.name}" data-desc="${row.description}" data-guard="${row.guard}">
                            <i class="bi bi-pencil-fill"></i> تعديل
                        </a>
                        <a href="javascript:void(0);" class="text-danger delete-btn" data-id="${row.id}">
                            <i class="bi bi-trash-fill"></i> حذف
                        </a>
                    </div>
                `;
            }
        }
    ],
    language: {
        url: "{{ asset('datatable_custom/i18n/ar.json') }}"
    }
});


$('#search_btn').on('click', function (e) {
    e.preventDefault();
    table.draw();  // تحديث البيانات في DataTable باستخدام الفلاتر
});

// عند الضغط على زر إعادة التهيئة
$('#clear_btn').on('click', function (e) {
    e.preventDefault();
    $('#search_name').val('');  // إعادة تهيئة حقل اسم الصلاحية
    $('#search_desc').val('');  // إعادة تهيئة حقل وصف الصلاحية
    table.draw();  // تحديث الجدول
});

            // فتح الـ Modal لتعديل الصلاحية
            $(document).on('click', '.edit-btn', function () {
                var permissionId = $(this).data('id');
                var permissionName = $(this).data('name');
                var permissionDesc = $(this).data('desc');
                var permissionGuard = $(this).data('guard');

                // ملء الحقول في الـ Modal
                $('#permission_id').val(permissionId);
                $('#edit_name').val(permissionName);
                $('#edit_desc').val(permissionDesc);
                $('#edit_guard').val(permissionGuard);

                // فتح الـ Modal
                $('#edit-modal').modal('show');
            });

            // التعامل مع تحديث الصلاحية
            $('#edit-freelancer-form').on('submit', function (e) {
                e.preventDefault();
                
                var permissionId = $('#permission_id').val();
                
                $.ajax({
                    url: '{{ route("admin.permission.update") }}',
                    method: 'POST',
                    data: $(this).serialize() + '&id=' + permissionId,
                    success: function (response) {
                        alert(response.success);
                        $('#edit-modal').modal('hide');
                        table.draw();  // إعادة تحميل بيانات الجدول
                    },
                    error: function () {
                        alert('حدث خطأ!');
                    }
                });
            });

            // حذف الصلاحية
            $(document).on('click', '.delete-btn', function () {
                var permissionId = $(this).data('id');
                
                if (confirm('هل أنت متأكد من أنك تريد حذف هذه الصلاحية؟')) {
                    $.ajax({
                        url: '{{ route("admin.permission.delete") }}',
                        method: 'POST',
                        data: { id: permissionId, _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            alert(response.success);
                            table.draw(); // إعادة تحميل بيانات الجدول
                        },
                        error: function () {
                            alert('حدث خطأ!');
                        }
                    });
                }
            });
        });
    </script>
@endsection
