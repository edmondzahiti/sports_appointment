<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>{!! $user->status_formated !!}</td>
            </tr>

            @if ($user->hasRole(config('app.roles.superadmin_role')))
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.area_settings')</th>
                    <td>{!! $user->area_settings !!}</td>
                </tr>
            @endif

            @if ($user->hasRole(config('app.roles.admin_role')))
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.nations')</th>
                    <td>{!! $user->nations !!}</td>
                </tr>
                <tr>
                    <th>@lang('labels.backend.access.users.tabs.content.overview.states')</th>
                    <td>{!! $user->states !!}</td>
                </tr>
            @endif

            {{-- 

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                <td>@include('admin.users.includes.confirm', ['user' => $user])</td>
            </tr>
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                <td>{{ $user->timezone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                <td>
                    @if($user->last_login_at)
                        {{ convertToLocal($user->last_login_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
            </tr> 
            --}}
        </table>
    </div>
</div><!--table-responsive-->
