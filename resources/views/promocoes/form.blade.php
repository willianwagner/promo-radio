<div class="form-group {{ $errors->has('nome') ? 'has-error' : ''}}">
    <div class="col-md-12">
        <label for="nome" class="control-label">{{ 'Nome' }}</label>
        <input class="form-control" name="nome" type="text" id="nome" value="{{ $promocao->nome or ''}}" >
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <div class="col-md-12">
      <label for="status" class="control-label">{{ 'Status' }}</label>
      {!! Form::select('status', ['ativo' => 'ativo', 'inativo' => 'inativo'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <div class="col-md-12">
      <label for="status" class="control-label">{{ 'Categoria' }}</label>
      {!! Form::select('categoria', ['dia-dos-namorados' => 'Dia dos Namorados','bolsa-de-mae' => 'Bolsa de Mãe','natal-cheio-de-coisas-boas' => 'Natal Cheio de Coisas Boas'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('imagem') ? 'has-error' : ''}}">
    <div class="col-md-12">
        {!! Form::label('imagem', 'Imagem', ['class' => 'control-label']) !!}
        {!! Form::file('imagem', null, ['class' => 'form-control']) !!}
        {!! $errors->first('imagem', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-12">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Criar' }}">
    </div>
</div>
