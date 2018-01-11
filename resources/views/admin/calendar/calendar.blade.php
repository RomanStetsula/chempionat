@extends('admin.admin')

@section('adminzone')
<div class = "admin-calendar">
  <div class = "errors">
    {{  HTML::ul($errors->all()) }}
  </div>
  <div class="col-xs-12">
    <div class="content-title">
      <h4>Додати матч у календар</h4>
    </div>
    <table class="add-round-table table table-striped table-bordered">
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
          {{ Form::open(['url' => 'admin-calendar']) }}
          {{ Form::hidden('league_id', $league->id) }}
          <td>{{ Form::select('home_team_id', ['Виберіть команду...'=>$teams_select], null, ['class' =>"teams-select"]) }}</td>
          <td>{{ Form::select('away_team_id', ['Виберіть команду...'=>$teams_select], null, ['class' =>"teams-select"]) }}</td>
          <td>{{ Form::number('round', old('round'), ['class'=>"form-control"]) }}</td>
          <td>
            <div id='sandbox-container'>
              <div class="input-group date">
                {{ Form::text('date', old('date'), ['class'=>"form-control"]) }}
                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>
          </td>
          <td>
              {{ Form::submit('Додати матч', ['class'=>"btn btn-xs alert-success"]) }}
          </td>
          {{ Form::close() }}
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-xs-12">
    <div class="content-title">
      <h4>Календар. {!! $league->league_name.' ('. $league->season.')' !!}</h4>
    </div>
  </div>
  <div class="col-xs-12">
  @foreach($calendar as $key => $round)
    <table class="admin-calendar-table table table-striped table-bordered">
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
                <td class="home-team">{!! $game->home_team_name !!}</td>
                {!! Form::model($game, ['route' => ['admin-calendar.update', $game->id], 'method' => 'PUT']) !!}
                <td>{!!Form::number('home_team_goals', old($game->home_team_goals), [ 'min'=>0, 'max'=>'30', 'class'=>"goals" ])!!}</td>
                <td>{!!Form::number('away_team_goals', old($game->away_team_goals), [ 'min'=>0, 'max'=>'30', 'class'=>"goals" ])!!}</td>
                    {!!Form::hidden('home_team_id', $game->home_team_id, [ 'class'=>"" ])!!}
                    {!!Form::hidden('away_team_id', $game->away_team_id, [ 'class'=>"" ])!!}
                    {!!Form::hidden('league_id', $league->id)!!}
                <td class="away-team">{!! $game->away_team_name !!}</td>
                <td>{!! $game->date !!}</td>
                <td class="control">
                    {!! Form::submit('Додати результат', [ 'class'=>"btn btn-xs alert-success" ]) !!}
                    {!! Form::close() !!}
                    <a class="btn btn-xs btn-warning" href="{{ URL::to('clear-result/'.$game->id)}}" onclick="return confirm('Ви впевнені що хочете очистити результат?')">Очистити результат</a>
                    {!! Form::open([ 'class'=>"delete-form",'route' => ['admin-calendar.destroy', $game->id], 'method' => 'DELETE']) !!}
                    {!! Form::submit('Видалити', [ 'class'=>"btn btn-xs btn-danger", 'onClick'=>"return confirm('Ви впевнені що хочете видалити матч?')"]) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      @endforeach
  </div>
</div>
@endsection




