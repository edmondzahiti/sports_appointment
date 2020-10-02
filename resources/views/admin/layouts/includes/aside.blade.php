  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-1">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link navbar-info">
{{--      <img src="{{ asset('/img/general/logo-small.png') }}" alt="{{ config('app.name', 'Laravel') }}" class="brand-image">--}}
       <span class="brand-text font-weight-light ml-4">
            Sports Appointment
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a
                    class="nav-link mb-4 {{ is_active('profile*') }}"
                    href="{{ route('profile') }}">
                    <i class="nav-icon fa fa-user"></i>&nbsp;<p class="text">{{ optional(auth()->user())->name }} {{ optional(auth()->user())->surname }}</p>
                </a>
                <hr>
            </li>


          <li class="nav-item">
              <a
                  class="nav-link {{ is_active('dashboard*') }}"
                  href="{{ route('dashboard') }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>&nbsp;<p class="text">Dashboard</p>
              </a>
          </li>


        @if (auth()->user()->isAdmin())
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ is_active('users*') }}">
                  <i class="nav-icon fas fa-users"></i>&nbsp;<p class="text">Users</p>
                </a>
              </li>

          <li class="nav-item">
           <a
              class="nav-link {{ is_active('fields*') }}"
              href="{{ route('fields.index') }}">
               <i class="nav-icon fa fa-home" aria-hidden="true"></i>&nbsp;<p class="text">Fields</p>
            </a>
          </li>
        @endif

            <li class="nav-item">
                <a
                    class="nav-link {{ is_active('events.index') }} {{ is_active('events.edit') }}"
                    href="{{ route('events.index') }}">
                    <i class="nav-icon fas fa-list-ol"></i>&nbsp;<p class="text">
                        {{auth()->user()->isAdmin() ? 'All Events' : 'My Events'}}</p>
                </a>
            </li>

            <li class="nav-item">
                <a
                    class="nav-link {{ is_active('events.calendar') }}"
                    href="{{ route('events.calendar') }}">
                    <i class="nav-icon fas fa-list-ol"></i>&nbsp;<p class="text">Events Calendar</p>
                </a>
            </li>

            <li class="nav-item">
            <a
              class="nav-link"
              href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout_left_sidebar').submit(); return true;">
              <i class="nav-icon fas fa-sign-out-alt"></i>&nbsp;<p class="text">@lang('Logout')</p>
            </a>
            <form id="logout_left_sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
