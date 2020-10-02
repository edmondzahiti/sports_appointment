@if ($user->providers->count())
    @foreach ($user->providers as $social)
        <a href="{{ route('userd.social.unlink', [$user, $social]) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.access.users.unlink')" data-method="delete">
            <i class="fab fa-{{ $social->provider }}"></i>
        </a>
    @endforeach
@else
    @lang('labels.general.none')
@endif
