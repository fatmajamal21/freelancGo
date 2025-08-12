@extends('admin.master')

@section('title', 'لوحة تحكم | المشاريع')

@section('css')
    <style>
        .dataTables_wrapper {
            overflow-x: auto;
        }
    </style>
@stop

@section('content')

<!-- Add Project Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مشروع جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 mb-3">
                    <label>العنوان</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>المستخدم</label>
                    <select name="user_id" class="form-control" required>
                        @foreach(App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>الميزانية</label>
                    <input type="number" step="0.01" name="budget" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>المدة</label>
                    <input type="text" name="duration" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>الحالة</label>
                    <select name="status" class="form-control">
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>الموعد النهائي</label>
                    <input type="date" name="deadline" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>الوصف</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">إضافة</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </form>
  </div>
</div>
<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="editProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('admin.projects.update') }}">
        @csrf
        <input type="hidden" name="id" id="edit_id">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل المشروع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row">
                <div class="col-md-6 mb-3">
                    <label>العنوان</label>
                    <input type="text" name="title" id="edit_title" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>المستخدم</label>
                    <select name="user_id" id="edit_user_id" class="form-control" required>
                        @foreach(App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>الميزانية</label>
                    <input type="number" step="0.01" name="budget" id="edit_budget" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>المدة</label>
                    <input type="text" name="duration" id="edit_duration" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>الحالة</label>
                    <select name="status" id="edit_status" class="form-control">
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>الموعد النهائي</label>
                    <input type="date" name="deadline" id="edit_deadline" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>الوصف</label>
                    <textarea name="description" id="edit_description" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">تحديث</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </form>
  </div>
</div>
<!-- Modal لعرض بيانات المشروع -->
<div class="modal fade" id="viewProjectModal" tabindex="-1" aria-labelledby="viewProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProjectModalLabel">تفاصيل المشروع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>العنوان:</strong> <span id="view_title"></span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>المستخدم:</strong> <span id="view_user"></span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>الميزانية:</strong> <span id="view_budget"></span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>المدة:</strong> <span id="view_duration"></span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>الحالة:</strong> <span id="view_status"></span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>الموعد النهائي:</strong> <span id="view_deadline"></span>
                    </div>
                    <div class="col-md-12">
                        <strong>الوصف:</strong>
                        <p id="view_description" class="mt-2"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-0">المشاريع</h5>
                    </div>
                    <div class="col-md-6 text-end">
                        <a data-bs-toggle="modal" data-bs-target="#addProjectModal" class="btn btn-primary btn-lg text-white">
                            + إضافة مشروع
                        </a>
                    </div>
                </div>

                {{-- أزرار الفلترة --}}
                <div class="mt-4 text-center">
                    <div class="btn-group flex-wrap d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-dark px-4 py-2 {{ request('status') == null ? 'active' : '' }}">الكل</a>
                        <a href="{{ route('admin.projects.index', ['status' => 'open']) }}" class="btn btn-outline-primary px-4 py-2 {{ request('status') == 'open' ? 'active' : '' }}">مفتوح</a>
                        <a href="{{ route('admin.projects.index', ['status' => 'in_progress']) }}" class="btn btn-outline-warning px-4 py-2 {{ request('status') == 'in_progress' ? 'active' : '' }}">قيد التنفيذ</a>
                        <a href="{{ route('admin.projects.index', ['status' => 'completed']) }}" class="btn btn-outline-success px-4 py-2 {{ request('status') == 'completed' ? 'active' : '' }}">مكتمل</a>
                        <a href="{{ route('admin.projects.index', ['status' => 'cancelled']) }}" class="btn btn-outline-danger px-4 py-2 {{ request('status') == 'cancelled' ? 'active' : '' }}">ملغي</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="projects-table" class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>العنوان</th>
                                <th>المستخدم</th>
                                <th>الميزانية</th>
                                <th>الحالة</th>
                                <th>الموعد النهائي</th>
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
        window.table = $('#projects-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.projects.getdata") }}',
                data: function (d) {
                    d.status = '{{ request()->get("status") }}'; // 👈 إرسال قيمة الحالة (status) من الـ URL
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'user', name: 'user' },
                { data: 'budget', name: 'budget' },
                { data: 'status', name: 'status' },
                { data: 'deadline', name: 'deadline' },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ],
            language: {
                url: "{{ asset('datatable_custom/i18n/ar.json') }}"
            }
        });
    });

        function viewProject(data) {
        $('#view_title').text(data.title);
        $('#view_user').text(data.user_id);
        $('#view_budget').text(data.budget);
        $('#view_duration').text(data.duration);
        $('#view_status').text(data.status);
        $('#view_deadline').text(data.deadline);
        $('#view_description').text(data.description);
        new bootstrap.Modal(document.getElementById('viewProjectModal')).show();
    }
 
    function editProject(data) {
        $('#edit_id').val(data.id);
        $('#edit_title').val(data.title);
        $('#edit_user_id').val(data.user_id);
        $('#edit_budget').val(data.budget);
        $('#edit_duration').val(data.duration);
        $('#edit_status').val(data.status);
        $('#edit_deadline').val(data.deadline);
        $('#edit_description').val(data.description);
        new bootstrap.Modal(document.getElementById('editProjectModal')).show();
    }

    function deleteProject(id) {
        if (confirm('هل أنت متأكد من حذف هذا المشروع؟')) {
            $.ajax({
                type: 'POST',
                url: '{{ route("admin.projects.delete") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function () {
                    window.table.ajax.reload();
                },
                error: function () {
                    alert('حدث خطأ أثناء عملية الحذف');
                }
            });
        }
    }
    function viewProjectById(id) {
    $.ajax({
        url: '{{ route("admin.projects.show") }}',
        method: 'GET',
        data: { id: id },
        success: function (response) {
            const data = response.data;
            $('#view_title').text(data.title);
            $('#view_user').text(data.user?.name ?? '—');
            $('#view_budget').text(data.budget);
            $('#view_duration').text(data.duration);
            $('#view_status').text(data.status);
            $('#view_deadline').text(data.deadline);
            $('#view_description').text(data.description);
            new bootstrap.Modal(document.getElementById('viewProjectModal')).show();
        },
        error: function () {
            alert('فشل في تحميل البيانات');
        }
    });
}

</script>

@endsection
