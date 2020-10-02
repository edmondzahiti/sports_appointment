@foreach ($languages as $language)
    <option value="{{ $language->iso_code }}" {{ (@$default_language === $language->iso_code) ? 'selected' : '' }} >
    	{{ $language->name }}
    </option>
@endforeach