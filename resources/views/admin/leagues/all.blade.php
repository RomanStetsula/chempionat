@extends('admin.admin')

@section('adminzone')
<div class="admin-leagues">
  <div class="add-btn col-xs-12">
    <a class="btn btn-small alert-success btn-xs" href="{{ URL::to('admin-leagues/create')}}">Додати нову лігу</a>
  </div>
  <div class="container">
    <div class="col-md-12">
      <table class=" table table-striped table-bordered">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Назва</th>
                  <th>Сезон </th>
                  <th>Ранг ліги </th>
                  <th>Показувати у меню</th>
                  <th>Керування</th>
              </tr>
          </thead>
          <tbody>
              @foreach($leagues as $league)
              <tr>
                  <td class="league-id">{{ $league->id }}</td>
                  <td>{{ $league->league_name }}</td>
                  <td>{{ $league->season}}</td>
                  <td>{{ $league->rank }}</td>
                  <td class="toggle-cell">
                    <input class="league-toggle" type="checkbox"
                           @if($league->show)checked @endif
                           data-toggle="toggle" data-on="Так" data-off="Ні" data-onstyle="success"
                    >
                  </td>
                  <td width='240'>
                    <a class="btn btn-small alert-success btn-xs" href="{{ URL::to('admin-league/'.$league->id)}}">Таблиця</a>
                    <a class="btn btn-xs btn-info" href="{{ URL::to('admin-calendar/'.$league->id)}}">Календар</a>
                    <a class="btn btn-xs btn-warning" href="{{ URL::to('admin-leagues/'.$league->id.'/edit')}}">Редагувати </a>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  <div class="pagination-sm">
  {{ $leagues->links() }}
  </div>
  </div>
</div>
@endsection
