@extends('admin.admin')

@section('adminzone')
<div class="all-teams"> 
  <div class="add-btn col-xs-12">
    <a class="btn btn-small alert-success btn-xs" href="{{ URL::to('admin-teams/create')}}">Додати нову команду</a>
  </div>
  <div class="col-xs-12"> 
    <table class=" table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Емблема</th>
                <th>Назва</th>
                <th>Місто/село</th>
                <th>Керування</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>{{ $team->id }}</td>
                <td>@if($team->small_logo)<img src="{{ asset($team->small_logo) }}" alt='team-logo' >@endif</td>
                <td>{{ $team->name }}</td>
                <td>{{ $team->city }}</td>
                <td>
                    <a class="btn btn-xs btn-info" href="{{ URL::to('admin-teams/'.$team->id)}}">Детальніше</a>
                    <a class="btn btn-xs btn-warning" href="{{ URL::to('admin-teams/'.$team->id.'/edit')}}">Редагувати </a>          
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
  </div>    
  <div class="pagination-sm">
    {{ $teams->links() }}
  </div>

</div>
@endsection
