{{-- @if(!locales()->isEmpty()) --}}
{{-- @if(config('app.locale_status') && count(config('locale.languages')) > 1) --}}
@if(config('app.locale_status') && locales()->count() > 1)
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>
       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
           @foreach(locales()->keys() as $lang)
              @if($lang === app()->getLocale())
                  <strong>
              @endif
              <a href="{{ route('lang.swap', ['lang' => $lang]) }}" class="dropdown-item pt-1 pb-1">
                  @lang('menus.language-picker.langs.'.$lang)
              </a>
              @if($lang === app()->getLocale())
               </strong>
              @endif
           @endforeach
       </div>
    </li>
@endif
