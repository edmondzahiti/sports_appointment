@foreach ($timezones as $timezone)
    <option value="{{ $timezone->name }}" {{ (@$default_timezone === $timezone->name) ? 'selected' : '' }} >
    	{{ $timezone->name }}
    </option>
@endforeach