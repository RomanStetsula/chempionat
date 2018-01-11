@extends('admin.admin')

@section('adminzone')
<div class="all-news"> 
  <div class="add-btn col-xs-12">
      <a class="btn btn-small alert-success btn-xs" href="{{ URL::to('admin-news/create')}}">Додати новину</a>
  </div>
  <div class="col-xs-12">  
    <table class="admin-all-news-table table table-bordered table-hover">
      <thead>
        <tr>
          <th><strong>Основне фото</strong></th>
          <th><strong>Заголовок</strong></th>
          <th><strong>Керування</strong></th>
        </tr>
      </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
          <td><img src="{{asset($post->thumbs_img) }}" alt='Post-img' ></td>
          <td>
              <h4><strong>{{ $post->title }}</strong></h4>
              <h5>{{ $post->subtitle }}</h5>
              <h6>{{ $post->created_at }}</h6>
          </td>
          <td>
            <a class="btn btn-xs btn-info" href="{{ URL::to('admin-news/'.$post->id)}}">Переглянути</a>
            <a class="btn btn-xs btn-warning" href="{{ URL::to('admin-news/'.$post->id.'/edit')}}">Редагувати </a>
            {{ Form::open(['route' => ['admin-news.destroy', $post->id], 'method' => 'delete']) }}
            {{ Form::submit('Видалити', [ 'class'=>"btn btn-xs btn-danger", 'onClick'=>"return confirm('Ви впевнені що хочете видалити новину?')"]) }}
            {{ Form::close() }}
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div class="pagination-sm">
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection