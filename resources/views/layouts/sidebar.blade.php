<aside id="sidebar-wrapper">
    <div class="sidebar-brand" style="padding: 0px 0px 120px 0px">
        <img class="navbar-brand-full app-header-logo" src="{{ asset('img/logo.png') }}" width="130px"
             alt="Infyom Logo">
        <a href="{{ url('/') }}"></a>
</DIV>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ url('/') }}" class="small-sidebar-text">
            <img class="navbar-brand-full" src="{{ asset('img/logo.png') }}" width="100px" alt=""/>
        </a>
    </div>
    <ul style="border-color:#414141;" class="sidebar-menu">
        @include('layouts.menu')
    </ul>
</aside>
