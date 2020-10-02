@foreach ($currencies as $currency)
	<option value="{{ $currency->iso_code }}" {{ (@$default_currency === $currency->iso_code) ? 'selected' : '' }}>
	    {{ $currency->name }}
	</option>
@endforeach
