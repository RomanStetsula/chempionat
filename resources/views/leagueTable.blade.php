@extends('sides')

@section('center-content')
    <div class="league-table-page">

        @if(!empty($last_matches))
            <div id="last-matсhes">
                <table class="round">
                    <thead>
                    <tr>
                        <div class="table-title">
                            <div class="bg title-top"></div>
                            <div class="bg title-bottom"></div>
                            <h5>Попередній тур ({{$last_matches[0]->round }})</h5>
                        </div>
                    </tr>
                    </thead>
                    <tbody>
                    <tr @foreach($last_matches as $last_matсh)>
                        <td class="home-team">{{$last_matсh->home_team_name}}</td>
                        <td><img src="{{$last_matсh->home_team_logo}}"></td>
                        <td class="goals">
                            @if($last_matсh->confirmed)
                                <div class="conf-result">
                                    {{$last_matсh->home_team_goals}}:{{$last_matсh->away_team_goals}}</div>
                            @else
                                <div class="result"><span class="g1">@if($last_matсh->home_team_goals==='')
                                            -@else{{$last_matсh->home_team_goals}}@endif</span>:<span class="g2">@if($last_matсh->away_team_goals==='')
                                            -@else{{$last_matсh->away_team_goals}}@endif</span></div>
                            @endif
                        </td>
                        <td><img src="{{$last_matсh->away_team_logo}}"></td>
                        <td class="away-team">{{$last_matсh->away_team_name}}</td>
                        <td><i class="fa fa-check-circle" aria-hidden="true" title="Підтвердити результат!"></i></td>
                        <td class="match-date">{{$last_matсh->date}}</td>
                        <td class="game-id">{{$last_matсh->id}}</td>
                    </tr @endforeach>
                    </tbody>
                </table>
                <div class="help">
                    <i><p>* Якщо вам відомий результат вже зіграного матчу ви можете додати його або змінити, якщо
                            результат не вірний.
                            Для цього клікніть по полі рахунку (-:-). Також ви можете підтвердити введений іншим
                            користувачем результат (зелений кружок).</p>
                        <p>*Ви повинні бути авторизовані.</p>
                    </i>
                </div>
            </div>
        @endif

        <div class="league-table">
            <div class="table-title">
                <div class="bg title-top"></div>
                <div class="bg title-bottom"></div>
                <h5>{{$league->league_name.' '.$league->season}}</h5>
            </div>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th colspan="2">Команда</th>
                    <th>I</th>
                    <th>В</th>
                    <th>Н</th>
                    <th>П</th>
                    <th>Зб.</th>
                    <th>Пр.</th>
                    <th>Рз.</th>
                    <th>О</th>
                </tr>
                </thead>
                <tbody>
                <tr @foreach($league_table as $key => $league_team)>
                    <td>{{$key+1}}</td>
                    <td width="20"><img src="{!! $league_team->small_logo or ' ' !!}"></td>
                    <td width="200"><a class=""
                                       href="{{ URL::to('team/'.$league_team->team_id )}}">{{$league_team->table_name}}</a>
                    </td>
                    <td width="20">{{ $league_team->games }}</td>
                    <td width="20">{{ $league_team->wins }}</td>
                    <td width="20"> {{ $league_team->draws }}</td>
                    <td width="20"> {{ $league_team->losts }}</td>
                    <td width="20"> {{ $league_team->scores }}</td>
                    <td width="20"> {{ $league_team->missed }}</td>
                    <td width="20"> {{ $league_team->odds }}</td>
                    <td width="20"> {{ $league_team->points }}</td>
                </tr @endforeach>

                </tbody>
            </table>
        </div>

        @if(!empty($next_matches))
            <div class="next-matches">
                <table class="round">
                    <thead>
                    <tr>
                        <div class="table-title">
                            <div class="bg title-top"></div>
                            <div class="bg title-bottom"></div>
                            <h5>Наступний тур ({{$next_matches[0]->round }})</h5>
                        </div>
                    </tr>
                    </thead>
                    @foreach($next_matches as $next_matсh)
                        <tr>
                            <td class="home-team">{{$next_matсh->home_team_name}}</td>
                            <td><img src="{{$next_matсh->home_team_logo}}"></td>
                            <td>
                                <div class="conf-result">{{$next_matсh->home_team_goals}}
                                    :{{$next_matсh->away_team_goals}}</div>
                            </td>
                            <td><img src="{{$next_matсh->away_team_logo}}"></td>
                            <td class="away-team">{{$next_matсh->away_team_name}}</td>
                            <td class="match-date">{{$next_matсh->date}}</td>
                            <td class="game-id">{{$next_matсh->id}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
        <div class="modal-add-result ">
            <span class="modal-close">х</span>
            @if(!Auth::user())
                <div class="vk-auth"><a href="{{ url('/auth/vkontakte') }}">Авторизуйтесь</a>, щоб додати результат!
                </div>
            @else
                <table>
                    <thead>
                    <th class='modal-league-name' colspan="2"><h5>{{$league->league_name.' '.$league->season }}</h5>
                    </th>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="date" colspan="2"></td>
                    </tr>
                    <tr class="teams">
                        <td class="home-team"></td>
                        <td class="away-team"></td>
                    </tr>
                    {!! Form::open(['url' => 'userAddResult' , 'method' => 'put']) !!}
                    <tr>
                        <td>{!!Form::number('home_team_goals', null, [ 'min'=>0, 'max'=>'30', 'class'=>"g1" ]) !!}</td>
                        <td>{!!Form::number('away_team_goals', null, [ 'min'=>0, 'max'=>'30', 'class'=>"g2" ]) !!}</td>
                        {!! Form::hidden('game_id', null,['class'=>"game-id" ]) !!}
                    </tr>
                    <tr>
                        <td class="button" colspan="2">
                            {{ Form::submit("Додати", ['class'=>"btn btn-xs alert-success"]) }}
                        </td>
                    </tr>
                    {!! Form::close() !!}
                    </tbody>
                </table>
            @endif
        </div>
        <div class="overlay"></div>
    </div>
@endsection