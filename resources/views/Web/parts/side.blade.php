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
            --sidebar-bg: #2c3e50;
            --sidebar-hover: #34495e;
          
        }

                /* الشريط الجانبي */
        .profile-sidebar {
            width: 300px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, #4a6491 100%);
            color: white;
            transition: all 0.4s ease;
            height: fit-content;
            flex-shrink: 0;
        }

        .profile-sidebar:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .sidebar-card {
            padding: 0;
        }

        .sidebar-title {
            background: rgba(0, 0, 0, 0.25);
            padding: 25px;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar-title i {
            font-size: 1.4rem;
            color: #3498db;
        }

        .sidebar-menu {
            list-style: none;
            padding: 15px 0;
        }

        .sidebar-menu li {
            margin: 8px 15px;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }

        .sidebar-menu li:before {
            content: '';
            position: absolute;
            right: -8px;
            top: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, #3498db, #2ecc71);
            opacity: 0;
            transition: all 0.4s ease;
            border-radius: 4px 0 0 4px;
        }

        .sidebar-menu li:hover:before {
            right: 0;
            opacity: 1;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 16px 22px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            gap: 18px;
            font-size: 1.05rem;
            border-radius: 12px;
        }

        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            padding-right: 28px;
            transform: translateX(-5px);
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.2) 0%, rgba(46, 204, 113, 0.2) 100%);
            color: #fff;
            padding-right: 28px;
            box-shadow: inset 4px 0 12px rgba(52, 152, 219, 0.3);
        }

        .sidebar-menu a.active:before {
            right: 0;
            opacity: 1;
        }

        .sidebar-menu a i {
            width: 24px;
            text-align: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover i {
            transform: scale(1.3);
            color: #3498db;
        }

        .sidebar-menu a.active i {
            color: #3498db;
            filter: drop-shadow(0 0 5px rgba(52, 152, 219, 0.5));
        }

        /* تأثيرات للعناصر المختلفة */
        .sidebar-menu li:nth-child(1) a i { color: #1abc9c; }
        .sidebar-menu li:nth-child(2) a i { color: #e74c3c; }
        .sidebar-menu li:nth-child(3) a i { color: #f39c12; }
        .sidebar-menu li:nth-child(4) a i { color: #e84393; }
        .sidebar-menu li:nth-child(5) a i { color: #9b59b6; }
        .sidebar-menu li:nth-child(6) a i { color: #3498db; }
        .sidebar-menu li:nth-child(7) a i { color: #7f8c8d; }

    </style>
    <!-- الشريط الجانبي -->
        <div class="profile-sidebar">
            <div class="sidebar-card">
                <h3 class="sidebar-title"><i class="fas fa-bars"></i> القائمة الرئيسية</h3>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('web.dashboard') }}" class="active"><i class="fas fa-user-circle"></i> الملف الشخصي</a></li>
                    <li><a href="{{ route('web.projects.index') }}"><i class="fas fa-project-diagram"></i> مشاريعي</a></li>
                    <li><a href="#"><i class="fas fa-comments"></i> المحادثات</a></li>
                    <li><a href="#"><i class="fas fa-heart"></i> المشاريع المفضلة</a></li>
                    <li><a href="#"><i class="fas fa-bell"></i> الإشعارات</a></li>
                    <li><a href="#"><i class="fas fa-cog"></i> الإعدادات</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a></li>
                </ul>
            </div>
        </div>

            <script>
        // إضافة تفاعلية للقوائم
        document.querySelectorAll('.sidebar-menu a').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // إزالة النشاط من جميع العناصر
                document.querySelectorAll('.sidebar-menu a').forEach(link => {
                    link.classList.remove('active');
                });
                
                // إضافة النشاط للعنصر الحالي
                this.classList.add('active');
            });
        });
    </script>
    </body>
</html>