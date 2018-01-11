@extends('admin.admin')

@section('adminzone')
  <div class="admin-showteam"> 
  <div class="content-title">
    <h4>Користувач</h4>
  </div>
  <div class="user-info">
    <div class="team-info-logo">
      <img src='{{$user->avatar }}' alt='avatar'>
    </div>
    <div class="team-intro">
      <h3>{{ $team->name }}</h3>
      <table class="team-intro-table">
          <tr>
            <td>Населений пункт</td><td>{{ $team->city }}</td>
          </tr>
          <tr>
            <td>Президент</td><td>{{ $team->president or '-'}}</td>
          </tr>
          <tr>
            <td>Керівник</td><td>{{ $team->manager or '-'}}</td>
          </tr>
          <tr>
            <td>Тел. керівника</td><td>{{ $team->man_number or '-'}}</td>
          </tr>
          <tr>
            <td>Веб:</td><td>{{ $team->web or '-'}}</td>
          </tr>
      </table>
    </div>
    <div class="team-add-info">
      {!! $team->info !!}  
    </div>
    @if(!is_null($team->foto))
    <div class="team-foto">
      <img src='{{ $team->foto }}' alt='team-foto'>
    </div>
    @endif
    <div class="after-news col-xs-12">
      <a  href="{{ URL::to('admin-users')}}">До всіх користувачів <i class="fa fa-reply" aria-hidden="true"></i></i></a>
    </div>
  </div>
</div>
@endsection