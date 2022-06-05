<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
        <input class="form-control" name="nome" type="text" id="nome" value="{{ $sorteio->nome or ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('num_sorteados') ? 'has-error' : ''}}">
    <div class="col-md-12">
    <label for="num_sorteados" class="control-label">{{ 'Número de sorteados' }}</label>
        <input class="form-control" name="num_sorteados" type="text" id="num_sorteados" value="{{ $sorteio->num_sorteados or ''}}" >
        {!! $errors->first('num_sorteados', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('somente_maior') ? 'has-error' : ''}}">
    <div class="col-md-12">
      <label for="status" class="control-label">{{ 'Somente maiores de idade' }}</label>
      {!! Form::select('somente_maior', [0 => 'Não', 1 => 'Sim'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('somente_maior', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('somente_igrejinha') ? 'has-error' : ''}}">
    <div class="col-md-12">
      <label for="status" class="control-label">{{ 'Somente cadastros de Igrejinha' }}</label>
      {!! Form::select('somente_igrejinha', [0 => 'Não', 1 => 'Sim'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('somente_igrejinha', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('promocao_id') ? 'has-error' : ''}}">
    <div class="col-md-12">
      {!! Form::label('promocao_id', 'Promoção', ['class' => 'control-label']) !!}
      {!! Form::select('promocao_id', $promocoes, null, ['class' => 'form-control']) !!}
      {!! $errors->first('promocao_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-12">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Criar' }}">
    </div>
</div>
