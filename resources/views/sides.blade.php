@extends('layouts.app')

@section('content')
<table class="content-table">
  <tbody>     
    <tr>@yield('content')</tr>
      <td class="content">
        <div class=" leftmenu">
          <div class="menu-title-wrap">
            <div class="menu-title">
              <div class="bg title-top"></div>
              <div class="bg title-bottom"></div>
              <h5><i class="fa fa-trophy" aria-hidden="true"></i> Ліги</h5>
            </div>
          </div>
          <nav class="navmenu" role="navigation">
            <ul class="navigation">
              @if(isset($leagues_menu))
                @foreach($leagues_menu as $league_item)
                <li class="main-item">
                  <div class="item-wrap">
                      <a href="#">{{ $league_item->league_name}}</a>
                  </div>
                  <ul>
                    <li><div class="child-item-wrap"><a  href="{{ URL::to('league/'.$league_item->id)}}"><i class="fa fa-list-ol" aria-hidden="true"></i> Таблиця</a></div></li>
                    <li><div class="child-item-wrap"><a  href="{{ URL::to('calendar/'.$league_item->id)}}"><i class="fa fa-calendar" aria-hidden="true"></i> Календар</a></div></li>
                  </ul>
                </li>
                @endforeach
              @endif
            </ul>
          </nav>
        </div>
      </td>
      <td class="content center">
       @yield('center-content') 
      </td>
      {{--<td class="content right_side">--}}
        {{--<div class="right_side">--}}
          {{--<div class="veather_vidget">--}}
              {{--<!-- weather widget start --><div id="m-booked-bl-simple-week-vertical-69374"> <div class="booked-wzs-160-275 weather-customize" style="background-color:#137AE9; width:250px;" id="width3 " > <a target="_blank" class="booked-wzs-top-160-275" href="http://www.booked.net/"><img src="//s.bookcdn.com/images/letter/s5.gif" alt="booked.net" /></a> <div class="booked-wzs-160-275_in"> <div class="booked-wzs-160-275-data"> <div class="booked-wzs-160-275-left-img wrz-01"></div> <div class="booked-wzs-160-275-right"> <div class="booked-wzs-day-deck"> <div class="booked-wzs-day-val"> <div class="booked-wzs-day-number"><span class="plus">+</span>25</div> <div class="booked-wzs-day-dergee"> <div class="booked-wzs-day-dergee-val">&deg;</div> <div class="booked-wzs-day-dergee-name">C</div> </div> </div> <div class="booked-wzs-day"> <div class="booked-wzs-day-d"><span class="plus">+</span>25&deg;</div> <div class="booked-wzs-day-n"><span class="plus">+</span>16&deg;</div> </div> </div> <div class="booked-wzs-160-275-info"> <div class="booked-wzs-160-275-city">Дрогобич</div> <div class="booked-wzs-160-275-date">Понедельник, 29</div> </div> </div> </div> <a target="_blank" href="http://nochi.com/weather/drogobych-w560534" class="booked-wzs-bottom-160-275" > <table cellpadding="0" cellspacing="0" class="booked-wzs-table-160"> <tr> <td class="week-day"> <span class="week-day-txt">Вторник</span></td> <td class="week-day-ico"><div class="wrz-sml wrzs-03"></div></td> <td class="week-day-val"><span class="plus">+</span>24&deg;</td> <td class="week-day-val"><span class="plus">+</span>15&deg;</td> </tr> <tr> <td class="week-day"> <span class="week-day-txt">Среда</span></td> <td class="week-day-ico"><div class="wrz-sml wrzs-18"></div></td> <td class="week-day-val"><span class="plus">+</span>25&deg;</td> <td class="week-day-val"><span class="plus">+</span>15&deg;</td> </tr> <tr> <td class="week-day"> <span class="week-day-txt">Четверг</span></td> <td class="week-day-ico"><div class="wrz-sml wrzs-18"></div></td> <td class="week-day-val"><span class="plus">+</span>19&deg;</td> <td class="week-day-val"><span class="plus">+</span>9&deg;</td> </tr> <tr> <td class="week-day"> <span class="week-day-txt">Пятница</span></td> <td class="week-day-ico"><div class="wrz-sml wrzs-18"></div></td> <td class="week-day-val"><span class="plus">+</span>19&deg;</td> <td class="week-day-val"><span class="plus">+</span>10&deg;</td> </tr> <tr> <td class="week-day"> <span class="week-day-txt">Суббота</span></td> <td class="week-day-ico"><div class="wrz-sml wrzs-18"></div></td> <td class="week-day-val"><span class="plus">+</span>17&deg;</td> <td class="week-day-val"><span class="plus">+</span>9&deg;</td> </tr> <tr> <td class="week-day"> <span class="week-day-txt">Воскресенье</span></td> <td class="week-day-ico"><div class="wrz-sml wrzs-18"></div></td> <td class="week-day-val"><span class="plus">+</span>16&deg;</td> <td class="week-day-val"><span class="plus">+</span>4&deg;</td> </tr> </table> <div class="booked-wzs-center"> <span class="booked-wzs-bottom-l">Прогноз на неделю</span> </div> </a> </div> </div><script type="text/javascript"> var css_file=document.createElement("link"); css_file.setAttribute("rel","stylesheet"); css_file.setAttribute("type","text/css"); css_file.setAttribute("href",'https://s.bookcdn.com/css/w/booked-wzs-widget-160x275.css?v=0.0.1'); document.getElementsByTagName("head")[0].appendChild(css_file); function setWidgetData(data) { if(typeof(data) != 'undefined' && data.results.length > 0) { for(var i = 0; i < data.results.length; ++i) { var objMainBlock = document.getElementById('m-booked-bl-simple-week-vertical-69374'); if(objMainBlock !== null) { var copyBlock = document.getElementById('m-bookew-weather-copy-'+data.results[i].widget_type); objMainBlock.innerHTML = data.results[i].html_code; if(copyBlock !== null) objMainBlock.appendChild(copyBlock); } } } else { alert('data=undefined||data.results is empty'); } } </script> <script type="text/javascript" charset="UTF-8" src="https://widgets.booked.net/weather/info?action=get_weather_info&ver=6&cityID=w560534&type=4&scode=124&ltid=3539&domid=589&anc_id=88721&cmetric=1&wlangID=20&color=339966&wwidth=250&header_color=ffffff&text_color=333333&link_color=08488D&border_form=1&footer_color=ffffff&footer_text_color=333333&transparent=0"></script><!-- weather widget end --></div>--}}
          {{--</div>--}}
          {{--<div class="side-matches">--}}
            {{--@if($sideMatches)--}}
            {{--@foreach($sideMatches as $league_name_s=>$league_round_s)--}}
              {{--<div class ="table-title">--}}
                {{--<div class="bg title-top"></div>--}}
                {{--<div class="bg title-bottom"></div>--}}
                {{--<h5>{{ $league_name_s }} ({{ $league_round_s[0]->round }} тур)</h5>--}}
              {{--</div>  --}}
              {{--<table>--}}
                {{--<thead>--}}
                  {{--<tr>--}}
                    {{--<th></th>--}}
                  {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($league_round_s as $match_s)--}}
                  {{--<tr>--}}
                    {{--<td>{{ $match_s->home_team_name }}</td>--}}
                    {{--<td>@if($match_s->home_team_goals==='')-:-@else{{ $match_s->home_team_goals }}:{{ $match_s->away_team_goals }}@endif</td>--}}
                    {{--<td>{{ $match_s->away_team_name }}</td>--}}
                    {{--@php--}}
                      {{--$date = explode('.', $match_s->date); --}}
                    {{--@endphp--}}
                    {{--<td>{{ $date['0'].'.'.$date['1'] }}</td>--}}
                  {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
              {{--</table>--}}
            {{--@endforeach--}}
            {{--@endif--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</td>--}}
  </tbody>
</table>

@endsection
