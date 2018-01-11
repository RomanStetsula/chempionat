@extends('admin.admin')

@section('adminzone')
<div class="">
  <div class="col-xs-12">
    <div class="content-title col-xs-6">
      @if (isset($league->id))
      <h4>Редагування ліги</h4>
      @else
      <h4>Стверення ліги</h4>
      @endif
    </div>
  </div>
  <div class = "errors">
    {{  HTML::ul($errors->all()) }}
  </div>
    <div class="col-xs-12">
      <div class="col-xs-3">
       @if (isset($league->id))
         {{ Form::model($league, ['route'=>['admin-leagves.update', $league->id], 'method'=>'PUT']) }}
       @else
         {{ Form::open(['url' => 'admin-leagues']) }}
       @endif
       <div class="form-group">
       {{ Form::label('league_name', 'Назва ліги', ['class' => 'control-label']) }}
       {{ Form::text('league_name', old('league_name'), ['class'=>"form-control"]) }}
       </div>
      </div>
      <div class="col-xs-3">
       <div class="form-group">
       {{ Form::label('season', 'Сезон (рік)', ['class' => 'control-label']) }}
       {{ Form::text('season', old('season'), ['class'=>"form-control"]) }}
       </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-3">    
       <div class="form-group">
           {{ Form::label('rank', 'Ранг ліги', ['class' => 'control-label']) }}
           {{ Form::select('rank', ['1' => 'Премер-ліга', '2' => 'Вища-ліга', '3' => 'Перша-ліга', '4' => 'Друга-ліга', '5' => 'Третя-ліга',
           '6' => 'Премер-ліга молодь', '7' => 'Вища-ліга молодь', '8' => 'Перша-ліга молодь', '9' => 'Друга-ліга молодь', '10' => 'Третя-ліга молодь'], old('quality')) }}
       </div>
      </div>
      <div class="col-xs-3">
       <div class="form-group league-checkbox">
       {{ Form::label('show', 'Показувати у меню', ['class' => 'control-label']) }}
       {{ Form::checkbox('show', true, ['class'=>"form-control", "data-toggle"=>"toggle"]) }}
       </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-7">
        <div class="cancel">
          {{ Form::reset('Відміна', ['class'=>"btn btn-xs btn-warning"]) }}
        </div>
        <div class="save">
          {{ Form::submit('Зберегти', ['class'=>"btn btn-small alert-success btn-xs"]) }}
        </div>
      </div>
       {{ Form::close() }}
    </div>
</div>
<div>
   <hr>
</div>
@endsection

