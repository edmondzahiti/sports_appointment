  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
{{--      <li class="nav-item d-none d-sm-inline-block">--}}
{{--        <a href="{{ route(home_route()) }}" class="nav-link">{{ __('Home') }}</a>--}}
{{--      </li>--}}
    </ul>

    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--      <div class="input-group input-group-sm">--}}
{{--        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--        <div class="input-group-append">--}}
{{--          <button class="btn btn-navbar" type="submit">--}}
{{--            <i class="fas fa-search"></i>--}}
{{--          </button>--}}
{{--        </div>--}}
{{--      </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
{{--    <ul class="navbar-nav ml-auto">--}}
{{--      <!-- Messages Dropdown Menu -->--}}
{{--      <li class="nav-item dropdown">--}}
{{--        <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--          <i class="far fa-comments"></i>--}}
{{--          <span class="badge badge-danger navbar-badge">3</span>--}}
{{--        </a>--}}
{{--        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--          <a href="#" class="dropdown-item">--}}
{{--            <!-- Message Start -->--}}
{{--            <div class="media">--}}
{{--              <img src="{{ asset('/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
{{--              <div class="media-body">--}}
{{--                <h3 class="dropdown-item-title">--}}
{{--                  Brad Diesel--}}
{{--                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
{{--                </h3>--}}
{{--                <p class="text-sm">Call me whenever you can...</p>--}}
{{--                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- Message End -->--}}
{{--          </a>--}}
{{--          <div class="dropdown-divider"></div>--}}
{{--          <a href="#" class="dropdown-item">--}}
{{--            <!-- Message Start -->--}}
{{--            <div class="media">--}}
{{--              <img src="{{ asset('/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--              <div class="media-body">--}}
{{--                <h3 class="dropdown-item-title">--}}
{{--                  John Pierce--}}
{{--                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>--}}
{{--                </h3>--}}
{{--                <p class="text-sm">I got your message bro</p>--}}
{{--                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- Message End -->--}}
{{--          </a>--}}
{{--          <div class="dropdown-divider"></div>--}}
{{--          <a href="#" class="dropdown-item">--}}
{{--            <!-- Message Start -->--}}
{{--            <div class="media">--}}
{{--              <img src="{{ asset('/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--              <div class="media-body">--}}
{{--                <h3 class="dropdown-item-title">--}}
{{--                  Nora Silvester--}}
{{--                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>--}}
{{--                </h3>--}}
{{--                <p class="text-sm">The subject goes here</p>--}}
{{--                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- Message End -->--}}
{{--          </a>--}}
{{--          <div class="dropdown-divider"></div>--}}
{{--          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>--}}
{{--        </div>--}}
{{--      </li>--}}
{{--      <!-- Notifications Dropdown Menu -->--}}
{{--      <li class="nav-item dropdown">--}}
{{--        <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--          <i class="far fa-bell"></i>--}}
{{--        </a>--}}
{{--        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}

{{--          <div class="dropdown-item">--}}
{{--            <div class="media">--}}
{{--              <img src="{{ asset('/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
{{--              <div class="media-body">--}}
{{--                <h3 class="dropdown-item-title">--}}
{{--                  Brad Diesel--}}
{{--                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
{{--                </h3>--}}
{{--                <p class="text-sm">Call me whenever you can</p>--}}
{{--                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- Message End -->--}}
{{--          </div>--}}

{{--          <div class="dropdown-divider"></div>--}}

{{--          <a href="{{ route('home') }}" class="dropdown-item">--}}
{{--            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard--}}
{{--          </a>--}}

{{--          <a href="{{ route('profile') }}" class="dropdown-item">--}}
{{--            <i class="fas fa-user mr-2"></i> Profile--}}
{{--          </a>--}}

{{--          <div class="dropdown-divider"></div>--}}

{{--          <a --}}
{{--              class="dropdown-item dropdown-footer"--}}
{{--              href="{{ route('logout') }}"--}}
{{--              onclick="event.preventDefault(); document.getElementById('logout_top_navbar').submit(); return true;">--}}
{{--              <i class="fas fa-sign-out-alt text-info"></i>&nbsp;@lang('auth.logout')--}}
{{--          </a>--}}
{{--          <form id="logout_top_navbar" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--            @csrf--}}
{{--          </form>--}}
{{--        </div>--}}
{{--      </li>--}}

{{--      <li class="nav-item">--}}
{{--        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
{{--          <i class="fas fa-th-large"></i>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--    </ul>--}}
  </nav>
  <!-- /.navbar -->
