@extends('master')
@section('title' , 'فريلانقو | المشاريع')
@section('content')
<div class="profile-layout">

    <!-- مودال إضافة مشروع جديد -->
    {{-- <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة مشروع جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_add" action="{{ route('web.project.store') }}" id="form_add" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3 form-group">
                            <label class="form-label">عنوان المشروع</label>
                            <input placeholder="أدخل عنوان المشروع" name="title" class="form-control" type="text" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">ميزانية المشروع</label>
                            <input placeholder="أدخل ميزانية المشروع" name="budget" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">مدة المشروع (بالأيام)</label>
                            <input placeholder="أدخل مدة المشروع بالأيام" name="duration" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">وصف توضيحي للمشروع</label>
                            <textarea placeholder="أدخل وصفًا توضيحيًا للمشروع" name="desc" class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" style="background-color: #7212df" class="btn text-white">نشر المشروع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- مودال تعديل مشروع -->
    {{-- <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل المشروع</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_edit" id="form_edit" enctype="multipart/form-data" action="{{ route('web.project.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        
                        <div class="mb-3 form-group">
                            <label class="form-label">عنوان المشروع</label>
                            <input id="edit_title" placeholder="أدخل عنوان المشروع" name="title" class="form-control" type="text" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <div class="mb-3 form-group">
                            <label class="form-label">ميزانية المشروع</label>
                            <input id="edit_budget" placeholder="أدخل ميزانية المشروع" name="budget" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div classmb-3 form-group">
                            <label class="form-label">مدة المشروع (بالأيام)</label>
                            <input id="edit_duration" placeholder="أدخل مدة المشروع بالأيام" name="duration" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">وصف توضيحي للمشروع</label>
                            <textarea id="edit_desc" placeholder="أدخل وصفًا توضيحيًا للمشروع" name="desc" class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" style="background-color: #7212df" class="btn text-white">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- مودال تأكيد الحذف -->
    {{-- <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>هل أنت متأكد من أنك تريد حذف هذا المشروع؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form id="delete-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    @include('web.part.side')

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">المشاريع</h5>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                <a data-bs-toggle="modal" data-bs-target="#add-modal" style="background-color: #7212df; color:white" href="#" class="btn">
                                    <i class="fas fa-plus"></i> إضافة مشروع
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>العنوان</th>
                                    <th>وصف المشروع</th>
                                    <th>الميزانية</th>
                                    <th>المدة (أيام)</th>
                                    <th>تاريخ الانتهاء</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- سيتم ملء الجدول عبر DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .profile-layout {
        padding: 20px;
        direction: rtl;
    }
    
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    
    .card-header {
        border-bottom: 1px solid #f0f0f0;
        padding: 15px 20px;
    }
    
    .table th {
        font-weight: 600;
        color: #333;
    }
    
    .btn-action {
        padding: 5px 10px;
        margin: 0 3px;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-open {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    
    .status-in_progress {
        background-color: #fff3e0;
        color: #ef6c00;
    }
    
    .status-completed {
        background-color: #e3f2fd;
        color: #1565c0;
    }
    
    .status-cancelled {
        background-color: #ffebee;
        color: #c62828;
    }
    
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    
    .form-control:focus {
        border-color: #7212df;
        box-shadow: 0 0 0 0.25rem rgba(114, 18, 223, 0.25);
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('web.project.getdata') }}",
                data: function(d) {
                    // يمكنك إضافة معاملات البحث هنا إذا لزم الأمر
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "title",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: "description",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        // تقليل طول النص إذا كان طويلاً
                        return data && data !== "" ? 
                            (data.length > 50 ? data.substring(0, 50) + '...' : data) : "-";
                    }
                },
                {
                    data: 'budget',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data + " ر.س" : "-";
                    }
                },
                {
                    data: 'duration',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data + " يوم" : "-";
                    }
                },
                {
                    data: 'deadline',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'status',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        let statusClass = '';
                        let statusText = '';
                        
                        switch(data) {
                            case 'open':
                                statusClass = 'status-open';
                                statusText = 'مفتوح';
                                break;
                            case 'in_progress':
                                statusClass = 'status-in_progress';
                                statusText = 'قيد التنفيذ';
                                break;
                            case 'completed':
                                statusClass = 'status-completed';
                                statusText = 'مكتمل';
                                break;
                            case 'cancelled':
                                statusClass = 'status-cancelled';
                                statusText = 'ملغى';
                                break;
                            default:
                                statusClass = '';
                                statusText = data || '-';
                        }
                        
                        return '<span class="status-badge ' + statusClass + '">' + statusText + '</span>';
                    }
                },
                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        // استخدام البيانات من الـ row مباشرة
                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary update_btn" data-id="${row.id}" data-title="${row.title}" data-budget="${row.budget}" data-duration="${row.duration}" data-desc="${row.description}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${row.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            language: {
                url: "{{ asset('datatable_custom/i18n/ar.json') }}",
            }
        });

        // فتح مودال التعديل وتعبيته بالبيانات
        $(document).on('click', '.update_btn', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var budget = $(this).data('budget');
            var duration = $(this).data('duration');
            var desc = $(this).data('desc');
            
            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_budget').val(budget);
            $('#edit_duration').val(duration);
            $('#edit_desc').val(desc);
            
            $('#edit-modal').modal('show');
        });

        // فتح مودال الحذف
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var formAction = "{{ route('web.project.delete', ':id') }}".replace(':id', id);
            $('#delete-form').attr('action', formAction);
            $('#delete-modal').modal('show');
        });

        // إضافة تحقق من الصحة للنماذج
        $('#form_add, #form_edit').on('submit', function(e) {
            var form = $(this);
            var valid = true;
            
            form.find('.form-control').each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('هذا الحقل مطلوب');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (!valid) {
                e.preventDefault();
            }
        });

        // معالجة نجاح الإرسال
        $('#form_add, #form_edit').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // إغلاق المودال وتحديث الجدول
                        $('.modal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    }
                },
                error: function(xhr) {
                    // معالجة الأخطاء
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // عرض أخطاء التحقق
                        var errors = xhr.responseJSON.errors;
                        for (var field in errors) {
                            var input = form.find('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(errors[field][0]);
                        }
                    }
                }
            });
        });

        // معالجة حذف المشروع
        $('#delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        // إغلاق المودال وتحديث الجدول
                        $('#delete-modal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    }
                },
                error: function(xhr) {
                    // معالجة الأخطاء
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        alert(xhr.responseJSON.error);
                    }
                }
            });
        });
    });
