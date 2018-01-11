<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <meta name="Keywords" content="ФК, футбол, дрогобич, дрогобиччина, дрогобича, Футбол Дрогобиччини"> 
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Футбол Дрогобиччини</title>
  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">
  <link href="/css/style.v1.2.css" rel="stylesheet">
  <link href="/css/bootstrap.css" rel="stylesheet">
  <link href="/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/bootstrap-toggle.min.css" rel="stylesheet">
  @yield('admin-links')
  <!-- Scripts -->
  <script>
      window.chempionat = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>
  </script>
</head>
<body>
  <div class="bg-img">
  </div>
  <div class="bg-overlay">
  </div>
  <div class="wrapper">  
    <div class="header">
      <div class="herb">
        <img src="{{asset('images/index/drohobych_herb.png')}}" alt="">
      </div>
      <div class="logo">
        <img src="{{asset('images/index/logo.png')}}" alt="">
        <div class="main-massage">
          <i>* Добавлена можливість додавати матчі у вкладці 'Календар' для користувачів</i>
        </div> 
      </div>
      
    </div>
    <div class="menu-wrap">
        <nav class="header-nav">
            <ul class="left">
                <li><a href="{{ URL::to('/') }}">Головна</a></li>
                <li><a href="{{ URL::to('news') }}">Новини</a></li>
            </ul>
            <ul class="right">
                @if (isset(Auth::user()->is_admin))
                    @if (Auth::user()->is_admin)
                        <li>
                            <a class="admin" href="{{ url('admin-news') }}">Адмінка</a>
                        </li>
                    @endif
                @endif
                @if (Auth::guest())
                    <li>
                        Вхід через:
                    </li>
                    <li>
                        <a href="{{ url('/auth/facebook') }}"><img src="{{asset('images/index/fb.png')}}" alt="auth-fb"
                                                                   title="Увійти через facebook"></a>
                    </li>
                    <li>
                        <a href="{{ url('/auth/vkontakte') }}"><img src="{{asset('images/index/vk.png')}}" alt="auth-vk"
                                                                    title="Увійти через ВКонтакті"></a>
                    </li>
                  <!--
                    <li>
                        <a href="{{ url('/login') }}">Ввійти</a>
                    </li>
                    <li>
                        <a href="{{ url('/register') }}">Peєстрація</a>
                    </li>
                  -->
                @else
                    <!--
                        @if (Auth::user()->avatar)
                        <li>
                            <img src="{{ Auth::user()->avatar }}" class='user' alt="Фото"/>
                        </li>
                        @endif
                    -->
                        <li class="">
                            @php
                                $name = Auth::user()->name;
                                $firstname = explode(' ', $name);
                            @endphp
                            {{$firstname[0]}}
                        </li>
                        <li>
                            <a title="Вийти" href="{{ url('/logout')}}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <span class="glyphicon glyphicon-log-out"></span>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
            </ul>
            </li>
            @endif
            </ul>
        </nav>
    </div>
      <div class="container">
      @yield('content')
    </div>
    <div class="footer">
        <h5>Звязок з адміністрацією: тел. 380987331259, e-mail: stetsula89@i.ua, </h5>
        <h5><i class="fa fa-copyright" aria-hidden="true"></i> 2017 Футбол Дрогобиччини. Всі права захищені.<h5>
    </div>
  </div>
<!--GoogleAnalitics-->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-99625154-1', 'auto');
  ga('send', 'pageview');
</script>
     <!--Scripts--> 
  <script src="/js/jquery.js"></script>
  <script src="/js/bootstrap-datepicker.min.js"></script>
  <script src="/js/bootstrap-datepicker.uk.min.js"></script>
  <script src="/js/common.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/bootstrap-toggle.min.js"></script>
  @yield('admin-scripts')
</body>

</html>
