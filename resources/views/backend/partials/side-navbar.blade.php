<!--<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">-->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Admin Panel</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.dashboard')) bg-gradient-primary active @endif" href="{{ route('admin.dashboard') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.vendor_management.registered_vendor')) bg-gradient-primary active @endif" href="{{ route('admin.vendor_management.registered_vendor') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Vendors List</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.user_management.registered_user')) bg-gradient-primary active @endif" href="{{ route('admin.user_management.registered_user') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">User List</span>
          </a>
        </li>
        
    
        
         <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.user_management.favourite_user.eventoffer')) bg-gradient-primary active @endif" href="{{ route('admin.user_management.favourite_user.eventoffer') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Favourite List</span>
          </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link text-white @if (request()->routeIs('admin.custom_pages.edit_page') || request()->routeIs('admin.custom_pages')) bg-gradient-primary active @endif" href="{{ route('admin.custom_pages.edit_page') }}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">table_view</i>
                </div>
                <span class="nav-link-text ms-1">Update Term Condition</span>
            </a>
        </li>

        
          <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.event_popup')) bg-gradient-primary active @endif" href="{{ route('admin.event_popup') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Event Popup</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.admin_management.registered_admins')) bg-gradient-primary active @endif" href="{{ route('admin.admin_management.registered_admins') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Admin List</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.event_management.event')) bg-gradient-primary active @endif" href="{{ route('admin.event_management.event') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Offer List</span>
          </a>
        </li>
        
        
         <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.contact_us')) bg-gradient-primary active @endif" href="{{ route('admin.contact_us') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Contact List</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('show2faForm')) bg-gradient-primary active @endif" href="{{ url('/admin/2fa') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Google Authenitcation</span>
          </a>
        </li> 

  
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>
        <!--<li class="nav-item">-->
        <!--  <a class="nav-link text-white " href="./pages/profile.html">-->
        <!--    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">-->
        <!--      <i class="material-icons opacity-10">person</i>-->
        <!--    </div>-->
        <!--    <span class="nav-link-text ms-1">Profile</span>-->
        <!--  </a>-->
        <!--</li>-->
        <li class="nav-item">
          <a class="nav-link text-white @if (request()->routeIs('admin.logout')) bg-gradient-primary active @endif" href="{{ route('admin.logout')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
            </div>
            <span class="nav-link-text ms-1">Sign Out</span>
          </a>
        </li>

  </aside>