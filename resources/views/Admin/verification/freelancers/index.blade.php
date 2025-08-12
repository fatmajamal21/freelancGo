@extends('admin.master')

@section('title', 'لوحة تحكم  | قسم توثيق هوية العملاء')
@section('css')
    <style>
        .dataTables_wrapper {
            overflow-x: auto;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

     
            .btn-sm {
        font-size: 15px !important;
        padding: 8px 16px !important;
        line-height: 1.4;
    }

    .btn-primary, .btn-success, .btn-danger {
        font-weight: bold;
    }
    </style>
@stop

@section('content')

<!-- Modal لإضافة طلب توثيق -->
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.verification.users.store') }}" method="POST" id="form_add">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">إضافة طلب توثيق جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>اسم المستخدم</label>
                        <input name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>البريد الإلكتروني</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>رقم البطاقة</label>
                        <input name="id_card_number" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>الحالة</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">قيد الانتظار</option>
                            <option value="approved">موثق</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal لتعديل الطلب -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-user-form" method="POST">
                @csrf
                <input type="hidden" id="edit_verification_id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل طلب التوثيق</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>اسم المستخدم</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>البريد الإلكتروني</label>
                        <input type="email" id="edit_email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>رقم البطاقة</label>
                        <input type="text" id="edit_id_card_number" name="id_card_number" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>الحالة</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="pending">قيد الانتظار</option>
                            <option value="approved">موثق</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>طلبات توثيق العملاء</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="search_name" class="form-control" placeholder="اسم العميل">
            </div>
            <div class="col-md-4">
                <input type="text" id="search_email" class="form-control" placeholder="البريد الإلكتروني">
            </div>
            <div class="col-md-4">
                <select id="search_status" class="form-control">
                    <option value="">-- الحالة --</option>
                    <option value="pending">قيد الانتظار</option>
                    <option value="approved">موثق</option>
                    <option value="rejected">مرفوض</option>
                </select>
            </div>
        </div>

        <div class="table-responsive">
            <table id="verifications-table" class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>رقم البطاقة</th>
                        <th>الحالة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        let table = $('#verifications-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.verification.freelancers.getdata") }}',
                data: function (d) {
                    d.name = $('#search_name').val();
                    d.email = $('#search_email').val();
                    d.status = $('#search_status').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'freelancer_name', name: 'freelancer.name' },
                { data: 'email', name: 'freelancer.email' },
                { data: 'id_card_number', name: 'id_card_number' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
            language: {
                url: "{{ asset('datatable_custom/i18n/ar.json') }}"
            }
        });

        $('#search_name, #search_email, #search_status').on('change keyup', function () {
            table.draw();
        });

        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            if (confirm('هل أنت متأكد من الحذف؟')) {
                $.post('{{ route("admin.verification.freelancers.delete") }}', {
                    id: id,
                    _token: '{{ csrf_token() }}'
                }, function (data) {
                    alert(data.success);
                    table.draw();
                });
            }
        });

        $(document).on('click', '.edit-btn', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let card = $(this).data('card');
            let status = $(this).data('status');

            $('#edit_verification_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
            $('#edit_id_card_number').val(card);
            $('#edit_status').val(status);

            $('#edit-modal').modal('show');
        });
    });
</script>
@endsection
