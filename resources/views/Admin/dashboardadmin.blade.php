@extends('admin.master')

@section('title', 'لوحة تحكم الأدمن')

@section('content')
<div class="container mt-4">
    <div class="row">


        <!-- الإداريين -->
<div class="col-md-3">
    <div class="card text-white" style="background-color:#6610f2;">
        <div class="card-header fs-5 fw-bold">الإداريين</div>
        <div class="card-body">
            <h5 class="card-title">{{ $adminsCount }}</h5>
            <p class="card-text">إجمالي عدد الأمن (الإداريين)</p>
        </div>
    </div>
</div>

        <!-- العملاء -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#007bff;">
                <div class="card-header fs-5 fw-bold">العملاء</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $usersCount }}</h5>
                    <p class="card-text">إجمالي عدد العملاء</p>
                </div>
            </div>
        </div>

        <!-- الفريلانسر -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#28a745;">
                <div class="card-header fs-5 fw-bold">الفريلانسر</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $freelancersCount }}</h5>
                    <p class="card-text">إجمالي عدد الفريلانسر</p>
                </div>
            </div>
        </div>

        <!-- المشاريع -->
        <div class="col-md-3">
            <div class="card text-dark" style="background-color:#ffc107;">
                <div class="card-header fs-5 fw-bold text-white">المشاريع</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $projectsCount }}</h5>
                    <p class="card-text">إجمالي المشاريع المُسجلة</p>
                </div>
            </div>
        </div>

        {{-- <!-- التوثيق -->
        {{-- <div class="col-md-3">
            <div class="card text-white" style="background-color:#343a40;">
                <div class="card-header fs-5 fw-bold">طلبات التوثيق</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $verificationsCount }}</h5>
                    <p class="card-text">طلبات توثيق الهوية</p>
                </div>
            </div>
        </div> --}} 

        <!-- طلبات التوثيق المفصلة -->
<div class="row mt-4">

    <!-- توثيق العملاء -->
    <div class="col-md-6">
        <div class="card text-white" style="background-color:#17a2b8;">
            <div class="card-header fs-5 fw-bold">توثيق العملاء</div>
            <div class="card-body text-center">
                <h4>{{ $verificationsUsersCount }}</h4>
                <p>عدد طلبات توثيق العملاء</p>
            </div>
        </div>
    </div>

    <!-- توثيق الفريلانسر -->
    <div class="col-md-6">
        <div class="card text-white" style="background-color:#20c997;">
            <div class="card-header fs-5 fw-bold">توثيق الفريلانسر</div>
            <div class="card-body text-center">
                <h4>{{ $verificationsFreelancersCount }}</h4>
                <p>عدد طلبات توثيق الفريلانسر</p>
            </div>
        </div>
    </div>

</div>



    </div>

    <!-- المشاريع حسب الحالة -->
    <div class="row mt-4">

        <!-- مكتملة -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#6f42c1;">
                <div class="card-header fs-5 fw-bold">مكتملة</div>
                <div class="card-body text-center">
                    <h4>{{ $completedProjects }}</h4>
                    <p>المشاريع المكتملة</p>
                </div>
            </div>
        </div>

        <!-- قيد التنفيذ -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#343a40;">
                <div class="card-header fs-5 fw-bold">قيد التنفيذ</div>
                <div class="card-body text-center">
                    <h4>{{ $inProgressProjects }}</h4>
                    <p>مشاريع قيد التنفيذ</p>
                </div>
            </div>
        </div>

        <!-- مفتوحة -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#007bff;">
                <div class="card-header fs-5 fw-bold">مفتوحة</div>
                <div class="card-body text-center">
                    <h4>{{ $openProjects }}</h4>
                    <p>المشاريع المفتوحة</p>
                </div>
            </div>
        </div>

        <!-- ملغاة -->
        <div class="col-md-3">
            <div class="card text-white" style="background-color:#dc3545;">
                <div class="card-header fs-5 fw-bold">ملغاة</div>
                <div class="card-body text-center">
                    <h4>{{ $cancelledProjects }}</h4>
                    <p>المشاريع الملغاة</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
