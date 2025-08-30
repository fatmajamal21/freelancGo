{{--مرحبا فريلانسر اهليين !!

<form method="POST" action="{{ route($guard . '.logout') }}">
      @csrf
      <button type="submit">تسجيل الخروج</button>
</form>--}}


@extends('master')
@section('title', 'المستقلين |  الملف الشخصي')
@section('content')



<div class="profile-layout">

  @include('freelancer.part.side')
    <!-- محتوى الصفحة -->
    <div class="profile-content">
        <div class="profile-header">
            <div class="profile-image-container">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="صورة الفريلانسر" class="profile-image">
                <div class="verified-badge">
                    <i class="fas fa-check"></i>
                </div>
            </div>

            <div style="color:#333 " class="profile-info">
                <h2 class="profile-name">
                    {{ $freelancer->fullname }}
                    <span class="verified-text">
                        <i class="fas fa-check-circle"></i> {{ $freelancer->is_verified_id_card ? 'موثق' : 'غير موثق' }}
                    </span>
                </h2>
                <p class="profile-email"><i class="fas fa-envelope"></i> {{ $freelancer->email }}</p>
                <p class="profile-username"><i class="fas fa-user"></i> {{ $freelancer->username }}</p>
            </div>

            <!-- إحصائيات وزر التعديل -->
            <div class="profile-stats-container">
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value completed">{{ $freelancer->completed_projects }}</div>
                        <div class="stat-label">مكتملة</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value in-progress">5</div>
                        <div class="stat-label">قيد التنفيذ</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value cancelled">3</div>
                        <div class="stat-label">ملغية</div>
                    </div>
                </div>

                <div class="btn-edit-container">
                    <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit-modal">
                        <i class="fas fa-edit"></i> تعديل الملف الشخصي
                    </button>
                </div>
            </div>
        </div>

        <div class="profile-details">
            <div class="detail-card">
                <h3 class="card-title"><i class="fas fa-user-circle"></i> المعلومات الشخصية</h3>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-user"></i> الاسم الكامل:</div>
                    <div class="detail-value">{{ $freelancer->fullname }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-at"></i> اسم المستخدم:</div>
                    <div class="detail-value">{{ $freelancer->username }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-calendar"></i> تاريخ الانضمام:</div>
                    <div class="detail-value">{{ $freelancer->registration_date ?? $freelancer->created_at->format('Y-m-d') }}</div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-phone"></i> رقم الهاتف:</div>
                    <div class="detail-value">{{ $freelancer->phone ?? 'غير مضاف' }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-chart-line"></i> الخبرة:</div>
                    <div class="detail-value">
                        @php
                            $experienceLabels = [
                                '0-1' => 'أقل من سنة',
                                '1-3' => 'سنة - 3 سنوات',
                                '3-5' => '3 - 5 سنوات',
                                '5+' => 'أكثر من 5 سنوات'
                            ];
                        @endphp
                        {{ $experienceLabels[$freelancer->experience] ?? $freelancer->experience }}
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <h3 class="card-title"><i class="fas fa-file-alt"></i> الوصف الشخصي</h3>
                <p class="project-desc">{{ $freelancer->bio ?? 'لا يوجد وصف شخصي' }}</p>
            </div>
            
            <div class="detail-card">
                <h3 class="card-title"><i class="fas fa-star"></i> التقييم والإحصائيات</h3>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-star-half-alt"></i> التقييم العام:</div>
                    <div class="detail-value">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($freelancer->rating))
                                <i class="fas fa-star text-warning"></i>
                            @elseif($i == ceil($freelancer->rating) && !is_int($freelancer->rating))
                                <i class="fas fa-star-half-alt text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                        ({{ number_format($freelancer->rating, 1) }})
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-check-circle"></i> المشاريع المكتملة:</div>
                    <div class="detail-value">{{ $freelancer->completed_projects }}</div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-label"><i class="fas fa-coins"></i> نقاط المكافآت:</div>
                    <div class="detail-value">{{ $freelancer->points_balance }} نقطة</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- مودال تعديل الملف الشخصي -->
{{-- <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">تعديل الملف الشخصي</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form_edit" id="form_edit" enctype="multipart/form-data" action="{{ route('web.freelancer.profile.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $freelancer->id }}" class="form-control">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">الاسم الكامل</label>
                            <input id="edit_name" placeholder="الاسم الكامل" name="fullname" class="form-control" type="text" value="{{ $freelancer->fullname }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">اسم المستخدم</label>
                            <input id="edit_username" placeholder="اسم المستخدم" name="username" class="form-control" type="text" value="{{ $freelancer->username }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input id="edit_email" placeholder="البريد الإلكتروني" name="email" class="form-control" type="email" value="{{ $freelancer->email }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input id="edit_phone" placeholder="رقم الهاتف" name="phone" class="form-control" value="{{ $freelancer->phone }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">مستوى الخبرة</label>
                        <select id="edit_experience" name="experience" class="form-control">
                            <option value="0-1" {{ $freelancer->experience == '0-1' ? 'selected' : '' }}>أقل من سنة</option>
                            <option value="1-3" {{ $freelancer->experience == '1-3' ? 'selected' : '' }}>سنة - 3 سنوات</option>
                            <option value="3-5" {{ $freelancer->experience == '3-5' ? 'selected' : '' }}>3 - 5 سنوات</option>
                            <option value="5+" {{ $freelancer->experience == '5+' ? 'selected' : '' }}>أكثر من 5 سنوات</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">النبذة الشخصية</label>
                        <textarea id="edit_bio" placeholder="النبذة الشخصية" name="bio" class="form-control" rows="4">{{ $freelancer->bio }}</textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<style>
    :root {
        --primary-color: #7212df;
        --secondary-color: #f8f9fa;
        --text-color: #333;
        --light-text: #6c757d;
        --border-color: #dee2e6;
        --completed-color: #28a745;
        --progress-color: #ffc107;
        --cancelled-color: #dc3545;
    }
    
    body {
        font-family: 'Tahoma', 'Arial', sans-serif;
        background-color: #f5f7f9;
        color: var(--text-color);
        margin: 0;
        padding: 0;
    }
    
    .profile-layout {
        display: flex;
        min-height: 100vh;
    }
    
    .profile-sidebar {
        width: 280px;
        background: white;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        padding: 20px;
        display: flex;
        flex-direction: column;
    }
    
    .sidebar-header {
        text-align: center;
        padding: 20px 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 20px;
    }
    
    .sidebar-logo {
        font-size: 24px;
        font-weight: bold;
        color: var(--primary-color);
    }
    
    .sidebar-nav {
        flex-grow: 1;
    }
    
    .nav-item {
        padding: 12px 15px;
        border-radius: 8px;
        margin-bottom: 5px;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
    }
    
    .nav-item:hover, .nav-item.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .nav-item i {
        margin-left: 10px;
        width: 20px;
        text-align: center;
    }
    
    .sidebar-footer {
        padding: 15px;
        border-top: 1px solid var(--border-color);
    }
    
    .logout-btn {
        display: block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background: none;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--light-text);
        transition: all 0.3s;
    }
    
    .logout-btn:hover {
        background-color: #f8f9fa;
        color: var(--text-color);
    }
    
    .profile-content {
        flex-grow: 1;
        padding: 30px;
        overflow-y: auto;
    }
    
    .profile-header {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .profile-image-container {
        position: relative;
        margin-left: 25px;
    }
    
    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    .verified-badge {
        position: absolute;
        bottom: 8px;
        right: 8px;
        background: var(--primary-color);
        color: white;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }
    
    .profile-info {
        flex-grow: 1;
        min-width: 250px;
    }
    
    .profile-name {
        font-size: 24px;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    
    .verified-text {
        font-size: 14px;
        margin-right: 12px;
        display: flex;
        align-items: center;
    }
    
    .verified-text i {
        color: var(--primary-color);
        margin-right: 5px;
    }
    
    .profile-email, .profile-username {
        margin: 6px 0;
        color: var(--light-text);
        display: flex;
        align-items: center;
    }
    
    .profile-email i, .profile-username i {
        margin-left: 8px;
        width: 16px;
    }
    
    .profile-stats-container {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        margin-top: 20px;
        width: 100%;
    }
    
    .profile-stats {
        display: flex;
        justify-content: space-around;
        width: 100%;
        margin-bottom: 20px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        background: var(--secondary-color);
        flex: 1;
        margin: 0 10px;
    }
    
    .stat-value {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .stat-value.completed {
        color: var(--completed-color);
    }
    
    .stat-value.in-progress {
        color: var(--progress-color);
    }
    
    .stat-value.cancelled {
        color: var(--cancelled-color);
    }
    
    .stat-label {
        color: var(--light-text);
        font-size: 14px;
    }
    
    .btn-edit-container {
        width: 100%;
        text-align: left;
    }
    
    .btn-edit {
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-edit:hover {
        background: #5e0fc9;
    }
    
    .btn-edit i {
        margin-left: 8px;
    }
    
    .profile-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .card-title {
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
    }
    
    .card-title i {
        margin-left: 10px;
        color: var(--primary-color);
    }
    
    .detail-row {
        display: flex;
        margin-bottom: 15px;
    }
    
    .detail-label {
        flex: 1;
        color: var(--light-text);
        display: flex;
        align-items: center;
    }
    
    .detail-label i {
        margin-left: 8px;
        width: 16px;
    }
    
    .detail-value {
        flex: 2;
        font-weight: 500;
    }
    
    .project-desc {
        line-height: 1.6;
        color: var(--text-color);
    }
    
    @media (max-width: 992px) {
        .profile-layout {
            flex-direction: column;
        }
        
        .profile-sidebar {
            width: 100%;
            order: 2;
        }
        
        .profile-content {
            order: 1;
        }
        
        .profile-header {
            flex-direction: column;
            text-align: center;
        }
        
        .profile-image-container {
            margin: 0 0 20px 0;
        }
        
        .profile-stats {
            flex-direction: column;
            align-items: center;
        }
        
        .stat-item {
            margin: 10px 0;
            width: 80%;
        }
    }
    
    @media (max-width: 576px) {
        .profile-content {
            padding: 15px;
        }
        
        .profile-header {
            padding: 20px 15px;
        }
        
        .detail-row {
            flex-direction: column;
        }
        
        .detail-label, .detail-value {
            flex: auto;
            margin-bottom: 5px;
        }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stop