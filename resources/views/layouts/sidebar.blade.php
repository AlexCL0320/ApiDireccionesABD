<aside id="sidebar-wrapper">
    <div class="sidebar-brand" style="padding: 20px 0px 90px 0px; margin-bottom: 5%">
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo.png') }}" width="100px"
             alt="Infyom Logo">
        <a href="{{ url('/') }}"></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm" style="margin-top: 20%;">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="70px" alt=""/>
        </a>
    </div>
    <ul style="border-color:#414141;" class="sidebar-menu" style="margin-left: -100%;">
        @include('layouts.menu')
    </ul>
</aside>
