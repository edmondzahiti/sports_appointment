<div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
    <a href="{{ route('fields.edit', ['field' => $field]) }}" title="@lang('messages.edit')" class="btn">
        <i class="fas fa-edit"></i>
    </a>
    <a
        href="#"
        name="confirm_item"
        class="btn"
        title="@lang('messages.delete_permanently')"
        onclick="event.preventDefault(); if(confirm('Are you sure')){ document.getElementById('delete_permanently_form_{{ $field->id }}').submit(); return true  } else { return false }">
        <i class="far fa-trash-alt"></i>
    </a>
    <form id="delete_permanently_form_{{ $field->id }}" action="{{ route('fields.destroy', ['field' => $field]) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
