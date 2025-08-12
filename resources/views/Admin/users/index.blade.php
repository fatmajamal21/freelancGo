@extends('admin.master')

@section('title', 'لوحة تحكم | قسم المستخدمين')

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

    <!-- Modal لإضافة مستخدم جديد -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة مستخدم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.users.store') }}" method="POST" id="form_add">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">اسم المستخدم</label>
                            <input name="name" class="form-control" type="text" required>
                        </div>
                        <div class="mb-2 form-group">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input name="email" class="form-control" type="email" required>
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

    <!-- Modal لتعديل المستخدم -->
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">تعديل بيانات المستخدم</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-user-form">
                        @csrf
                        <input type="hidden" id="user_id" name="id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
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
                            <label class="form-label">اسم المستخدم</label>
                            <input id="search_name" class="form-control" type="text">
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input id="search_email" class="form-control" type="email">
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
                            <h5 class="mb-0">المستخدمين</h5>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="d-flex justify-content-end">
                                <a data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-primary text-white">
                                    إضافة مستخدم
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users-table" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>البريد الإلكتروني</th>
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
            window.table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.users.getdata") }}',
                    data: function (d) {
                        d.name = $('#search_name').val();
                        d.email = $('#search_email').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                                <div class="d-flex gap-3">
                                    <a href="javascript:void(0);" class="text-warning edit-btn" data-id="${row.id}" data-name="${row.name}" data-email="${row.email}">
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

            // عند الضغط على زر البحث
            $('#search_btn').on('click', function (e) {
                e.preventDefault();
                table.draw();
            });

            // عند الضغط على زر إعادة التهيئة
            $('#clear_btn').on('click', function (e) {
                e.preventDefault();
                $('#search_name').val('');
                $('#search_email').val('');
                table.draw();
            });

            // عند الضغط على زر التعديل
            $(document).on('click', '.edit-btn', function () {
                var userId = $(this).data('id');
                var userName = $(this).data('name');
                var userEmail = $(this).data('email');
                
                // ملء الحقول في الـ Modal
                $('#user_id').val(userId);
                $('#edit_name').val(userName);
                $('#edit_email').val(userEmail);

                // فتح الـ Modal
                $('#edit-modal').modal('show');
            });

            // إرسال بيانات التحديث
            $('#edit-user-form').on('submit', function (e) {
                e.preventDefault();

                var userId = $('#user_id').val();

                $.ajax({
                    url: '{{ route("admin.users.update") }}',
                    method: 'POST',
                    data: $(this).serialize() + '&id=' + userId,
                    success: function (response) {
                        alert(response.success);
                        $('#edit-modal').modal('hide');
                        table.draw();
                    },
                    error: function () {
                        alert('حدث خطأ!');
                    }
                });
            });

            // عند الضغط على زر الحذف
            $(document).on('click', '.delete-btn', function () {
                var userId = $(this).data('id');
                
                if (confirm('هل أنت متأكد من أنك تريد حذف هذا المستخدم؟')) {
                    $.ajax({
                        url: '{{ route("admin.users.delete") }}',
                        method: 'POST',
                        data: { id: userId, _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            alert(response.success);
                            table.draw(); // إعادة تحميل البيانات
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
