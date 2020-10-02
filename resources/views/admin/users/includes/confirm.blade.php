@if ($user->isConfirmed())
    @if ($user->id !== 1 && $user->id !== auth()->id())
        <a href="{{ route('users.unconfirm', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('messages.unconfirm')" name="confirm_item">
            <span class="badge badge-success" style="cursor:pointer">@lang('labels.general.yes')</span>
        </a>
    @else
        <span class="badge badge-success">@lang('labels.general.yes')</span>
    @endif
@else
    <a href="{{ route('users.confirm', $user) }}" data-toggle="tooltip" data-placement="top" title="@lang('messages.confirm')" name="confirm_item">
        <span class="badge badge-danger" style="cursor:pointer">@lang('labels.general.no')</span>
    </a>
@endif
