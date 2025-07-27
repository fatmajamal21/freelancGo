<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعيين كلمة مرور جديدة - FreelanGo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/pages.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.rtl.min.css">

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
                    <i class="fas fa-lock"></i>
                </div>
                <h1>تعيين كلمة مرور جديدة</h1>
                <p>من فضلك أدخل كلمة مرور جديدة لحسابك. تأكد من أنها آمنة وسهلة التذكر</p>
            </div>
            
            <form method="POST" action="{{ route('admin.password.update') }}" id="resetForm" class="reset-form">
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> كلمة المرور الجديدة</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" class="form-control" placeholder="أدخل كلمة مرور جديدة" required>
                        <span class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    
                    <div class="password-strength">
                        <div class="password-strength-meter" id="passwordStrength"></div>
                    </div>
                    
                    <div class="password-rules">
                        <p>يجب أن تحتوي كلمة المرور على:</p>
                        <ul>
                            <li id="rule-length"><i class="fas fa-circle"></i> 8 أحرف على الأقل</li>
                            <li id="rule-uppercase"><i class="fas fa-circle"></i> حرف كبير واحد على الأقل</li>
                            <li id="rule-number"><i class="fas fa-circle"></i> رقم واحد على الأقل</li>
                            <li id="rule-special"><i class="fas fa-circle"></i> رمز خاص واحد على الأقل</li>
                        </ul>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword"><i class="fas fa-lock"></i> تأكيد كلمة المرور</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirmPassword" class="form-control" placeholder="أعد إدخال كلمة المرور الجديدة" required>
                        <span class="password-toggle" id="confirmPasswordToggle">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <div id="passwordMatch" class="password-rules" style="display:none;">
                        <p><i class="fas fa-check-circle valid"></i> كلمتا المرور متطابقتان</p>
                    </div>
                </div>
                
                <button type="submit" class="btn-reset" id="resetBtn">
                    <i class="fas fa-key"></i> تعيين كلمة المرور الجديدة
                    <i class="fas fa-spinner fa-spin"></i>
                    <i class="fas fa-check"></i>
                </button>
                
                <div class="success-message" id="successMessage">
                    <i class="fas fa-check-circle"></i>
                    <h3>تم تحديث كلمة المرور بنجاح!</h3>
                    <p>تم تحديث كلمة المرور الخاصة بحسابك بنجاح. يمكنك الآن تسجيل الدخول باستخدام كلمة المرور الجديدة.</p>
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
    <script src="../js/reset-password.js"></script>
</body>
</html>