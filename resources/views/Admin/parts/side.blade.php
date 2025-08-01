<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('admin_assets_rtl/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">منصة العمل الحر</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">

        <!-- المستخدمين -->
        <li class="menu-label">@lang('المستخدمين')</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i></div>
                <div class="menu-title">@lang('أدارة مستخدمين المنصة')</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.admins.index') }}">
                        <i class="bi bi-circle"></i> @lang('الأدمن')
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        <i class="bi bi-circle"></i> @lang('العملاء')
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.freelancers.index') }}">
                        <i class="bi bi-circle"></i> @lang('المستقلون')
                    </a>
                </li>
            </ul>
        </li>

        <!-- طلبات التوثيق -->
        <li class="menu-label">@lang('طلبات التوثيق')</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i></div>
                <div class="menu-title">@lang('طلبات التوثيق')</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.verification.users.index') }}">
                        <i class="bi bi-circle"></i> @lang('توثيق العملاء')
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.verification.freelancers.index') }}">
                        <i class="bi bi-circle"></i> @lang('توثيق المستقلين')
                    </a>
                </li>
            </ul>
        </li>

        <!-- إدارة المشاريع -->
        <li class="menu-label">@lang('إدارة المشاريع')</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-briefcase"></i></div>
                <div class="menu-title">@lang('المشاريع')</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.projects.index') }}">
                        <i class="bi bi-circle"></i> @lang('جميع المشاريع')
                    </a>
                </li>
                {{-- روابط إضافية لاحقًا بعد تعريف روتاتها --}}
                {{-- 
                <li><a href="{{ route('admin.projects.index', ['status' => 'completed']) }}"><i class="bi bi-circle"></i> @lang('المكتملة')</a></li>
                <li><a href="{{ route('admin.projects.index', ['status' => 'late']) }}"><i class="bi bi-circle"></i> @lang('المتأخرة')</a></li>
                <li><a href="{{ route('admin.projects.index', ['status' => 'rejected']) }}"><i class="bi bi-circle"></i> @lang('المرفوضة')</a></li>
                <li><a href="{{ route('admin.projects.offers') }}"><i class="bi bi-circle"></i> @lang('العروض المقدمة')</a></li>
                --}}
            </ul>
        </li>

        <!-- إدارة التسجيل -->
        <li class="menu-label">@lang('إدارة التسجيل')</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-users"></i></div>
                <div class="menu-title">@lang('إدارة التسجيل')</div>
            </a>
            <ul>
                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="btn btn-danger btn-block">
                        @lang('تسجيل الخروج')
                    </a>
                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> --}}
                        @csrf
                    </form>
                </li>
            </ul>
        </li>

    </ul>
</aside>
