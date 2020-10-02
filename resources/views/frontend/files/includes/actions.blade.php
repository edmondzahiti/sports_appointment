@if ($file->trashed())
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        {{-- Restore --}}
        <a 
            href="#"
            name="confirm_item"
            class="btn btn-info"
            data-toggle="tooltip"
            data-placement="top"
            title="@lang('messages.restore', ['model' => 'File'])"
            onclick="event.preventDefault(); if(confirm('@lang('messages.restore', ['model' => 'File'])')){ document.getElementById('restore_file_form_{{ $file->id }}').submit(); return true  } else { return false }">
            <i class="fas fa-sync"></i>
        </a>
        <form id="restore_file_form_{{ $file->id }}" action="{{ route('files.restore', ['id' => $file->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('PATCH')
        </form>
        {{-- Permanently Delete --}}
        <a 
            href="#"
            name="confirm_item"
            class="btn btn-danger"
            data-toggle="tooltip"
            data-placement="top"
            title="@lang('messages.delete_permanently')"
            onclick="event.preventDefault(); if(confirm('@lang('messages.are_you_sure')')){ document.getElementById('delete_permanently_form_{{ $file->id }}').submit(); return true  } else { return false }">
            <i class="fas fa-trash"></i>
        </a>
        <form id="delete_permanently_form_{{ $file->id }}" action="{{ route('files.forceDelete', ['id' => $file->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
@else
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
        <a href="{{ route('files.view', ['file' => $file]) }}" data-toggle="tooltip" data-placement="top" title="@lang('messages.view')" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </a>

        <a href="{{ route('files.edit', ['file' => $file]) }}" data-toggle="tooltip" data-placement="top" title="@lang('messages.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>

        <div class="btn-group btn-group-sm" role="group">
            <button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('labels.general.more')
            </button>
            <div class="dropdown-menu" aria-labelledby="userActions">
                @if ($file->user_id === auth()->id())
                    <form method="POST" action="{{ route('files.destroy', ['file' => $file]) }}" style="display:inline">
                        @method('DELETE')
                        @csrf
                        <button
                            data-method="delete"
                            type="submit"
                            data-trans-button-cancel="@lang('messages.cancel')"
                            data-trans-button-confirm="@lang('messages.delete')"
                            data-trans-title="@lang('messages.are_you_sure')"
                            onclick="return confirm('@lang('messages.delete_confirmation')');"
                            value="Submit"
                            class="dropdown-item">
                                @lang('messages.delete')
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endif
