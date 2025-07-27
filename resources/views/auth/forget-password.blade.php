<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعادة كلمة المرور - FreelanGo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.rtl.min.css">
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/pages.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <i class="fas fa-rocket"></i> FreelanGo
            </div>
            
            <div class="navbar-content">
                <ul class="navbar-links">
                    <li><a href="index.html"><i class="fas fa-home"></i> الرئيسية</a></li>
                    <li><a href="projects.html"><i class="fas fa-project-diagram"></i> المشاريع</a></li>
                    <li><a href="about.html"><i class="fas fa-info-circle"></i> عن المنصة</a></li>
                    <li><a href="contact.html"><i class="fas fa-envelope"></i> اتصل بنا</a></li>
                </ul>
            </div>
            
            <div class="navbar-actions">
                <a href="login.html" class="btn-apply"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</a>
            </div>
        </div>
    </nav>
    
    <section class="reset-section">
        <div class="reset-container">
            <div class="reset-header">
                <div class="reset-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1>استعادة كلمة المرور</h1>
                <p>أدخل بريدك الإلكتروني المسجل وسنرسل لك رابطًا لاستعادة كلمة المرور الخاصة بك</p>
            </div>
            
            <form method="POST" action="{{ route('admin.password.email') }}" id="resetForm" class="reset-form">
                    @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> البريد الإلكتروني</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" class="form-control" placeholder="ادخل بريدك الإلكتروني" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-reset" id="resetBtn">
                    <i class="fas fa-paper-plane"></i> إرسال رابط الاستعادة
                    <i class="fas fa-spinner fa-spin"></i>
                    <i class="fas fa-check"></i>
                </button>
                
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <h3>تم إرسال رابط الاستعادة بنجاح!</h3>
                    <p>لقد أرسلنا رابطًا لاستعادة كلمة المرور إلى بريدك الإلكتروني. يرجى التحقق من صندوق الوارد.</p>
                </div>
            </form>
            
            <div class="links-container">
                <a href="login.html"><i class="fas fa-arrow-left"></i> العودة لتسجيل الدخول</a>
                <a href="register.html"><i class="fas fa-user-plus"></i> إنشاء حساب جديد</a>
            </div>
        </div>
    </section>
    
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>عن FreelanGo</h3>
                    <p>منصة عربية تربط بين أصحاب المشاريع والمحترفين المستقلين لتنفيذ الأعمال بكفاءة وابتكارية.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>روابط سريعة</h3>
                    <ul class="footer-links">
                        <li><a href="index.html"><i class="fas fa-chevron-left"></i> الرئيسية</a></li>
                        <li><a href="projects.html"><i class="fas fa-chevron-left"></i> المشاريع</a></li>
                        <li><a href="how-it-works.html"><i class="fas fa-chevron-left"></i> كيف تعمل المنصة</a></li>
                        <li><a href="pricing.html"><i class="fas fa-chevron-left"></i> الأسعار</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>الدعم والمساعدة</h3>
                    <ul class="footer-links">
                        <li><a href="faq.html"><i class="fas fa-chevron-left"></i> الأسئلة الشائعة</a></li>
                        <li><a href="support.html"><i class="fas fa-chevron-left"></i> مركز الدعم</a></li>
                        <li><a href="terms.html"><i class="fas fa-chevron-left"></i> الشروط والأحكام</a></li>
                        <li><a href="privacy.html"><i class="fas fa-chevron-left"></i> سياسة الخصوصية</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                © 2023 FreelanGo. جميع الحقوق محفوظة.
            </div>
        </div>
    </footer>
    <script src="../js/forgot-password.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>