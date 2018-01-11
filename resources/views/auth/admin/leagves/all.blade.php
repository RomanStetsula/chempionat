@extends('admin.admin')

@section('adminzone')
<div class="admin-leagves">
  <div class="add-btn col-xs-12">
    <a class="btn btn-small alert-success btn-xs" href="{{ URL::to('leagues')}}">Додати нову лігу</a>
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
              @foreach($leagves as $leagve)
              <tr>
                  <td>{!! $leagve->id !!}</td>
                  <td>{!! $leagve->leagve_name !!}</td>
                  <td>{!! $leagve->season !!}</td>
                  <td>{!! $leagve->rank !!}</td>
                  <td>
                      @if($leagve->show)
                        так
                      @else
                        ні
                      @endif
                  </td>
                  <td width='240'>
                    <a class="btn btn-small alert-success btn-xs" href="{{ URL::to('league'.$leagve->id)}}">Таблиця</a>
                    <a class="btn btn-xs btn-info" href="{{ URL::to('admin-calendar/'.$leagve->id)}}">Календар</a>
                    <a class="btn btn-xs btn-warning" href="{{ URL::to('admin-leagves/'.$leagve->id.'/edit')}}">Редагувати </a>  
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  <div class="pagination-sm">
  {{ $leagves->links() }}
  </div>
  </div>
</div>
@endsection
