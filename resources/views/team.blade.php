@extends('sides')

@section('center-content')
<div class="main-content"> 
  <div class="content-title">
    <h4>Досьє команди</h4>
  </div>
  <div class="team-info">
    <div class="team-info-logo">
      <img src='{{$team->logo }}' alt='alt'>
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
</div>

@endsection