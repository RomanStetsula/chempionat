@extends('sides')

@section('center-content')
<div class="main-content">
  <div class="news">
    <div class="content-title">
      <h4>Архів новин</h4>
    </div>
      
    @for($i = 0; $i < count($posts); $i++ )
      <div class="news-post">
        <div class ="post-thumbs">
          <img src ="{{ $posts[$i]->thumbs_img }}" alt = 'news-foto'>
        </div>
        <div class="intro-text">
          <h6>{{ $posts[$i]->created_at }}</h6>
          <a  href="{{ URL::to('news/'.$posts[$i]->id)}}"><h4><b>{{ $posts[$i]->title }}</b></h4></a>
          <h5>{{ $posts[$i]->subtitle }}</h5>          
        </div>
      </div>
    @endfor
  </div>
  <div class="pagination-sm">
    {{ $posts->links() }}
  </div>
</div>
@endsection
