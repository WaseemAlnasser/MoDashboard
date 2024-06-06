<div class="sidebar">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{getImage(getFilePath('logoIcon') .'/logo.png')}}" alt="@lang('image')"></a>
        </div>

        <div  class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item {{menuActive('admin.dashboard')}}">
                    <a href="{{route('admin.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-chart-line"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>
                <li class="sidebar__menu-header">@lang('Users Management')</li>
                <li class="sidebar-menu-item {{menuActive('admin.users.*')}}">
                    <a href="{{route('admin.users.active')}}" class="nav-link ">
                        <i class="menu-icon las la-user"></i>
                        <span class="menu-title">@lang('All Users')</span>
                        @if($bannedUsersCount > 0 || $emailUnverifiedUsersCount > 0 || $mobileUnverifiedUsersCount > 0)
                        <div class="blob white"></div>
                        @endif
                    </a>
                </li>


                <li class="sidebar-menu-item  {{menuActive('admin.plan.*')}}">
                    <a href="{{route('admin.plan.index')}}" class="nav-link"
                        data-default-url="{{ route('admin.plan.index') }}">
                        <i class="menu-icon las la-gift menu-icon"></i>
                        <span class="menu-title">@lang('Plans') </span>
                    </a>
                </li>
                <li class="sidebar-menu-item  {{menuActive('admin.plan.*')}}">
                    <a href="{{route('admin.plan.subscription')}}" class="nav-link"
                        data-default-url="{{ route('admin.plan.subscription') }}">
                        <i class="menu-icon las la-gift menu-icon"></i>
                        <span class="menu-title">@lang('Subscriptions') </span>
                    </a>
                </li>


                <li class="sidebar-menu-item  {{menuActive('admin.service.index')}}">
                    <a href="{{route('admin.service.index')}}" class="nav-link"
                        data-default-url="{{ route('admin.service.index') }}">
                        <i class="menu-icon lab la-servicestack menu-icon"></i>
                        <span class="menu-title">@lang('Services') </span>
                    </a>
                </li>

                <li class="sidebar__menu-header">@lang('Orders')</li>
                <li class="sidebar-menu-item {{menuActive('admin.service.approved.orders')}}">
                    <a href="{{route('admin.service.approved.orders')}}" class="nav-link ">
                        <i class="la la-cart-plus menu-icon"></i>
                        <span class="menu-title">@lang('All Orders')</span>
                    </a>
                </li>


                <li class="sidebar__menu-header">@lang('Transactions')</li>
                <li class="sidebar-menu-item {{menuActive('admin.deposit.*')}}">
                    <a href="{{route('admin.deposit.pending')}}" class="nav-link ">
                        <i class="menu-icon las la-wallet"></i>
                        <span class="menu-title">@lang('Deposits')</span>
                        @if(0 < $pendingDepositsCount) <div class="blob white">
        </div>
        @endif
        </a>
        </li>
        <li class="sidebar-menu-item {{menuActive('admin.gateway.*')}}">
            <a href="{{route('admin.gateway.automatic.index')}}" class="nav-link ">
                <i class="menu-icon las la-dollar-sign"></i>
                <span class="menu-title">@lang('Payment Gateways')</span>
            </a>
        </li>
    <li class="sidebar__menu-header">@lang('Report')</li>
    <li class="sidebar-menu-item {{menuActive(['admin.report.transaction','admin.report.transaction.search'])}}">
        <a href="{{route('admin.report.transaction')}}" class="nav-link">
            <i class="menu-icon las la-credit-card"></i>
            <span class="menu-title">@lang('Transactions')</span>
        </a>
    </li>








<li class="sidebar__menu-header">@lang('General Settings')</li>

<li class="sidebar-menu-item {{menuActive('admin.setting.index')}}">
    <a href="{{route('admin.setting.index')}}" class="nav-link">
        <i class="menu-icon las la-globe"></i>
        <span class="menu-title">@lang('Global Settings')</span>
    </a>
</li>
<li class="sidebar-menu-item {{menuActive('admin.setting.logo.icon')}}">
    <a href="{{route('admin.setting.logo.icon')}}" class="nav-link">
        <i class="menu-icon las la-image"></i>
        <span class="menu-title">@lang('Logo & Favicon')</span>
    </a>
</li>
<li class="sidebar-menu-item  {{menuActive(['admin.language.manage','admin.language.key'])}}">
    <a href="{{route('admin.language.manage')}}" class="nav-link"
        data-default-url="{{ route('admin.language.manage') }}">
        <i class="menu-icon las la-language"></i>
        <span class="menu-title">@lang('Language') </span>
    </a>
</li>





</ul>
</div>
</div>
</div>
<!-- sidebar end -->

@push('script')
<script>
    if ($('li').hasClass('active')) {
        $('#sidebar__menuWrapper').animate({
            scrollTop: eval($(".active").offset().top - 320)
        }, 500);
    }
</script>
@endpush
