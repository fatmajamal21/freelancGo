<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
      <div>
        <img src="{{ asset('admin_assets_rtl/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
      </div>
      <div>
        <h4 class="logo-text">منصة العمل الحر</h4>
      </div>
      <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
      </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
     <li class="menu-label">@lang('المستخدمين')</li>
     <li>
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="lni lni-users"></i>
          </div>
             <div class="menu-title">@lang('أدارة مستخدمين المنصة')</div>
               </a>
                  <ul>
                     <li>
               <a href="{{ route('admin.admin.index') }}">
                    <i class="bi bi-circle"></i>
                     @lang('الأدمن')
                </a>
                </li>
                <li>
               <a href="{{ route('admin.user.index') }}">
                <i class="bi bi-circle"></i>
                 @lang('العملاء')
               </a>
               </li>
               <li>
               <a href="{{ route('admin.freelancer.index') }}">
                    <i class="bi bi-circle"></i>
                     @lang('المستقلون')
                </a>
                </li>
        </ul>
     </li>

<!-- قسم طلبات التوثيق -->
    <ul class="metismenu" id="menu">
      <li class="menu-label">@lang('طلبات التوثيق')</li>    
       <li>
        <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="lni lni-users"></i>
          </div>
             <div class="menu-title">@lang('طلبات التوثيق')</div>
               </a>
                  <ul>
                   <li>
               <a href="{{ route('admin.verification.user.index') }}">
                    <i class="bi bi-circle"></i>
                    <div class="menu-title">@lang('توثيق العملاء')</div>
                </a>
                </li>
                     <li>
               <a href="{{ route('admin.verification.freelancer.index') }}">
                    <i class="bi bi-circle"></i>
                  <div class="menu-title">@lang('توثيق المستقلين')</div>
                </a>
                </li>

        </ul>
     </li>
     
   <!-- قسم إدارة المشاريع -->
  <li class="menu-label">@lang('إدارة المشاريع')</li>    
   <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="lni lni-briefcase"></i></div>
                <div class="menu-title">@lang('المشاريع')</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.projects.index') }}">
                        <i class="bi bi-circle"></i>
                        @lang('جميع المشاريع')
                    </a>
                </li>
                <li>
                    {{-- <a href="{{ route('admin.projects.index', ['status' => 'completed']) }}"> --}}
                        <i class="bi bi-circle"></i>
                        @lang('المكتملة')
                    </a>
                </li>
                <li>
                    {{-- <a href="{{ route('admin.projects.index', ['status' => 'late']) }}"> --}}
                        <i class="bi bi-circle"></i>
                        @lang('المتأخرة')
                    </a>
                </li>
                <li>
                    {{-- <a href="{{ route('admin.projects.index', ['status' => 'rejected']) }}"> --}}
                        <i class="bi bi-circle"></i>
                        @lang('المرفوضة')
                    </a>
                </li>
                <li>
                    {{-- <a href="{{ route('admin.projects.offers') }}"> --}}
                        <i class="bi bi-circle"></i>
                        @lang('العروض المقدمة')
                    </a>
                </li>
            </ul>
   </li>
       
  <!-- قسم إدارة التسجيل -->
<li class="menu-label">@lang('إدارة  التسجيل ')</li>
      <li>
             <a href="javascript:;" class="has-arrow">
          <div class="parent-icon"><i class="lni lni-users"></i>
          </div>
          <div class="menu-title">@lang('إدارة  التسجيل ')</div>
            </a>
            <ul>
            <li>
                <a  onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="btn btn-danger btn-block">تسجيل الخروج</a>
               {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST"> --}}
                    @csrf
                    {{-- <button class="btn btn-danger btn-block">Logout</button> --}}
                </form>
         </li>

        </ul>
      </li>













    </ul>
 </aside>