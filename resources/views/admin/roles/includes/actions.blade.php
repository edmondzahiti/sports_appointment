@if ($role->id !== 1)
    <div class="btn-group btn-group-sm" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="@lang('messages.edit')">
            <i class="fas fa-edit"></i>
        </a>

        <a 
            href="#"
            name="confirm_item"
            class="btn btn-danger"
            data-toggle="tooltip"
            data-placement="top"
            title="@lang('messages.delete_permanently')"
            onclick="event.preventDefault(); if(confirm('@lang('messages.are_you_sure')')){ document.getElementById('delete_permanently_form_{{ $role->id }}').submit(); return true  } else { return false }">
            <i class="fas fa-trash"></i>
        </a>
        <form id="delete_permanently_form_{{ $role->id }}" action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
@else
    N/A
@endif
