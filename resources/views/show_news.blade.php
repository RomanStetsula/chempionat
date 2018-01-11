@extends('sides')

@section('center-content')
<div class="main-content">
  <div class="post">
    <div class="content-title">
      <h4>{{ $post->title }}</h4>
    </div>
    <div>
      <h5>{{ $post->subtitle }}</h5>
    </div>
    <div class="news-content">
      {!! $post->content !!}
    </div>
    <h6 class="news-date">{{ $post->created_at }}<h6>
  </div>
</div>
@endsection
