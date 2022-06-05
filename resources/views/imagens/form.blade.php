<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="link" class="control-label">{{ 'Título' }}</label>
        <input class="form-control" name="link" type="text" id="link" value="{{ $imagem->link or ''}}" >
        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('imagem', 'Imagem', ['class' => 'control-label']) !!}
        @if(isset($tamanho) && $tamanho != '')
            <p><small>Tamanho recomendado: {{$tamanho}}</small></p>
        @endif
        {!! Form::file('imagem', null, ['class' => 'form-control']) !!}
        {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Criar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
