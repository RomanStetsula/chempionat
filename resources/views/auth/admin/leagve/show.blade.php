@extends('admin.admin')

@section('adminzone')
<div class="show-leagve">
  <div class="links col-xs-10">
    <a  href="{{ URL::to('admin-leagves')}}">Повернутсь до огляду ліг <i class="fa fa-reply" aria-hidden="true"></i></i></a>
  </div>
  <div class="links col-xs-2">
      <a  href="{{ URL::to('admin-calendar/'.$leagve->id)}}">Календар <i class="fa fa-list" aria-hidden="true"></i></a>
  </div>
  <div class ="col-xs-12">
  <table class="table table-striped table-bordered">  
      <div class="table-title"><h5><strong>{{$leagve->leagve_name}}</strong></h5></div>
    <thead>  
      <tr>
          <th>Поз.</th>
          <th>Команда</th>
          <th>I</th> 
          <th>В</th>
          <th>Н</th>
          <th>П</th>
          <th>З</th>
          <th>П</th>
          <th>Р</th>
          <th>О</th>
          <th></th>
      </tr>
    </thead>

    <tbody>
      @foreach($leagve_teams as $key => $league_team)
      <tr>
          <td>{{$key+1}}</td>
          <!--<td>@if($league_team->small_logo)<img src="{{asset($league_team->small_logo)}}" alt='team-logo' >@endif</td>;-->
          <td><a class="" href="{{ URL::to('admin-teams/'.$league_team->team_id )}}">{{$league_team->table_name}}</a></td>
          <td>{{ $league_team->games }}</td>
          <td>{{ $league_team->wins }}</td>
          <td> {{ $league_team->draws }}</td>
          <td> {{ $league_team->losts }}</td>
          <td> {{ $league_team->scores }}</td>
          <td> {{ $league_team->missed }}</td>
          <td> {{ $league_team->odds }}</td>
          <td > {{ $league_team->points }}</td>
          <td >
              {{ Form::open(['route' => ['league', $league_team->id], 'method' => 'DELETE']) }}
              {{ Form::submit('Видалити команду', [ 'class'=>"" ]) }}
              {{ Form::close() }} 
          </td>
      </tr>
      @endforeach
    </tbody>
  </table>
   
  <h5>Додати команди в таблицю</h5>
  {!! Form::open(['url'=>'league']) !!}
  <div class="form-group">
      {!! Form::select('teams_add[]', ['Виберіть команди...'=>$all_teams], null, ['multiple' => true, 'size' => 10]); !!}
      {!! Form::hidden('leagve_id', $leagve->id ) !!}
  </div>
  <div class="form-group">
    <div class="save">
      {{ Form::submit('Зберегти', ['class'=>"btn btn-small alert-success btn-xs"]) }}
    </div>
  </div>
  {!! Form::close() !!}
  </div>
</div>
@endsection
