<ul class="language-switcher list-group list-group-horizontal justify-content-center">
@foreach ($languages as $lang)
  	<li class="list-group-item">
	  	@if($lang->iso_code === app()->getLocale())
	  	    <strong>
	  	@endif
	  	<a href="{{ route('lang.swap', ['lang' => $lang->iso_code]) }}" class="item {{ $lang->iso_code === app()->getLocale() ? 'active' : ''}}">
	  	    {{ $lang->iso_code }}
	  	</a>
	  	@if($lang->iso_code === app()->getLocale())
	  		</strong>
	  	@endif
  	</li>
@endforeach
</ul>