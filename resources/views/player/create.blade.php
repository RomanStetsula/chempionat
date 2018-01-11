@extends('base');

@section('content')
    <div class="edit-team">
        <div class = "errors">
            {{  HTML::ul($errors->all()) }}
        </div>
        <div class = "create-player-form">
            {{ Form::open(['url' => 'player', 'files' => true, 'id'=>'form', 'enctype'=>'multipart/form-data']) }}
        </div>

        <div class ="col-xs-12">
            <div class ="col-xs-6">
                <div class="">
                    <span class="glyphicon glyphicon-download"></span> Фото <p class="help-block">Размір зображення ( формат .png ): висота 400px x ширина до 400px, не більше 250Кб</p>
                </div>

                <div class="form-group">
                    {{ Form::file('player_foto', ['id'=>'player-foto', 'multiple accept'=>'image/*']) }}
                </div>
                <div class="added-logo">
                    <img src='' alt='Player foto' title='Player foto'  id="img-preview-logo">
                    <br/>
                    <a href="#" id="reset-img-preview-logo">скинути завантажене изображения</a>
                </div>
            </div>
        </div>

        <div class ="col-xs-12">
                <div class="form-group">
                    {{ Form::label('full_name', 'Прізвище Імя', ['class' => 'control-label']) }}
                    {{ Form::text('full_name', old('full_name'), ['class'=>"form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('birth_day', 'Число', ['class' => 'control-label']) }}
                    {{ Form::number('birth_day', old('birth_day'), ['class'=>"form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('birth_month', 'Місяць', ['class' => 'control-label']) }}
                    {{ Form::number('birth_month', old('birth_month'), ['class'=>"form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('birth_year', 'Рік', ['class' => 'control-label']) }}
                    {{ Form::number('birth_year', old('birth_year'), ['class'=>"form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('height', 'Зріст', ['class' => 'control-label']) }}
                    {{ Form::number('height', old('height'), ['class'=>"form-control"]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('weight', 'Вага', ['class' => 'control-label']) }}
                    {{ Form::number('weight', old('weight'), ['class'=>"form-control"]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('number', 'Ігровий номер', ['class' => 'control-label']) }}
                    {{ Form::number('number', old('number'), ['class'=>"form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('position', 'Позиція', ['class' => 'control-label']) }}
                    {{ Form::select('position',
                        ['GK'=>'Голкіпер (GK)','LD'=>'Лівий захисник (LD)',
                        'RD'=>'Правий захисник (RD)', 'CD'=>'Ценральний захисник (CD)',
                        'DM'=>'Опорний півзахисник (DM)', 'CM'=>'Центральний півзахисник (CM)',
                        'LM'=>'Лівий півзахисник (LM)', 'RM'=>' Правий півзахисник (RM)',
                        'AM'=>'Атакуючий півзихисник (AM)','LW'=>'Лівий вінгер (LW)',
                        'RW'=>'Правий вінгер (RW)','ST'=>'Центральний нападник (ST)'],
                        null, ['class' =>"form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('team_id', 'Ваша команда', ['class' => 'control-label']) }}
                    {{ Form::select('team_id', ['Виберіть команду...'=>$teams_select], null, ['class' =>"teams-select"]) }}</td>
                </div>
        </div>

        <div class="col-xs-12">
            <div class="cancel">
                {{ Form::reset('Відміна', ['class'=>"btn btn-xs btn-warning"]) }}
            </div>
            <div class="save">
                {{ Form::submit('Зберегти', ['class'=>"btn btn-small alert-success btn-xs"]) }}
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection