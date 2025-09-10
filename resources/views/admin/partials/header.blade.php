<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

      <div class="app-brand demo my-3">
        <a href="{{ url('/') }}" class="app-brand-link">
          <span class="app-brand-logo demo me-1">
            <img src="{{asset('assets/img/icons/logo.png')}}" alt="" class="img-fluid" style="width:60%;">
          </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
          <i class="menu-toggle-icon d-xl-block align-middle"></i>
        </a>
      </div>

      <div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
<li class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
    
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ri-box-3-line"></i>
                    <div>Dashboard</div>
                </a>
            </li>
    {{-- Coupons --}}
    <li class="menu-item {{ request()->is('admin/coupons', 'admin/coupons/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-box-3-line"></i>
            <div>Manage Coupons</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('admin/coupons/create') ? 'active' : '' }}">
                <a href="{{ route('admin.coupons.create') }}" class="menu-link">
                    <div>Add Coupon</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/coupons') ? 'active' : '' }}">
                <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                    <div>View Coupons</div>
                </a>
            </li>
        </ul>
    </li>

    {{-- Events --}}
    <li class="menu-item {{ request()->is('admin/events', 'admin/events/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-calendar-event-line"></i>
            <div>Manage Events</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('admin/events/create') ? 'active' : '' }}">
                <a href="{{ route('admin.events.create') }}" class="menu-link">
                    <div>Add Event</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/events') ? 'active' : '' }}">
                <a href="{{ route('admin.events.index') }}" class="menu-link">
                    <div>View Events</div>
                </a>
            </li>
        </ul>
    </li>

    {{-- Networks --}}
    <li class="menu-item {{ request()->is('admin/networks', 'admin/networks/*') ? 'active open' : '' }}">
        <a href="{{ route('admin.networks.index') }}" class="menu-link">
            <i class="menu-icon tf-icons ri-share-line"></i>
            <div>Manage Networks</div>
        </a>
    </li>

    {{-- Categories --}}
    <li class="menu-item {{ request()->is('admin/categories', 'admin/categories/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-folder-3-line"></i>
            <div>Manage Categories</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('admin/categories/create') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.create') }}" class="menu-link">
                    <div>Add Category</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/categories') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}" class="menu-link">
                    <div>View Categories</div>
                </a>
            </li>
        </ul>
    </li>

    {{-- Pages --}}
    <li class="menu-item {{ request()->is('admin/pages', 'admin/pages/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-file-list-3-line"></i>
            <div>Manage Pages</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('admin/pages/create') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.create') }}" class="menu-link">
                    <div>Add Page</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/pages') && !request()->is('admin/pages/create') ? 'active' : '' }}">
                <a href="{{ route('admin.pages.index') }}" class="menu-link">
                    <div>View Pages</div>
                </a>
            </li>
        </ul>
    </li>

    {{-- Stores --}}
    <li class="menu-item {{ request()->is('admin/stores', 'admin/stores/*') ? 'active open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ri-store-2-line"></i>
            <div>Manage Stores</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item {{ request()->is('admin/stores/create') ? 'active' : '' }}">
                <a href="{{ route('admin.stores.create') }}" class="menu-link">
                    <div>Add Store</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/stores') ? 'active' : '' }}">
                <a href="{{ route('admin.stores.index') }}" class="menu-link">
                    <div>View Stores</div>
                </a>
            </li>
        </ul>
    </li>
</ul>




    </aside>
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->
      @include('admin.partials.top_navbar')
