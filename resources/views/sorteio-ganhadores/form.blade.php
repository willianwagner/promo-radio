<div class="form-group {{ $errors->has('ouvinte_id') ? 'has-error' : ''}}">
    <label for="ouvinte_id" class="col-md-4 control-label">{{ 'Ouvinte Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="ouvinte_id" type="text" id="ouvinte_id" value="{{ $sorteioganhadore->ouvinte_id or ''}}" >
        {!! $errors->first('ouvinte_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('sorteio_id') ? 'has-error' : ''}}">
    <label for="sorteio_id" class="col-md-4 control-label">{{ 'Sorteio Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="sorteio_id" type="text" id="sorteio_id" value="{{ $sorteioganhadore->sorteio_id or ''}}" >
        {!! $errors->first('sorteio_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('promocao_id') ? 'has-error' : ''}}">
    <label for="promocao_id" class="col-md-4 control-label">{{ 'Promocao Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="promocao_id" type="text" id="promocao_id" value="{{ $sorteioganhadore->promocao_id or ''}}" >
        {!! $errors->first('promocao_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