</script>
@stop@extends('master')
@section('title' , 'فريلانقو | المشاريع')
@section('content')
<div class="profile-layout">

    <!-- مودال إضافة مشروع جديد -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة مشروع جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_add" action="{{ route('web.project.store') }}" id="form_add" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3 form-group">
                            <label class="form-label">عنوان المشروع</label>
                            <input placeholder="أدخل عنوان المشروع" name="title" class="form-control" type="text" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">ميزانية المشروع</label>
                            <input placeholder="أدخل ميزانية المشروع" name="budget" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">مدة المشروع (بالأيام)</label>
                            <input placeholder="أدخل مدة المشروع بالأيام" name="duration" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">وصف توضيحي للمشروع</label>
                            <textarea placeholder="أدخل وصفًا توضيحيًا للمشروع" name="desc" class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" style="background-color: #7212df" class="btn text-white">نشر المشروع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال تعديل مشروع -->
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل المشروع</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form_edit" id="form_edit" enctype="multipart/form-data" action="{{ route('web.project.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        
                        <div class="mb-3 form-group">
                            <label class="form-label">عنوان المشروع</label>
                            <input id="edit_title" placeholder="أدخل عنوان المشروع" name="title" class="form-control" type="text" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <div class="mb-3 form-group">
                            <label class="form-label">ميزانية المشروع</label>
                            <input id="edit_budget" placeholder="أدخل ميزانية المشروع" name="budget" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div classmb-3 form-group">
                            <label class="form-label">مدة المشروع (بالأيام)</label>
                            <input id="edit_duration" placeholder="أدخل مدة المشروع بالأيام" name="duration" class="form-control" type="number" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 form-group">
                            <label class="form-label">وصف توضيحي للمشروع</label>
                            <textarea id="edit_desc" placeholder="أدخل وصفًا توضيحيًا للمشروع" name="desc" class="form-control" rows="4" required></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" style="background-color: #7212df" class="btn text-white">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال تأكيد الحذف -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>هل أنت متأكد من أنك تريد حذف هذا المشروع؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form id="delete-form" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('web.part.side')

    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header bg-transparent">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            <h5 class="mb-0">المشاريع</h5>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-end gap-3 cursor-pointer">
                                <a data-bs-toggle="modal" data-bs-target="#add-modal" style="background-color: #7212df; color:white" href="#" class="btn">
                                    <i class="fas fa-plus"></i> إضافة مشروع
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>العنوان</th>
                                    <th>وصف المشروع</th>
                                    <th>الميزانية</th>
                                    <th>المدة (أيام)</th>
                                    <th>تاريخ الانتهاء</th>
                                    <th>الحالة</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- سيتم ملء الجدول عبر DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .profile-layout {
        padding: 20px;
        direction: rtl;
    }
    
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    
    .card-header {
        border-bottom: 1px solid #f0f0f0;
        padding: 15px 20px;
    }
    
    .table th {
        font-weight: 600;
        color: #333;
    }
    
    .btn-action {
        padding: 5px 10px;
        margin: 0 3px;
        border-radius: 5px;
        font-size: 14px;
    }
    
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .status-open {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    
    .status-in_progress {
        background-color: #fff3e0;
        color: #ef6c00;
    }
    
    .status-completed {
        background-color: #e3f2fd;
        color: #1565c0;
    }
    
    .status-cancelled {
        background-color: #ffebee;
        color: #c62828;
    }
    
    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    
    .form-control:focus {
        border-color: #7212df;
        box-shadow: 0 0 0 0.25rem rgba(114, 18, 223, 0.25);
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('web.project.getdata') }}",
                data: function(d) {
                    // يمكنك إضافة معاملات البحث هنا إذا لزم الأمر
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "title",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: "description",
                    orderable: true,
                    searchable: true,
                    render: function(data, type, row) {
                        // تقليل طول النص إذا كان طويلاً
                        return data && data !== "" ? 
                            (data.length > 50 ? data.substring(0, 50) + '...' : data) : "-";
                    }
                },
                {
                    data: 'budget',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data + " ر.س" : "-";
                    }
                },
                {
                    data: 'duration',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data + " يوم" : "-";
                    }
                },
                {
                    data: 'deadline',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        return data && data !== "" ? data : "-";
                    }
                },
                {
                    data: 'status',
                    orderable: true,
                    searchable: false,
                    render: function(data, type, row) {
                        let statusClass = '';
                        let statusText = '';
                        
                        switch(data) {
                            case 'open':
                                statusClass = 'status-open';
                                statusText = 'مفتوح';
                                break;
                            case 'in_progress':
                                statusClass = 'status-in_progress';
                                statusText = 'قيد التنفيذ';
                                break;
                            case 'completed':
                                statusClass = 'status-completed';
                                statusText = 'مكتمل';
                                break;
                            case 'cancelled':
                                statusClass = 'status-cancelled';
                                statusText = 'ملغى';
                                break;
                            default:
                                statusClass = '';
                                statusText = data || '-';
                        }
                        
                        return '<span class="status-badge ' + statusClass + '">' + statusText + '</span>';
                    }
                },
                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        // استخدام البيانات من الـ row مباشرة
                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-primary update_btn" data-id="${row.id}" data-title="${row.title}" data-budget="${row.budget}" data-duration="${row.duration}" data-desc="${row.description}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${row.id}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            language: {
                url: "{{ asset('datatable_custom/i18n/ar.json') }}",
            }
        });

        // فتح مودال التعديل وتعبيته بالبيانات
        $(document).on('click', '.update_btn', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var budget = $(this).data('budget');
            var duration = $(this).data('duration');
            var desc = $(this).data('desc');
            
            $('#edit_id').val(id);
            $('#edit_title').val(title);
            $('#edit_budget').val(budget);
            $('#edit_duration').val(duration);
            $('#edit_desc').val(desc);
            
            $('#edit-modal').modal('show');
        });

        // فتح مودال الحذف
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            var formAction = "{{ route('web.project.delete', ':id') }}".replace(':id', id);
            $('#delete-form').attr('action', formAction);
            $('#delete-modal').modal('show');
        });

        // إضافة تحقق من الصحة للنماذج
        $('#form_add, #form_edit').on('submit', function(e) {
            var form = $(this);
            var valid = true;
            
            form.find('.form-control').each(function() {
                if ($(this).prop('required') && !$(this).val()) {
                    $(this).addClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('هذا الحقل مطلوب');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
            
            if (!valid) {
                e.preventDefault();
            }
        });

        // معالجة نجاح الإرسال
        $('#form_add, #form_edit').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // إغلاق المودال وتحديث الجدول
                        $('.modal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    }
                },
                error: function(xhr) {
                    // معالجة الأخطاء
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // عرض أخطاء التحقق
                        var errors = xhr.responseJSON.errors;
                        for (var field in errors) {
                            var input = form.find('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(errors[field][0]);
                        }
                    }
                }
            });
        });

        // معالجة حذف المشروع
        $('#delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        // إغلاق المودال وتحديث الجدول
                        $('#delete-modal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    }
                },
                error: function(xhr) {
                    // معالجة الأخطاء
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        alert(xhr.responseJSON.error);
                    }
                }
            });
        });
    });
</script>
@stop