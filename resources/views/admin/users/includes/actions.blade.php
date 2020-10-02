<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
    <a href="{{ route('users.edit', ['user' => $user]) }}" title="@lang('messages.edit')" class="btn">
        <i class="fas fa-edit"></i>
    </a>
    <a
        href="#"
        name="confirm_item"
        class="btn"
        title="@lang('messages.delete_permanently')"
        onclick="event.preventDefault(); if(confirm('Are you sure')){ document.getElementById('delete_permanently_form_{{ $user->id }}').submit(); return true  } else { return false }">
        <i class="far fa-trash-alt"></i>
    </a>
    <form id="delete_permanently_form_{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
