@extends('admin.admin')

@section('adminzone')
<div class="all-teams"> 
  <div class="col-xs-12">
    Всі користувачі
  </div>
  <div class="col-xs-12"> 
    <table class=" table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Аватар</th>
                <th>Ім'я</th>
                <th>Емейл</th>
                <th>Адмін</th>
                <th>Бан</th>
                <th>Адмініструє</th>
                <th>Керування</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="user-id">{{ $user->id }}</td>
                <td>@if($user->avatar)<img src="{{$user->avatar}}" alt='Фото користувача' >@endif</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="toggle-cell">
                    <input class="admin-toggle" type="checkbox"
                           @if($user->is_admin)checked @endif
                           data-toggle="toggle" data-on="Так" data-off="Ні" data-onstyle="success"
                    >
                </td>
                <td class="toggle-cell">
                    <input class="ban-toggle" type="checkbox"
                           @if($user->ban)checked @endif
                           data-toggle="toggle" data-on="Так" data-off="Ні" data-onstyle="danger"
                    >
                </td>
                <td><img src='{{$user->team_logo}}'></td>
                <td>
                  <a class="btn btn-xs btn-info" href="{{ URL::to('admin-users/'.$user->id)}}">Переглянути/Внести зміни</a>        
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
  </div>    
  <div class="pagination-sm">
    {{ $users->links() }}
  </div>

</div>
@endsection
