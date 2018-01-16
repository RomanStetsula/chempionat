@extends('base')
@section('admin-links')
  <link href={{mix("/css/admin.css")}} rel="stylesheet">
  {{--<link href="/css/bootstrap-datepicker.css" rel="stylesheet">--}}
@endsection
    
@section('content')
<div class="adminzone">
  <div class = "admin-menu">
    <ul>
      <li><i class="fa fa-grav" aria-hidden="true"></i></li>
      <li><a href="{{ URL::to('admin-news') }}">Новини</a></li>
      <li><a href="{{ URL::to('admin-teams') }}">Команди</a></li>
      <li><a href="{{ URL::to('admin-leagues') }}">Ліги</a></li>
      @if (Auth::user()->is_superadmin)
        <li><a href="{{ URL::to('admin-users') }}">Користувачі</a></li>
      @endif
    </ul>
  </div>
  <div class ="alert-wrap">
    @if(Session::has('message'))
    <div class="alert alert-success" role="alert">
      {{Session::get('message')}}
    </div>
    @endif
  </div>
  @yield('adminzone')
</div>
@endsection
@section('admin-scripts')
  
@endsection
