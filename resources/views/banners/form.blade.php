<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="link" class="control-label">{{ 'Link' }}</label>
        <input class="form-control" name="link" type="text" id="link" value="{{ $banner->link or ''}}" >
        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('imagem', 'Imagem', ['class' => 'control-label']) !!}
        <p><small>Tamanho recomendado: 1440x838</small></p>
        {!! Form::file('imagem', null, ['class' => 'form-control']) !!}
        {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Criar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
