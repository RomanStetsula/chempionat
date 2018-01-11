@extends('admin.admin')

@section('adminzone')
<div class="edit-team"> 
  <div class = "errors">
  {{  HTML::ul($errors->all()) }}
  </div>
    <div class = "editteam-form">
      {{ Form::model($team, ['route'=>['admin-teams.update', $team->id], 'files' => true, 'method'=>'PUT', 'id'=>'form', 'enctype'=>'multipart/form-data']) }}
    </div>
    
    <div class ="col-xs-12">
      <div class ="col-xs-6">  
        <div class="">
            <span class="glyphicon glyphicon-download"></span> Виберіть емблему клубу. <p class="help-block">Размір зображення ( формат .png ): висота 400px x ширина до 400px, не більше 250Кб</p>
        </div>

        <div class="form-group">
            {{ Form::file('logo', ['id'=>'logo', 'multiple accept'=>'image/*']) }}
        </div>
        <div class="added-logo">
            <img src='{{$team->logo}}' alt='Logotype' id="img-preview-logo">
            <br />
            <a href="#" id="reset-img-preview-logo">скинути завантажене изображения</a>
        </div>
      </div>
      <div class ="col-xs-6">
        <div class="">
            <span class="glyphicon glyphicon-download"></span> Виберіть фото команди. <p class="help-block">Размір зображення( формат .jpg ): ширина 1200 x висота800px, не більше 1000Кб</p>
        </div>
        <div class="form-group">
            {{ Form::file('foto', ['id'=>'foto', 'multiple accept'=>'image/*']) }}
        </div>
        <div class="added-foto">
            <img src='{{$team->foto}}' alt='Logotype' id="img-preview-foto">
            <br />
            <a href="#" id="reset-img-preview-foto">скинути завантажене изображения</a>
        </div>
      </div>
    </div>
  
    <div class ="col-xs-12">
      <div class ="col-xs-6">
        <div class="form-group">
            {{ Form::label('name', 'Назва', ['class' => 'control-label']) }}
            {{ Form::text('name', old('name'), ['class'=>"form-control"]) }}
        </div>
        <div class="form-group">
            {{ Form::label('city', 'Місто/село', ['class' => 'control-label']) }}
            {{ Form::text('city', old('city'), ['class'=>"form-control"]) }}
        </div>
        <div class="form-group">
            {{ Form::label('table_name', 'Назва у таблиці', ['class' => 'control-label']) }}
            {{ Form::text('table_name', old('table_name'), ['class'=>"form-control"]) }}
        </div>
      </div>
        
      <div class ="col-xs-6">
        <div class="form-group">
            {{ Form::label('president', 'Президент', ['class' => 'control-label']) }}
            {{ Form::text('president', old('president'), ['class'=>"form-control"]) }}
        </div>
        <div class="form-group">
            {{ Form::label('manager', 'Керівник', ['class' => 'control-label']) }}
            {{ Form::text('manager', old('manager'), ['class'=>"form-control"]) }}
        </div>
        <div class="form-group">
            {{ Form::label('manager_num', 'Тел. керівника', ['class' => 'control-label']) }}
            {{ Form::text('manager_num', old('manager_num'), ['class'=>"form-control"]) }}
        </div>
        <div class="form-group">
            {{ Form::label('web', 'Веб сторінка', ['class' => 'control-label']) }}
            {{ Form::text('web', old('web'), ['class'=>"form-control"]) }}
        </div>
      </div>
    </div>
    
    <div class="col-xs-12">
      <div>
        <div class="form-group textarea">
          {{ Form::label('info', 'Інфрормація(історія клубу)', ['class' => 'control-label']) }}
          {{ Form::textarea('info', old('info'), ['class'=>"form-control"]) }}
        </div>
      </div>
    </div>
        
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

<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ 
          selector:'textarea',
          plugins: "link lists",
          menubar: false});
</script>
@endsection
