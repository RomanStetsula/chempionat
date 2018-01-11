@extends('admin.admin')

@section('adminzone')
<div class="edit-news"> 
    <div class = "errors">
    {{  HTML::ul($errors->all()) }}
    </div>
    <div class="col-xs-12">
        <div class="editnews-form">
            {{ Form::model($post, ['route'=>['admin-news.update', $post->id], 'files' => true, 'method'=>'PUT', 'id'=>'form', 'enctype'=>'multipart/form-data']) }}
            <div class="form-group">
            {{ Form::label('title', 'Заголовок', ['class' => 'control-label']) }}
            {{ Form::text('title', old('title'), ['class'=>"form-control"]) }}
            </div>
            <div class="form-group">
            {{ Form::label('subtitle', 'Підзаголовок', ['class' => 'control-label']) }}
            {{ Form::text('subtitle', old('subtitle'), ['class'=>"form-control"]) }}
            </div>
            <div class="form-group">
            {{ Form::label('main_img', 'Основне фото', ['class' => 'control-label']) }}
            {{ Form::text('main_img', old('main_img'), ['class'=>"form-control"]) }}
            </div>
            <div class=" form-group textarea">
            {{ Form::label('content', 'Контент', ['class' => 'control-label']) }}
            {{ Form::textarea('content', old('content'), ['class'=>"form-control"]) }}
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
    </div>
</div>
<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea",
    plugins: [
      "link lists",
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection
