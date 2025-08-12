@extends('admin.master')

@section('title', 'لوحة تحكم فريلانقو | قسم المستخدمين')

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

{{-- Create Role Form --}}
<div class="row">
    <div class="col-12">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">@lang('التصفية')</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <form class="form_add" action="{{ route('admin.role.store') }}" id="form_add" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('اسم الدور')</label>
                            <input placeholder="@lang('اسم الدور')" name="name" class="form-control" type="text">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-2 form-group">
                            <label class="form-label">@lang('مستحق الصلاحية')</label>
                            <select name="guard" class="form-control">
                                <option disabled selected>حدد المستحق</option>
                                @foreach ($guards as $key => $value)
                                    <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2 form-group">
                            <h5 style="display:inline-block">@lang('  الصلاحيات و الأذونات')</h5>
                            @foreach ($permissions as $guard => $perms)
                                <h4 style="display:inline-block ; color: #e82424;">{{ __($guard) }}</h4>
                                @foreach ($perms as $perm)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="perm-{{ $perm->id }}">
                                        <label class="form-check-label" for="perm-{{ $perm->id }}">{{ $perm->description }}</label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <div class="my-3 d-flex gap-2">
                            <button type="submit" id="create_btn" style="background-color: #7212df" class="btn text-white col-6">@lang('إنشاء')</button>
                            <button id="clear_btn" class="btn btn-secondary col-6" type="button"><i class="fa fa-undo"></i> @lang('إعادة تهيئة')</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- DataTable --}}
<div class="row">
    <div class="col-12 col-lg-12 col-xl-12 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <h5 class="mb-0">@lang('الأدوار')</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>@lang('اسم الدور')</th>
                                <th>@lang('مستحق الصلاحية')</th>
                                <th>@lang('الصلاحيات والأذونات')</th>
                                <th>@lang('الإجراءات')</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Role Modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">@lang('تعديل الدور')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    @csrf
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">@lang('اسم الدور')</label>
                        <input type="text" class="form-control" id="edit-name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="edit-guard" class="form-label">@lang('مستحق الصلاحية')</label>
                        <select id="edit-guard" name="guard" class="form-control">
                            @foreach ($guards as $key => $value)
                                <option value="{{ $value }}">{{ $key }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-permissions" class="form-label">@lang('الصلاحيات')</label>
                        @foreach ($permissions as $guard => $perms)
                            <h4>{{ __($guard) }}</h4>
                            @foreach ($perms as $perm)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->id }}" id="edit-perm-{{ $perm->id }}">
                                    <label class="form-check-label" for="edit-perm-{{ $perm->id }}">{{ $perm->description }}</label>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <input type="hidden" id="edit-id" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('إغلاق')</button>
                <button type="submit" id="edit-submit" class="btn btn-primary">@lang('تحديث')</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    $(document).ready(function () {
        // Initialize DataTable
        window.table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("admin.role.getdata") }}',
                data: function (d) {
                    d.name = $('#search_name').val();
                    d.guard = $('#search_guard').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'guard', name: 'guard' },
                { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
                {
                    data: null, render: function (data, type, row) {
                        return `
                           <div class="d-flex gap-3">
                            <a class="text-warning edit-btn"data-id="${row.id}" data-name="${row.name}" data-guard="${row.guard_name}" data-permissions="${row.permissions}">
                                 <i class="bi bi-pencil-fill"></i> تعديل
                            </a>
                         <a  class="text-danger delete-btn"  data-id="${row.id}">
                                @lang('حذف')
                            </a>   </div>`;
                    }
                },
            ],
            language: {
                url: "{{ asset('datatable_custom/i18n/ar.json') }}"
            }
        });

        // Edit button click handler
        $(document).on('click', '.edit-btn', function () {
            var roleId = $(this).data('id');
            var roleName = $(this).data('name');
            var guard = $(this).data('guard');
            var permissions = $(this).data('permissions').split(',');

            $('#edit-id').val(roleId);
            $('#edit-name').val(roleName);
            $('#edit-guard').val(guard);

            // Check selected permissions
            $('#edit-permissions input[type="checkbox"]').each(function () {
                if (permissions.includes($(this).val())) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            });

            // Show the modal
            $('#editModal').modal('show');
        });

        // Edit form submission
        $('#edit-submit').on('click', function () {
            var formData = $('#edit-form').serialize();
            $.ajax({
                url: '{{ route("admin.role.update") }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    $('#editModal').modal('hide');
                    table.draw();
                }
            });
        });

        // Delete button click handler
        $(document).on('click', '.delete-btn', function () {
            var roleId = $(this).data('id');
            if (confirm('@lang("هل أنت متأكد من حذف هذا الدور؟")')) {
                $.ajax({
                    url: '{{ route("admin.role.delete") }}',
                    type: 'POST',
                    data: {
                        id: roleId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        table.draw();
                    }
                });
            }
        });
    });
</script>
@stop
