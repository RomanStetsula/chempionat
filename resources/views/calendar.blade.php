@extends('sides')

@section('center-content')
  <div class="main-content">
    <div class ="alert-wrap">
      @if(Session::has('message'))
    <div class="alert alert-success" role="alert">
      {{Session::get('message')}}
    </div>
    @endif
  </div>
    <div class = "errors">
      {{  HTML::ul($errors->all()) }}
    </div>
      <div class="content-title">
      <h4>Додати матч у календар</h4>
    </div>
    <table class="user-add-match">
      <thead>
          <tr>
            <th>Команда дома</th>
            <th>Команда виїзд</th>
            <th>Тур</th>
            <th>Дата</th>
            <th></th>
          </tr>
      </thead>
      <tbody>
        <tr>
          {{ Form::open(['url' => 'calendar/addGame']) }}
          {{ Form::hidden('league_id', $league->id) }}
          <td>{{ Form::select('home_team_id', ['Виберіть команду...'=>$teams_select], null, ['class' =>"teams-select"]) }}</td>
          <td>{{ Form::select('away_team_id', ['Виберіть команду...'=>$teams_select], null, ['class' =>"teams-select"]) }}</td>
          <td>{{ Form::number('round', old('round'), ['class'=>"select-round"]) }}</td>
          <td>
            <div id='sandbox-container'>
              <div class="input-group date">
                {{ Form::text('date', old('date'), ['class'=>"form-control"]) }}
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>
          </td>
          <td>
              {{ Form::submit('Додати', ['class'=>"btn btn-xs alert-success"]) }}
          </td>
          {{ Form::close() }}
        </tr>
      </tbody>
    </table>  
    <div class="content-title">
      <h4>Календар. {{ $league->league_name.' ('. $league->season.')' }}</h4>
    </div>
     @foreach($calendar as $key => $round)
    <table class="round">
      <thead>
          <tr>
            <div class ="table-title">
              <div class="bg title-top"></div>
              <div class="bg title-bottom"></div>
              <h5>{{ $key.' тур' }}</h5> 
            </div>
          </tr>
      </thead>
      <tbody>
        @foreach($round as $game)
        <tr>
            <td>{{ $game->home_team_name }}</td>
            <td><img src="{{ $game->home_team_logo }}"></td>
            <td>@if($game->home_team_goals==='')-:-@else{{$game->home_team_goals}}:{{$game->away_team_goals }}@endif</td>
            <td><img src="{{ $game->away_team_logo }}"></td>
            <td>{{ $game->away_team_name }}</td>
            <td>{{ $game->date }}</td>
            <td>
            @if($game->home_team_goals==='')
                <a class="btn btn-xs btn-danger" title="Видалити" href="{{ URL::to('calendar/destroy/'.$game->id)}}" onclick="return confirm('Ви впевнені що хочете видалити матч?')">Х</a>
            @endif
            </td>
        </tr>
        @endforeach 
      </tbody>
    </table>
    @endforeach
  </div>
@endsection
