<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/En-Horr.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-list"></i></div>
    </div>

    <!-- Navigation -->

    <ul class="metismenu" id="menu">

    <!-- <li class="menu-label">Panel</li> -->

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bi bi-people-fill"></i></div>
            <div class="menu-title">ARIB Panel</div>
        </a>
        <ul>
             @if (auth()->user()->role === 'manager')
            <li><a href="{{ route('admin.users.index') }}"><i class="bi bi-circle"></i> Manage Users</a></li>
            <li><a href="{{ route('admin.departments.index') }}"><i class="bi bi-circle"></i> Manage Departments</a></li>
             @endif 
            <li><a href="{{ route('admin.tasks.index') }}"><i class="bi bi-circle"></i> Manage Task</a></li>
        </ul>
    </li>

    
    </ul>
</aside>
