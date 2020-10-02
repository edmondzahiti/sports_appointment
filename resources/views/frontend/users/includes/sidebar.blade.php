<div class="card">
  <div class="card-header">
    <h3 class="card-title">Personal settings</h3>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="{{ route('profile') }}" class="nav-link">
          <i class="fas fa-address-card"></i> Profile
        </a>
      </li>
      
      @if (config('app.package.socialite'))
      <li class="nav-item">
        <a href="{{ route('socials') }}" class="nav-link">
          <i class="fas fa-network-wired"></i> Social Accounts
        </a>
      </li>
      @endif

      @if (config('app.package.activitylog'))
      <li class="nav-item">
        <a href="{{ route('activity') }}" class="nav-link">
          <i class="fas fa-history"></i> Activity Logs
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a href="{{ route('globals') }}" class="nav-link">
          <i class="fas fa-user-cog"></i> Global Preferences
        </a>
      </li>

      @if(auth()->user()->canChangePassword())
      <li class="nav-item">
        <a href="{{ route('change_password') }}" class="nav-link">
          <i class="fas fa-unlock-alt"></i> Security
        </a>
      </li>
      @endif

      <li class="nav-item">
        <a href="{{ route('sessions') }}" class="nav-link">
          <i class="far fa-circle text-info"></i> Sessions
        </a>
      </li>

      <li class="nav-item">
        <a href="{{ route('deactivate') }}" class="nav-link text-danger">
          <i class="fas fa-times"></i> Delete Account
        </a>
      </li>

      <li class="nav-item">
        <a 
          class="nav-link"
          href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout_left_sidebar_profile').submit(); return true;">
          <i class="fas fa-sign-out-alt"></i>&nbsp;@lang('auth.logout')
        </a>
        <form id="logout_left_sidebar_profile" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>

    </ul>
  </div>
  <!-- /.card-body -->
</div>