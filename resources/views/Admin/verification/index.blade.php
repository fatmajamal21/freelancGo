@extends('admin.master')

@section('title', 'توثيق الهوية - العملاء والفريلانسرز')

@section('css')
<style>
    table.simple-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table.simple-table th,
    table.simple-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        vertical-align: middle;
    }

    table.simple-table th {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    .btn-toggle {
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 4px;
        border: none;
        color: #fff;
    }

    .btn-approve {
        background-color: #28a745;
    }

    .btn-reject {
        background-color: #dc3545;
    }

    h4.section-title {
        margin-top: 30px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }
        .btn-sm {
        font-size: 20px !important;
        padding: 8px 16px !important;
        line-height: 1.4;
    }

    .btn-primary, .btn-success, .btn-danger {
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h4 class="section-title">توثيق المستخدمين</h4>
    <table class="simple-table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>رقم البطاقة</th>
                <th>الحالة</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userRequests as $user)
            <tr>
                <td>{{ $user->user->name ?? '-' }}</td>
                <td>{{ $user->id_card_number }}</td>
                <td class="status-cell">{{ $user->status }}</td>
                <td>
                    <button class="btn-toggle {{ $user->status === 'approved' ? 'btn-reject' : 'btn-approve' }} toggle-status"
                            data-id="{{ $user->id }}"
                            data-type="user">
                        {{ $user->status === 'approved' ? 'إلغاء التوثيق' : 'توثيق' }}
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="section-title">توثيق الفريلانسرز</h4>
    <table class="simple-table">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>رقم البطاقة</th>
                <th>الحالة</th>
                <th>الإجراء</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($freelancerRequests as $freelancer)
            <tr>
                <td>{{ $freelancer->freelancer->fullname ?? '-' }}</td>
                <td>{{ $freelancer->id_card_number }}</td>
                <td class="status-cell">{{ $freelancer->status }}</td>
                <td>
                    <button class="btn-toggle {{ $freelancer->status === 'approved' ? 'btn-reject' : 'btn-approve' }} toggle-status"
                            data-id="{{ $freelancer->id }}"
                            data-type="freelancer">
                        {{ $freelancer->status === 'approved' ? 'إلغاء التوثيق' : 'توثيق' }}
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.toggle-status', function () {
        const button = $(this);
        const id = button.data('id');
        const type = button.data('type');

        $.ajax({
            url: '{{ route("admin.verifications.toggle") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                type: type
            },
            success: function (response) {
                const newStatus = response.status;
                const row = button.closest('tr');
                row.find('.status-cell').text(newStatus);
                button.text(newStatus === 'approved' ? 'إلغاء التوثيق' : 'توثيق');
                button.removeClass('btn-approve btn-reject')
                      .addClass(newStatus === 'approved' ? 'btn-reject' : 'btn-approve');
            },
            error: function () {
                alert('حدث خطأ أثناء تحديث الحالة');
            }
        });
    });
</script>
@endsection