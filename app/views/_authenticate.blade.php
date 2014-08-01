
@if(Auth::check())
  @yield('authorized_content')
@else 
  @yield('non_authorized_content')
@endif

