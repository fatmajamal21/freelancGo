<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فريلانقو | الملف الشخصي</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #7212df;
            --primary-hover: #8c3ee4;
            --primary-dark: #5e0eb5;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --bg-light: #f8f9fa;
            --border-color: #e0e0e0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7f9 0%, #e4e8eb 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .main-container {
            display: flex;
            max-width: 1400px;
            width: 100%;
            gap: 30px;
            justify-content: center;
        }

        /* المحتوى الرئيسي */
        .profile-content {
            flex: 1;
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 800px;
        }

        .profile-header {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
            justify-content: center;
        }

        .profile-image-container {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            box-shadow: 0 5px 15px rgba(114, 18, 223, 0.3);
        }

        .verified-badge {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .profile-info {
            flex: 1;
            min-width: 250px;
            text-align: center;
        }

        .profile-name {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .verified-text {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .profile-email {
            color: var(--text-light);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .profile-stats-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }

        .profile-stats {
            display: flex;
            gap: 30px;
            justify-content: center;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            border-radius: 15px;
            background: var(--bg-light);
            min-width: 100px;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-value.completed {
            color: #27ae60;
        }

        .stat-value.in-progress {
            color: #f39c12;
        }

        .stat-value.cancelled {
            color: #e74c3c;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .btn-edit-container {
            display: flex;
            justify-content: center;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(114, 18, 223, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(114, 18, 223, 0.4);
        }

        .profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .detail-card {
            background: var(--bg-light);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .detail-label {
            color: var(--text-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-value {
            color: var(--text-light);
        }

        .project-desc {
            line-height: 1.8;
            color: var(--text-light);
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* تصميم المودال */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            border: none;
        }

        .btn-close {
            filter: invert(1);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(114, 18, 223, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
        }

        /* تصميم متجاوب */
        @media (max-width: 1200px) {
            .main-container {
                flex-direction: column;
                align-items: center;
            }
        }

        @media (max-width: 992px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .profile-stats {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .profile-content {
                padding: 20px;
            }
            
            .profile-details {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .profile-stats {
                flex-direction: column;
                align-items: center;
            }
            
            .stat-item {
                width: 100%;
                max-width: 200px;
            }
            
            .profile-name {
                font-size: 1.5rem;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- الشريط الجانبي -->
        @include('web.parts.side')

        <!-- المحتوى الرئيسي -->
        <div class="profile-content">
            <!-- المودال -->
            <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">تعديل الملف الشخصي</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="form_edit" id="form_edit" enctype="multipart/form-data"
                            action="{{ route('web.profile.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $user->id }}" class="form-control">

                            <div class="mb-2 form-group">
                                <label class="form-label">@lang(' الاسم الكامل')</label>
                                <input id="edit_name" placeholder="@lang('الاسم الكامل')" name="fullname" class="form-control"
                                    type="text" value="{{ $user->fullname }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="form-label">@lang(' اسم المستخدم ')</label>
                                <input id="edit_username" placeholder="@lang('اسم المستخدم')" name="username" class="form-control"
                                    type="text" value="{{ $user->username }}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2 form-group">
                                <label class="form-label">@lang(' البريد الالكتروني ')</label>
                                <input id="edit_email" placeholder="@lang('البريد الالكتروني ')" name="email" class="form-control"
                                    type="text" value="{{ $user->email }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="form-label">@lang('الدولة')</label>
                                <select id="edit_country" name="country" class="form-control">
                                    <option selected disabled> اختر الدولة </option>
                                    @foreach ($countries as $c)
                                        <option {{ $c->id == $user->country_id ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->name_ar }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-2 form-group">
                                <label class="form-label">@lang('رقم الهاتف ')<span> "بدون مقدمة الدولة"</span></label>
                                <input id="edit_phone" placeholder="@lang(' رقم الهاتف ')" name="phone" class="form-control" value="{{ $user->phone }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-2 form-group">
                                <label class="form-label">@lang('النبذة الشخصية  ')</label>
                                <textarea id="edit_bio" placeholder="@lang('النبذة الشخصية  ')" name="bio" class="form-control">{{ $user->bio }}</textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="modal-footer d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">@lang('اغلاق')</button>
                                <button type="submit" style="background-color: #7212df"
                                    class="btn text-white">@lang('تعديل')</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile-header">
                <div class="profile-image-container">
                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://randomuser.me/api/portraits/men/32.jpg' }}" alt="صورة العميل" class="profile-image">
                    @if($user->is_verified_id_card)
                    <div class="verified-badge">
                        <i class="fas fa-check"></i>
                    </div>
                    @endif
                </div>

                <div class="profile-info">
                    <h2 class="profile-name">
                        {{ $user->fullname }}
                        @if($user->is_verified_id_card)
                        <span class="verified-text">
                            <i class="fas fa-check-circle"></i> موثق
                        </span>
                        @else
                        <span class="verified-text" style="background: #e74c3c;">
                            <i class="fas fa-times-circle"></i> غير موثق
                        </span>
                        @endif
                    </h2>
                    <p class="profile-email"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                </div>

                <!-- التعديل الجديد: إحصائيات وزر التعديل في أسفل المكون -->
                <div class="profile-stats-container">
                    <div class="profile-stats">
                        {{-- <div class="stat-item">
                            <div class="stat-value completed">{{ $completed_projects ?? 24 }}</div>
                            <div class="stat-label">مكتملة</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value in-progress">{{ $in_progress_projects ?? 5 }}</div>
                            <div class="stat-label">قيد التنفيذ</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value cancelled">{{ $cancelled_projects ?? 3 }}</div>
                            <div class="stat-label">ملغية</div>
                        </div>
                    </div> --}}

                    <div class="btn-edit-container">
                        <button type="button" class="btn-edit" data-bs-toggle="modal" data-bs-target="#edit-modal">
                            <i class="fas fa-edit"></i> تعديل الملف الشخصي
                        </button>
                    </div>
                </div>
            </div>

        
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // عند تحميل الصفحة، تعبئة بيانات النموذج
        document.addEventListener('DOMContentLoaded', function() {
            // تعبئة بيانات النموذج إذا كانت موجودة
            @if(isset($user))
            document.getElementById('edit_name').value = "{{ $user->fullname }}";
            document.getElementById('edit_username').value = "{{ $user->username }}";
            document.getElementById('edit_email').value = "{{ $user->email }}";
            document.getElementById('edit_phone').value = "{{ $user->phone }}";
            document.getElementById('edit_bio').value = "{{ $user->bio }}";
            @endif
        });

        // إضافة تفاعلية للنموذج
        document.getElementById('form_edit').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // هنا يمكنك إضافة كود AJAX لإرسال البيانات
            console.log('تم تقديم النموذج');
            
            // عرض رسالة نجاح (يمكن استبدالها برسالة حقيقية)
            alert('تم تحديث الملف الشخصي بنجاح!');
        });
    </script>
</body>
</html>