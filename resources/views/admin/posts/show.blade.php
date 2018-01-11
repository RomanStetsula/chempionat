@extends('admin.admin')

@section('adminzone')
<div class="admin-showpost">
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
      <div class="after-news col-xs-12">
        <a  href="{{ URL::to('admin-news')}}">Повернутсь до всіх новин <i class="fa fa-reply" aria-hidden="true"></i></i></a>
        <a  href="{{ URL::to('admin-news/'.$post->id.'/edit')}}">Редагувати <i class="fa fa-pencil" aria-hidden="true"></i></a>
      </div>
  </div>
</div>
@endsection