<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head')
</head>

<body>
    <div class="page">
        <!-- Main Navbar-->
        @include('partials.header')

        {{--<!-- Section-->--}}
        <div id="app">
            {{--@yield('content')--}}
        </div>

        <!-- Page Footer-->
        {{--@include('partials.footer')--}}

    </div>
        @include('partials.scripts')
</body>
</html>







  {{--<div class="bg-img">--}}
  {{--</div>--}}
  {{--<div class="bg-overlay">--}}
  {{--</div>--}}
  {{--<div class="wrapper">  --}}
    {{--<div class="header">--}}
      {{--<div class="herb">--}}
        {{--<img src="{{asset('images/index/drohobych_herb.png')}}" alt="">--}}
      {{--</div>--}}
      {{--<div class="logo">--}}
        {{--<img src="{{asset('images/index/logo.png')}}" alt="">--}}
        {{--<div class="main-massage">--}}
          {{--<i>* Добавлена можливість додавати матчі у вкладці 'Календар' для користувачів</i>--}}
        {{--</div> --}}
      {{--</div>--}}
      {{----}}
    {{--</div>--}}
    {{--<div class="menu-wrap">--}}
        {{--<nav class="header-nav">--}}
            {{--<ul class="left">--}}
                {{--<li><a href="{{ URL::to('/') }}">Головна</a></li>--}}
                {{--<li><a href="{{ URL::to('news') }}">Новини</a></li>--}}
            {{--</ul>--}}
            {{--<ul class="right">--}}
                {{--@if (isset(Auth::user()->is_admin))--}}
                    {{--@if (Auth::user()->is_admin)--}}
                        {{--<li>--}}
                            {{--<a class="admin" href="{{ url('admin-news') }}">Адмінка</a>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--@endif--}}
                {{--@if (Auth::guest())--}}
                    {{--<li>--}}
                        {{--Вхід через:--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url('/auth/facebook') }}"><img src="{{asset('images/index/fb.png')}}" alt="auth-fb"--}}
                                                                   {{--title="Увійти через facebook"></a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url('/auth/vkontakte') }}"><img src="{{asset('images/index/vk.png')}}" alt="auth-vk"--}}
                                                                    {{--title="Увійти через ВКонтакті"></a>--}}
                    {{--</li>--}}
                  {{--<!----}}
                    {{--<li>--}}
                        {{--<a href="{{ url('/login') }}">Ввійти</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="{{ url('/register') }}">Peєстрація</a>--}}
                    {{--</li>--}}
                  {{---->--}}
                {{--@else--}}
                    {{--<!----}}
                        {{--@if (Auth::user()->avatar)--}}
                        {{--<li>--}}
                            {{--<img src="{{ Auth::user()->avatar }}" class='user' alt="Фото"/>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                    {{---->--}}
                        {{--<li class="">--}}
                            {{--@php--}}
                                {{--$name = Auth::user()->name;--}}
                                {{--$firstname = explode(' ', $name);--}}
                            {{--@endphp--}}
                            {{--{{$firstname[0]}}--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a title="Вийти" href="{{ url('/logout')}}"--}}
                               {{--onclick="event.preventDefault();--}}
                                {{--document.getElementById('logout-form').submit();">--}}
                                {{--<span class="glyphicon glyphicon-log-out"></span>--}}
                            {{--</a>--}}
                            {{--<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--@endif--}}
            {{--</ul>--}}
        {{--</nav>--}}
    {{--</div>--}}
      {{--<div class="container">--}}
      {{--@yield('content')--}}
    {{--</div>--}}
    {{--<div class="footer">--}}
        {{--<h5>Звязок з адміністрацією: тел. 380987331259, e-mail: stetsula89@i.ua, </h5>--}}
        {{--<h5><i class="fa fa-copyright" aria-hidden="true"></i> 2017 Футбол Дрогобиччини. Всі права захищені.</h5>--}}
    {{--</div>--}}
  {{--</div>--}}


  {{--@yield('admin-scripts')--}}

