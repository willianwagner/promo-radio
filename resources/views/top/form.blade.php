<div class="hide form-group {{ $errors->has('posicao') ? 'has-error' : ''}}">
    <label for="posicao" class="col-md-4 control-label">{{ 'Posicao' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="posicao" type="number" id="posicao" value="{{ $top->posicao or ''}}" >
        {!! $errors->first('posicao', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('artista') ? 'has-error' : ''}}">
    <label for="artista" class="col-md-4 control-label">{{ 'Artista' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="artista" type="text" id="artista" value="{{ $top->artista or ''}}" >
        {!! $errors->first('artista', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('musica') ? 'has-error' : ''}}">
    <label for="musica" class="col-md-4 control-label">{{ 'Musica' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="musica" type="text" id="musica" value="{{ $top->musica or ''}}" >
        {!! $errors->first('musica', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('capa') ? 'has-error' : ''}}">
    <label for="capa" class="col-md-4 control-label">{{ 'Capa' }}</label>
    <div class="col-md-6">
    <small>*Tamanho da imagem: 400x400</small>
        <input class="form-control" name="capa" type="file" id="capa" value="{{ $top->capa or ''}}" >
        {!! $errors->first('capa', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="hide form-group {{ $errors->has('ano') ? 'has-error' : ''}}">
    <label for="ano" class="col-md-4 control-label">{{ 'Ano' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="ano" type="text" id="ano" value="{{ $top->ano or ''}}" >
        {!! $errors->first('ano', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="hide form-group {{ $errors->has('mes') ? 'has-error' : ''}}">
    <label for="mes" class="col-md-4 control-label">{{ 'Mes' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="mes" type="text" id="mes" value="{{ $top->mes or ''}}" >
        {!! $errors->first('mes', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="hide form-group {{ $errors->has('ativo') ? 'has-error' : ''}}">
    <label for="ativo" class="col-md-4 control-label">{{ 'Ativo' }}</label>
    <div class="col-md-6">
        <select name="ativo" class="form-control" id="ativo" >
    @foreach (array('ativo' => 'ativo','inativo' => 'inativo') as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($top->ativo) && $top->ativo == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('ativo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Cadastrar' }}">
    </div>
</div>
