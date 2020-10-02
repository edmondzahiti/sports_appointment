@foreach ($countries as $country)
	@if (@$multiple_select === true)
	    <option value="{{ $country->name }}" {{ @$default_country && in_array($country->name, $default_country, true) ? 'selected' : '' }}>
	        {{ ucwords($country->name) }}&nbsp;({{ $country->iso_code }})
	    </option>
	@else
	    <option value="{{ $country->name }}" {{ (@$default_country === $country->name) ? 'selected' : '' }}>
	        {{ ucwords($country->name) }}&nbsp;({{ $country->iso_code }})
	    </option>
	@endif
@endforeach
